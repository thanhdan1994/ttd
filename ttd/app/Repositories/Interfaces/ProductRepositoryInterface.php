<?php
namespace App\Repositories\Interfaces;

use App\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function createProduct(array $data) : Product;

    public function updateProduct(array $data) : bool;

    public function findProductById(int $id, $transform = true) : Product;

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;

    public function listProductsWithCountCommentAndWithCategory(
        array $condition = [],
        int $page = 1,
        int $size = 10,
        string $order = 'id',
        string $sort = 'desc',
        array $columns = ['*']
    ) : Collection;

    public function listProductsNearBy(string $lat, string $long, int $page = 1, int $size = 10) : array;
}
