<?php
namespace App\Observers;

use App\Comment;
use App\Like;
use App\Notification;
use App\Product;
use App\User;

/**
 * Class LikeObserver
 * @property User | Product model
 * @package App\Observers
 */
class LikeObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Like $like
     * @return void
     */
    public function created(Like $like)
    {
        // create notification
        if ($like->model_type == get_class(new Product) && $like->type == env('TYPE_LIKE')) {
            $notification = [
                'model_type'  => $like->model_type,
                'model_id' => $like->model_id,
                'creator' => $like->user_id, // user_id like product
                'receiver' => $like->model->user_id,
                'message_type_id' => env('MESSAGE_TYPE_LIKE_PRODUCT')
            ];
            $notification = Notification::firstOrCreate($notification);
        }
        if ($like->model_type == get_class(new Comment)) {
            $notification = [
                'model_type'  => $like->model_type,
                'model_id' => $like->model_id,
                'creator' => $like->user_id, // user_id like comment
                'receiver' => $like->model->user_id,
                'message_type_id' => env('MESSAGE_TYPE_LIKE_COMMENT')
            ];
            $notification = Notification::firstOrCreate($notification);
        }
    }
}
