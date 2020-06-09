<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Report;
use App\Requests\CreateReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductReportController extends Controller
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
        return view('admin.product-report.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Requests\CreateReportRequest $request
     * @param  \App\Product  $product
     * @return \Illuminate\View\View
     */
    public function store(CreateReportRequest $request, Product $product)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = Auth::id();
        $data['product_id'] = $product->id;
        DB::beginTransaction();
        try {
            $report = Report::create($data);
            if ($request->get('images-base64')) {
                $report->clearMediaCollection('detail-images');
                foreach ($request->get('images-base64') as $base64Image) {
                    $report->addMediaFromBase64($base64Image)->usingFileName(Str::random(20).'.jpg')->toMediaCollection('detail-images');
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Có lỗi trong quá trình tạo report!' . ' ' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.products.show', $product->id)->with('message', 'Tạo mới report thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
