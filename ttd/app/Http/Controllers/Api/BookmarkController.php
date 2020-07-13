<?php
namespace App\Http\Controllers\Api;

use App\Bookmark;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $size = 10;
        if ($request->size) {
            $size = $request->size;
        }
        $bookmarks = Bookmark::where([
            'user_id' => $request->user()->id
        ])->orderBy('created_at', 'desc')->paginate($size);
        $data['total_pages'] = $bookmarks->lastPage();
        $data['current_page'] = $bookmarks->currentPage();
        $data['per_page'] = $bookmarks->count();
        $bookmarks = $bookmarks->map(function (Bookmark $bookmark) {
            $bookmark->product->thumb = $bookmark->product->getThumbnailUrl('thumb');
            $bookmark->product->thumb150 = $bookmark->product->getThumbnailUrl('thumb-150');
            $bookmark->product->thumb350 = $bookmark->product->getThumbnailUrl('thumb-350');
            $bookmark->product->category;
            return $bookmark;
        });
        $data['data'] = $bookmarks;
        return response($bookmarks, 200);
    }
}
