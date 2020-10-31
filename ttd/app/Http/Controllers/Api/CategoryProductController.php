<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository, Request $request)
    {
        $this->productRepo = $productRepository;
        $this->page = $request->page ? : 1;
        $this->size = $request->size ? : 5;
    }

    public function index($id)
    {
        try {
            $products = $this->productRepo->listProductsWithCountCommentAndWithCategory(
                ['category_id' => $id],
                $this->page,
                $this->size,
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
}
