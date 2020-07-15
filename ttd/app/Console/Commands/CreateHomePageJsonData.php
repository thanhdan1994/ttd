<?php

namespace App\Console\Commands;

use App\Product;
use App\Traits\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateHomePageJsonData extends Command
{
    use File;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:homepage-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo dữ liệu initial cho trang chủ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('hihihihihihihihi '. time());
        $products = Product::withCount('comments')
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $homepageData['total_pages'] = $products->lastPage();
        $homepageData['current_page'] = $products->currentPage();
        $homepageData['per_page'] = $products->count();
        $products = $products->map(function (Product $product) {
            $product->thumb = $product->getThumbnailUrl('thumb');
            $product->thumb150 = $product->getThumbnailUrl('thumb-150');
            $product->thumb350 = $product->getThumbnailUrl('thumb-350');
            return $product;
        });
        $homepageData['data'] = $products;
        $this->create('homepage.json', json_encode($homepageData), 'api');
        echo '...............CREATE homepage.json SUCCESS...............';
    }
}
