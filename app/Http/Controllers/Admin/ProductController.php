<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(5);
        return view('admincp.products.list',compact('products',));
    }

    public function create()
    {
        $categories = Category::orderByDesc('id')->get();
        return view('admincp.products.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_pd' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'category_id' => 'required|exists:categories,id'
        ],[
            'name_pd.required'=> 'Bạn chưa điền tên sản phẩm!!',
            'price.required'=> 'Bạn chưa điền giá sản phẩm!!',
            'short_description.required'=> 'Bạn chưa điền mô tả ngắn về sản phẩm!!',
            'description.required'=> 'Bạn chưa điền mô tả!!',
        ]);
        
        $data = $request->all();
        $data = $request->except(['_token','_method']);

        $data['slug'] = Str::slug($request->name_pd);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        Product::create($data);
        return redirect()->route('products.create')->with('success','Tạo sản phẩm thành công');
    }

    public function show(string $id)
    {
        $product = Product::with(['category', 'variants'])->findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();

        return view('pages.product_detail', compact('product', 'related_products'));
        }

    public function edit(string $id)
    {
        
        $product = Product::findOrFail($id);
        $categories = Category::orderByDesc('id')->get();
        
        return view('admincp.products.edit',compact('categories','product'));
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_pd' => 'required',
            'price' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'category_id' => 'required|exists:categories,id'
        ],[
            'name_pd.required'=> 'Bạn chưa cập nhật tên sản phẩm!!',
            'price.required'=> 'Bạn chưa cập nhật giá sản phẩm!!',
            'short_description'=> 'Bạn chưa cập nhật mô tả ngắn về sản phẩm!!',
            'description.required'=> 'Bạn chưa cập nhật mô tả!!',
        ]);
        
        $data = $request->all();
        $data = $request->except(['_token','_method']);

        $data['slug'] = Str::slug($request->name_pd);
        $product = Product::find($id);

        if($request->hasFile('image')){

            if($product->image && File::exists(public_path('uploads/products/' . $product->image))){
                File::delete(public_path('uploads/products/' . $product->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success','Cập nhật sản phẩm thành công');
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product->image && File::exists(public_path('uploads/products/' . $product->image))){
            File::delete(public_path('uploads/products/' . $product->image));
        }
        $product -> delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }


    public function getVariants($id)
{
    $variants = \App\Models\ProductVariant::where('product_id', $id)->get();

    return response()->json([
        'status' => 'success',
        'variants' => $variants
    ]);
}
}
