<?php
namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    public function listCommentsWithCountLikeAndUnlike(
        array $condition = [],
        int $page = 1,
        int $size = 10,
        string $order = 'id',
        string $sort = 'desc',
        array $columns = ['*']
    ) : Collection;

    public function createComment(array $attribute);
}
