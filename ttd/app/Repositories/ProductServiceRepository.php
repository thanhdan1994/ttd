<?php
namespace App\Repositories;

use App\ProductService;
use App\Repositories\Interfaces\ProductServiceRepositoryInterface;

class ProductServiceRepository extends BaseRepository implements ProductServiceRepositoryInterface
{
    public function __construct(ProductService $productService)
    {
        parent::__construct($productService);
        $this->model = $productService;
    }

    public function createProductServices(array $services): bool
    {
        return $this->insert($services);
    }
}
