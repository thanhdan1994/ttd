<?php
namespace App\Repositories\Interfaces;

interface ReportRepositoryInterface
{
    public function isProductReportedByUser(int $userId, int $productId) : bool;
}
