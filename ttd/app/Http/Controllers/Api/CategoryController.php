<?php
namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where(['parent' => 0])->withCount('products')->get();
        return response($categories, 200);
    }
}
