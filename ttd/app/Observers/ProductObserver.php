<?php
namespace App\Observers;

use App\Product;
use App\Traits\File;

class ProductObserver
{
    use File;
    /**
     * Handle the Product "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {

    }
}
