<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Like;
use App\Product;
use App\ProductService;
use App\Requests\CreateProductRequest;
use App\Transformations\ProductTransformable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        });
        $data['data'] = $products;
        return response($data, 200);
    }

    public function store(CreateProductRequest $request)
    {
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
                    if ($key == 1) {
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
            Log::error($exception->getMessage());
            return response(['status' => 400, 'message' => $exception->getMessage()], 400);
        }
        DB::commit();
        return response(['status' => 200, 'message' => 'thêm mới sản phẩm thành công!'], 200);
    }

    public function view($slug, $id)
    {
        $user = auth('api')->user();
        $product = Product::where(['slug' => $slug, 'id' => $id])->first();
        if (empty($product)) {
            return response(['errors'=> 'Not Found Product'], 404);
        }
        $liked = false;
        $unliked = false;
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
        }
        $product = $this->transformProduct($product, $user);
        $product['liked'] = $liked;
        $product['unliked'] = $unliked;
        return response(['product' => $product], 200);
    }
}
