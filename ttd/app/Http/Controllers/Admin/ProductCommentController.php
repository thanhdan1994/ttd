<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use App\Report;
use App\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function create(Product $product)
    {
        return view('admin.product-comment.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Requests\CreateCommentRequest $request
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function store(CreateCommentRequest $request, Product $product)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = Auth::id();
        $data['product_id'] = $product->id;
        DB::beginTransaction();
        try {
            Comment::create($data);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Có lỗi trong quá trình tạo comment!' . ' ' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.products.show', $product->id)->with('message', 'Tạo mới comment thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
