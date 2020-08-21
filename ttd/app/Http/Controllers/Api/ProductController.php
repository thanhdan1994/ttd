<?php
namespace App\Http\Controllers\Api;

use App\Bookmark;
use App\Http\Controllers\Controller;
use App\Like;
use App\Product;
use App\ProductService;
use App\Report;
use App\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ProductTransformable;

    public function index(Request $request)
    {
        $size = 10;
        if ($request->size) {
            $size = $request->size;
        }
        $data = [];
        try {
            $products = Product::withCount('comments')
                ->with('category')
                ->orderBy('created_at', 'desc')
                ->paginate($size);
            $data['total_pages'] = $products->lastPage();
            $data['current_page'] = $products->currentPage();
            $data['per_page'] = $products->count();
            $products = $products->map(function (Product $product) {
                $product->thumb = $product->getThumbnailUrl('thumb');
                $product->thumb150 = $product->getThumbnailUrl('thumb-150');
                $product->thumb350 = $product->getThumbnailUrl('thumb-350');
                return $product;
            });$data['data'] = $products;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($data, 200);
    }

    public function myProducts(Request $request)
    {
        $user = auth('api')->user();
        $size = 10;
        if ($request->size) {
            $size = $request->size;
        }
        $data = [];
        try {
            $products = Product::where(['user_id' => $user->id])
                ->withCount('comments')
                ->with('category')
                ->orderBy('created_at', 'desc')
                ->paginate($size);
            $data['total_pages'] = $products->lastPage();
            $data['current_page'] = $products->currentPage();
            $data['per_page'] = $products->count();
            $products = $products->map(function (Product $product) {
                $product->thumb = $product->getThumbnailUrl('thumb');
                $product->thumb150 = $product->getThumbnailUrl('thumb-150');
                $product->thumb350 = $product->getThumbnailUrl('thumb-350');
                return $product;
            });$data['data'] = $products;
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($data, 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'name.max' => 'Tên sản phẩm quá dài (phải nhỏ hơn 255 kí tự)',
            'content.required'  => 'Nội dung sản phẩm là bắt buộc',
            'excerpt.required'  => 'Mô tả sản phẩm là bắt buộc',
            'lat.required' => 'Latitude là bắt buộc',
            'long.required' => 'Longitude là bắt buộc',
            'amount.required' => 'Giá sản phẩm là bắt buộc',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'address.required' => 'Địa chỉ là bắt buộc'
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'excerpt' => ['required'],
            'content' => ['required'],
            'phone' => ['required'],
            'amount' => ['required', 'numeric'],
            'address' => ['required'],
            'lat' => ['required'],
            'long' => ['required']
        ], $messages);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $data = $request->all();
        $data['status'] =  false;
        $data['slug'] = Str::slug($request->get('name'));
        $data['user_id'] = $request->user()->id;
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            if ($request->get('images')) {
                $product->clearMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'));
                foreach ($request->get('images') as $key => $file) {
                    $media = $product->addMediaFromBase64($file)->usingFileName(Str::random(20).'.jpg')->toMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'));
                    if ($key == 0) {
                        $product->featured_image = $media->id;
                        $product->save();
                    }
                }
            }
            if ($request->get('services')) {
                ProductService::where('product_id', $product->id)->delete();
                $productServices = [];
                foreach ($request->get('services') as $serviceId) {
                    $productServices[] = ['product_id' => $product->id, 'service_id' => $serviceId];
                }
                ProductService::insert($productServices);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
        DB::commit();
        return response(['status' => 200, 'message' => 'thêm mới sản phẩm thành công!'], 200);
    }

    public function view($slug, $id)
    {
        $user = auth('api')->user();
        try {
            $product = Product::where(['slug' => $slug, 'id' => $id])->firstOrFail();
            $liked = false;
            $unliked = false;
            $report = false;
            $bookmark = false;
            if (!empty($user)) {
                $liked = Like::where([
                    'user_id' => $user->id,
                    'type' => 1,
                    'model_type' => get_class($product),
                    'model_id' => $product->id
                ])->first() ? true : false;
                $unliked = Like::where([
                    'user_id' => $user->id,
                    'type' => 2,
                    'model_type' => get_class($product),
                    'model_id' => $product->id
                ])->first() ? true : false;
                $report = Report::where([
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ])->first() ? true : false;
                $bookmark = Bookmark::where([
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ])->first() ? true : false;
            }
            $product = $this->transformProduct($product, $user);
            $product['liked'] = $liked;
            $product['unliked'] = $unliked;
            $product['report'] = $report;
            $product['bookmark'] = $bookmark;
        } catch (ModelNotFoundException $modelNotFoundException) {
            abort(404, $modelNotFoundException->getMessage());
        }
        return response(['product' => $product], 200);
    }

    public function nearby(Request $request)
    {
        $messages = [
            'lat.required' => 'Thiếu tham số lat',
            'long.required' => 'Thiếu tham số long',
        ];
        $validator = Validator::make($request->all(), [
            'lat' => ['required'],
            'long' => ['required'],
        ], $messages);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $products = [];
        try {
            $page = $request->get('page') ? $request->get('page') : 1;
            $size = $request->get('size') ? $request->get('size') : 5;
            $lat = $request->get('lat');
            $long = $request->get('long');
            $offset = ($page - 1) * $size;
            $string = "SELECT id, name, phone, address, amount, slug,
                      TRUNCATE(ST_Distance(
                         ST_GeomFromText(CONCAT('POINT(', products.lat, ' ', products.long, ')'), 4326),
                         ST_GeomFromText(CONCAT('POINT(', ?, ' ', ?, ')'), 4326),
                         'kilometre'
                      ), 2) as distance
                FROM products
                ORDER BY distance ASC
                LIMIT $offset, $size";
            $products = \Illuminate\Support\Facades\DB::select($string, [$lat, $long]);
            foreach ($products as $key => $product) {
                $newProduct = Product::withCount('comments')->find($product->id);
                $product->thumb = $newProduct->getThumbnailUrl('thumb');
                $product->thumb150 = $newProduct->getThumbnailUrl('thumb-150');
                $product->thumb350 = $newProduct->getThumbnailUrl('thumb-350');
                $product->category = $newProduct->category;
                $product->comments_count = $newProduct->comments_count;
                $products[$key] = $product;
            }
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($products, 200);
    }
}
