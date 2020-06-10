<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')
            ->paginate(config('constants.admin.paginate'));
        if (request()->has('q') && request()->input('q') != '') {
            $categories = Category::search(request()->input('q'))
                ->orderBy('created_at', 'desc')
                ->paginate(config('constants.admin.paginate'));
        }
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->except('_token', 'featured_image');
        $data['slug'] = Str::slug($request->input('name'));
        DB::beginTransaction();
        try {
            $category = Category::create($data);
            if ($request->file('featured_image')) {
                $media = $category
                    ->addMedia($request->featured_image)
                    ->toMediaCollection('images');
                $category->featured_image = $media->id;
                $category->save();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Có lỗi trong quá trình tạo chuyên mục! ' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.index')->with('message', 'Cập nhật thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->except('_token', '_method', 'featured_image');
        $data['slug'] = Str::slug($request->input('name'));
        DB::beginTransaction();
        try {
            $category->update($data);
            if ($request->file('featured_image')) {
                $media = $category
                    ->addMedia($request->featured_image)
                    ->toMediaCollection('images');
                $category->featured_image = $media->id;
                $category->save();
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Có lỗi trong quá trình cập nhật! ' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.index')->with('message', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
