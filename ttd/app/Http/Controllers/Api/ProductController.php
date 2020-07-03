<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductService;
use App\Requests\CreateProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
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
                $product->clearMediaCollection('detail-images');
                foreach ($request->get('images') as $key => $file) {
                    $media = $product->addMediaFromBase64($file)->usingFileName(Str::random(20).'.jpg')->toMediaCollection('detail-images');
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
            return ['status' => 400, 'message' => $exception->getMessage()];
        }
        DB::commit();
        return ['status' => 200, 'message' => 'thêm mới sản phẩm thành công!'];
    }
}
