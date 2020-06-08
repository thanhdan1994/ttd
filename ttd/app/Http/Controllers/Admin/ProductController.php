<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Requests\CreateProductRequest;
use App\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::loggedUser()
            ->orderBy('created_at', 'desc')
            ->paginate(config('constants.admin.paginate'));
        if (request()->has('q') && request()->input('q') != '') {
            $products = Product::search(request()->input('q'))
                ->loggedUser()
                ->orderBy('created_at', 'desc')
                ->paginate(config('constants.admin.paginate'));
        }
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Requests\CreateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->except(['_token', 'status', 'featured_image']);
        $data['status'] =  $request->get('status') ? true : false;
        $data['slug'] = Str::slug($request->get('name'));
        $data['user_id'] = Auth::id();
        $product = Product::create($data);
        if ($request->file('featured_image')) {
            $media = $product
                ->addMedia($request->featured_image)
                ->toMediaCollection('images');
            $product->featured_image = $media->id;
            $product->save();
        }
        if ($request->file('images')) {
            $product->clearMediaCollection('detail-images');
            foreach ($request->file('images') as $file) {
                $product->addMedia($file)->toMediaCollection('detail-images');
            }
        }
        return redirect()->route('admin.products.index')->with('message', 'Tạo mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\UpdateProductRequest  $request
     * @param  int  $id
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $data = $request->except('_token', '_method', 'featured_image', 'images');
        $data['slug'] = Str::slug($request->input('name'));
        $data['status'] =  $request->get('status') ? true : false;
        $product->update($data);
        if ($request->file('featured_image')) {
            $media = $product
                ->addMedia($request->featured_image)
                ->toMediaCollection('images');
            $product->featured_image = $media->id;
            $product->save();
        }
        if ($request->file('images')) {
            $product->clearMediaCollection('detail-images');
            foreach ($request->file('images') as $file) {
                $product->addMedia($file)->toMediaCollection('detail-images');
            }
        }
        return redirect()->route('admin.products.index')->with('message', 'Cập nhập thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('message', 'Đã xóa #'. $product->id);
    }
}
