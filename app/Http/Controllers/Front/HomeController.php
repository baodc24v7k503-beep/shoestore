<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $products = Product::where('is_featured', 0)->orderByDesc('id')->paginate(6);
        $products_featured = Product::where('is_featured', 1)->orderByDesc('id')->paginate(6);
        $categories = Category::orderByDesc('id')->get();
        return view('index', compact('categories','products','products_featured'));
    }

    public function category(Request $request, $slug){
        $categories = Category::orderByDesc('id')->get();
        $category = Category::where('id', $slug)->orWhere('slug', $slug)->firstOrFail();
        $query = Product::where('category_id', $category->id);
        $effectivePrice = DB::raw('CASE WHEN sale_price IS NOT NULL AND sale_price > 0 THEN sale_price ELSE price END');
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy($effectivePrice, 'asc'); 
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy($effectivePrice, 'desc'); 
            } else {
                $query->orderByDesc('id'); 
            }
        } else {
            $query->orderByDesc('id');
        }
        $product_category = $query->paginate(6)->appends($request->all()); 
        return view('category', compact('categories','category','product_category'));
    }

    public function product($id){
        $product = Product::where('id', $id)->orWhere('slug', $id)->firstOrFail();
        $related_products = Product::where('id', '!=', $product->id)->take(4)->get();
        $categories = Category::orderByDesc('id')->get();
        return view('product', compact('categories', 'product', 'related_products'));
    }

    public function getVariants($id)
    {
        $variants = ProductVariant::where('product_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'variants' => $variants
        ]);
    }

    public function login(){
        $categories = Category::orderByDesc('id')->get();
        return view('login', compact('categories'));
    }

    public function register(){
        $categories = Category::orderByDesc('id')->get();
        return view('register', compact('categories'));
    }

    public function contact(){
        $categories = Category::orderByDesc('id')->get();
        return view('contact', compact('categories'));
    }

    public function cart(){
        $categories = Category::orderByDesc('id')->get();
        return view('cart', compact('categories'));
    }

    public function faq(){
        $categories = Category::orderByDesc('id')->get();
        return view('faq', compact('categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::orderByDesc('id')->get(); 
        $query = Product::query();
        if ($request->filled('keywords')) {
            $query->where('name_pd', 'like', '%' . $request->keywords . '%');
        }
        $effectivePrice = DB::raw('CASE WHEN sale_price IS NOT NULL AND sale_price > 0 THEN sale_price ELSE price END');
        if ($request->filled('min_price')) {
            $query->where($effectivePrice, '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where($effectivePrice, '<=', $request->max_price);
        }
        $products = $query->orderByDesc('id')->paginate(12)->appends($request->all());
        return view('search', compact('categories', 'products'));
    }
}