<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
    
        // Trả về view home (tương ứng với home.blade.php)
        return view('home', compact('products'));
    }
}