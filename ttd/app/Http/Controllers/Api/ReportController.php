<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;

class ReportController extends Controller
{
    public function view(Report $report)
    {
        try {
            $images = [];
            foreach ($report->images as $key => $image) {
                $images[$key]['thumb'] = $image->getUrl('thumb');
                $images[$key]['origin'] = $image->getUrl();
            }
            $report->reportImages = $images;
            $report->infomation = json_decode($report->properties);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
        return response($report, 200);
    }
}
