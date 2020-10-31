<?php
namespace App\Repositories;

use App\Report;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function __construct(Report $report)
    {
        parent::__construct($report);
        $this->model = $report;
    }

    public function isProductReportedByUser(int $userId, int $productId): bool
    {
        return $this->model->where([
            'user_id' => $userId,
            'product_id' => $productId
        ])->first() ? true : false;
    }
}
