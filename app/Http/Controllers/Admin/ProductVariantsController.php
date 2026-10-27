<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_Variants;
use Illuminate\Support\Str;
use File;

class ProductVariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $product = Product::with('variants')->findOrFail($product_id);
        return view('admincp.products_variants.create', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderByDesc('id')->get();
        return view('admincp.products_variants.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'size' => 'required',
            'stock_quantity' => 'required|numeric',
        ]);

        $product = Product::findOrFail($product_id);
        
        $product->variants()->create([
            'size' => $request->size,
            'color' => $request->color,
            'stock_quantity' => $request->stock_quantity,
            'price' => $request->price,
            'sku' => $request->sku ?? strtoupper($product->slug . '-' . $request->size),
        ]);

        return redirect()->back()->with('success', 'Thêm biến thể thành công!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id, $id)
    {
        $variant = Product_Variants::where('product_id', $product_id)->findOrFail($id);
        $variant->delete();

        return redirect()->back()->with('success', 'Xóa biến thể thành công!');
    }

    public function getVariants($id)
    {
        // Sử dụng đúng Model Product_Variants
        $variants = Product_Variants::where('product_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'variants' => $variants
        ]);
    }
}
