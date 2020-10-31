<?php
namespace App\Repositories;

use App\Exceptions\ProductCreateErrorException;
use App\Exceptions\ProductNotFoundException;
use App\Exceptions\ProductUpdateErrorException;
use App\Product;
use App\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use ProductTransformable;
    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }

    public function createProduct(array $data): Product
    {
        // TODO: Implement createProduct() method.
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e);
        }
    }

    public function updateProduct(array $data): bool
    {
        try {
            return $this->model->find($this->model->id)->update($data);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }

    public function findProductById(int $id, $transform = true): Product
    {
        // TODO: Implement findProductBySlug() method.
        try {
            if ($transform) {
                return $this->transformProduct($this->findOneOrFail($id));
            }
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->all($columns, $order, $sort);
    }

    public function listProductsWithCountCommentAndWithCategory(
        array $condition = [],
        int $page = 1,
        int $size = 10,
        string $order = 'id',
        string $sort = 'desc',
        array $columns = ['*']
    ): Collection {
        $skip = $page * $size - $size;
        return $this->model->where($condition)->select($columns)->withCount('comments')->with('category')->orderBy($order, $sort)->skip($skip)->take($size)->get();
    }

    /**
     * @param string $lat
     * @param string $long
     * @param int $page
     * @param int $size
     * @return array
     */
    public function listProductsNearBy(string $lat, string $long, int $page = 1, int $size = 10): array
    {
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
        $products = DB::select($string, [$lat, $long]);
        foreach ($products as $key => $product) {
            $newProduct = Product::withCount('comments')->find($product->id);
            $product->thumb = $newProduct->getThumbnailUrl('thumb');
            $product->thumb150 = $newProduct->getThumbnailUrl('thumb-150');
            $product->thumb350 = $newProduct->getThumbnailUrl('thumb-350');
            $product->category = $newProduct->category;
            $product->comments_count = $newProduct->comments_count;
            $products[$key] = $product;
        }
        return $products;
    }
}
