<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;

class ReportController extends Controller
{
    public function view(Report $report)
    {
        $images = [];
        foreach ($report->images as $key => $image) {
            $images[$key]['thumb'] = $image->getUrl('thumb');
            $images[$key]['origin'] = $image->getUrl();
        }
        $report->reportImages = $images;
        $report->infomation = json_decode($report->properties);
        return $report;
    }
}
