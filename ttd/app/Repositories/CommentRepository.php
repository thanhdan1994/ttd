<?php
namespace App\Repositories;

use App\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Collection;
use Mockery\Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
        $this->model = $comment;
    }

    /**
     * @param array $condition
     * @param int $page
     * @param int $size
     * @param string $order
     * @param string $sort
     * @param array|string[] $columns
     * @return Collection
     */
    public function listCommentsWithCountLikeAndUnlike(array $condition = [], int $page = 1, int $size = 10, string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        $skip = $page * $size - $size;
        return $this->model->where($condition)->select($columns)->withCount(['like', 'unlike'])->orderBy($order, $sort)->skip($skip)->take($size)->get();
    }

    /**
     * @param array $attribute
     * @return mixed
     */
    public function createComment(array $attribute)
    {
        try {
            $this->create($attribute);
        } catch (Exception $exception) {
            throw new InternalErrorException($exception->getMessage());
        }
    }
}
