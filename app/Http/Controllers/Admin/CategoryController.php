<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(5);
        return view('admincp.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:categories|max:200',
            'slug' => 'required|unique:categories|max:200',
            'description' => 'required|max:200',
            'status' => 'required',
        ],[
            'name.required'=> 'Bạn chưa điền tên danh mục!!',
            'name.unique' => 'Tên danh mục không được trùng!!',
            'slug.required'=> 'Bạn chưa điền hãng!!',
            'slug.unique' => 'Tên hãng không được trùng!!',
            'description.required'=> 'Bạn chưa điền mô tả!!',
        ]);
        //dd($data);
        $category = new Category();
        $category->name = $validate['name'];
        $category->slug = $validate['slug'];
        $category->description = $validate['description'];
        $category->status = $validate['status'];
        $category->save();
        return redirect()->route('categories.index')->with('success','Cập nhật danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admincp.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|unique:categories|max:200',
            'slug' => 'required|unique:categories|max:200',
            'description' => 'required|max:200',
            'status' => 'required',
        ],[
            'name.required'=> 'Bạn chưa điền tên danh mục!!',
            'name.unique' => 'Tên danh mục không được trùng!!',
            'slug.required'=> 'Bạn chưa điền hãng!!',
            'slug.unique' => 'Tên hãng không được trùng!!',
            'description.required'=> 'Bạn chưa điền mô tả!!',
        ]);
        //dd($data);
        $category = Category::find($id);
        $category->name = $validate['name'];
        $category->slug = $validate['slug'];
        $category->description = $validate['description'];
        $category->status = $validate['status'];
        $category->save();
        return redirect()->route('categories.index')->with('success','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category -> delete();
        return redirect()->route('categories.index')->with('success','Xóa danh mục thành công');
    }
}
