<?php
namespace App\Repositories\Interfaces;

interface ProductServiceRepositoryInterface extends BaseRepositoryInterface
{
    public function createProductServices(array $services) : bool;
}
