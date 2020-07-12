<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\Report;
use Illuminate\Http\Request;;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductReportController extends Controller
{
    public function index(Product $product, Request $request)
    {
        $size = 5;
        if ($request->size) {
            $size = $request->size;
        }
        $reports = Report::where([
            'product_id' => $product->id,
            'status' => 1
        ])->orderBy('created_at', 'desc')->paginate($size);
        $data['total_pages'] = $reports->lastPage();
        $data['current_page'] = $reports->currentPage();
        $data['per_page'] = $reports->perPage();
        $data['total'] = $reports->total();
        $reports = $reports->map(function (Report $report) {
            $report->author = $report->author;
            return $report;
        });
        $data['data'] = $reports;
        return response($data, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param  \App\Product $product
     * @return \Illuminate\View\View
     */
    public function store(Request $request, Product $product)
    {
        $messages = [
            'excerpt.required' => 'Mô tả report chưa có nội dung',
        ];
        $validator = Validator::make($request->all(), [
            'excerpt' => 'required',
        ], $messages);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['product_id'] = $product->id;
        DB::beginTransaction();
        try {
            $report = Report::create($data);
            if ($request->get('images')) {
                $report->clearMediaCollection('detail-images');
                foreach ($request->get('images') as $base64Image) {
                    $report->addMediaFromBase64($base64Image)->usingFileName(Str::random(20).'.jpg')->toMediaCollection('detail-images');
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response(['message' => $exception->getMessage()], 400);
        }
        DB::commit();
        return response(['status' => 200, 'report' => $report], 200);
    }
}
