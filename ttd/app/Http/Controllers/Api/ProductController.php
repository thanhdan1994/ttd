<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BookmarkRepositoryInterface;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProductServiceRepositoryInterface;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Transformations\ProductTransformable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends ApiController
{
    use ProductTransformable;

    private $productRepo;

    private $bookmarkRepo;

    private $productServiceRepo;

    private $likeRepo;

    private $reportRepo;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BookmarkRepositoryInterface $bookmarkRepository,
        ProductServiceRepositoryInterface $productServiceRepository,
        ReportRepositoryInterface $reportRepository,
        LikeRepositoryInterface $likeRepository
    ) {
        parent::__construct();
        $this->productRepo = $productRepository;
        $this->bookmarkRepo = $bookmarkRepository;
        $this->productServiceRepo = $productServiceRepository;
        $this->reportRepo = $reportRepository;
        $this->likeRepo = $likeRepository;
    }


    public function getProducts(Request $request)
    {
        $size = $request->size ? : 5;
        $page = $request->page ? : 1;
        try {
            $products = $this->productRepo->listProductsWithCountCommentAndWithCategory(
                [],
                $page,
                $size,
                'id',
                'desc',
                ['id', 'slug', 'address' , 'amount', 'name', 'phone', 'category_id', 'featured_image']
            );
            $products = $products->map(function ($product) {
                $product->thumb = $product->getThumbnailUrl('thumb');
                $product->thumb150 = $product->getThumbnailUrl('thumb-150');
                $product->thumb350 = $product->getThumbnailUrl('thumb-350');
                return $product;
            });
            return response($products, 200);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function myProducts(Request $request)
    {
        $size = $request->size ? : 5;
        $page = $request->page ? : 1;
        try {
            $products = $this->productRepo->listProductsWithCountCommentAndWithCategory(
                ['user_id' => $this->user->id],
                $page,
                $size,
                'id',
                'desc',
                ['id', 'slug', 'address' , 'amount', 'name', 'phone', 'category_id', 'featured_image']
            );
            $products = $products->map(function ($product) {
                $product->thumb = $product->getThumbnailUrl('thumb');
                $product->thumb150 = $product->getThumbnailUrl('thumb-150');
                $product->thumb350 = $product->getThumbnailUrl('thumb-350');
                return $product;
            });
            return response($products, 200);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function myBookmark(Request $request)
    {
        $size = $request->size ? : 5;
        $page = $request->page ? : 1;
        try {
            $bookmarks = $this->bookmarkRepo->listBookmarkByUserId($this->user->id, $page, $size);
            $bookmarks = $bookmarks->map(function ($bookmark) {
                $bookmark->product->thumb = $bookmark->product->getThumbnailUrl('thumb');
                $bookmark->product->thumb150 = $bookmark->product->getThumbnailUrl('thumb-150');
                $bookmark->product->thumb350 = $bookmark->product->getThumbnailUrl('thumb-350');
                $bookmark->product->category;
                return $bookmark;
            });
            return response($bookmarks, 200);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function createProduct(Request $request)
    {
        $messages = [
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'name.max' => 'Tên sản phẩm quá dài (Tối đa 255 kí tự)',
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
            $product = $this->productRepo->createProduct($data);
            if ($request->get('images')) {
                $product->clearMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'));
                foreach ($request->get('images') as $key => $file) {
                    $media = $product->addMediaFromBase64($file)
                        ->usingFileName(Str::random(20).'.jpg')
                        ->toMediaCollection(env('COLLECTION_NAME_DETAIL_IMAGES'));
                    if ($key == 0) {
                        $productRepo = new ProductRepository($product);
                        $productRepo->updateProduct(['featured_image' => $media->id]);
                    }
                }
            }
            if ($request->get('services')) {
                $productServices = [];
                foreach ($request->get('services') as $serviceId) {
                    $productServices[] = ['product_id' => $product->id, 'service_id' => $serviceId];
                }
                $response = $this->productServiceRepo->createProductServices($productServices);
                Log::debug('response: '.$response);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
        DB::commit();
        return response(['status' => 200, 'message' => 'thêm mới sản phẩm thành công!'], 200);
    }

    public function detailProduct($slug, $id)
    {
        $product = $this->productRepo->findProductById($id);
        if ($product->slug != $slug) {
            abort(500, 'Sản phẩm không tồn tại');
        }
        if (!empty($this->user)) {
            $liked = $this->likeRepo->isProductLikedByUser($this->user->id, $id);
            $unliked = $this->likeRepo->isProductUnlikedByUser($this->user->id, $id);
            $report = $this->reportRepo->isProductReportedByUser($this->user->id, $id);
            $bookmark = $this->bookmarkRepo->isProductBookmarkedByUser($this->user->id, $id);
        }
        $product['liked'] = isset($liked) ? $liked : false;
        $product['unliked'] = isset($unliked) ? $unliked : false;
        $product['report'] = isset($report) ? $report : false;
        $product['bookmark'] = isset($bookmark) ? $bookmark : false;
        return response($product, 200);
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
            $products = $this->productRepo->listProductsNearBy($lat, $long, $page, $size);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($products, 200);
    }
}
