<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Interfaces\BookmarkRepositoryInterface;

class ProductBookmarkController extends ApiController
{
    private $bookmarkRepo;

    public function __construct(BookmarkRepositoryInterface  $bookmarkRepository)
    {
        parent::__construct();
        $this->bookmarkRepo = $bookmarkRepository;
    }

    public function bookmark($productId)
    {
        try {
            $bookmark = $this->bookmarkRepo->bookmarkProductByUser($this->user->id, $productId);
            return response($bookmark,200);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    public function unbookmark($productId)
    {
        try {
            $this->bookmarkRepo->unbookmarkProductByUser($this->user->id, $productId);
            return response(null, 200);
        } catch (\Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }
}
