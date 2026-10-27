<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;

class UserOrderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $userEmail = auth()->user()->email ?? null;

        if (!$userEmail) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng!');
        }

        $orders = Order::where('email', $userEmail)
                       ->orderBy('id', 'DESC')
                       ->paginate(10);

        return view('orders.order', compact('orders', 'categories'));
    }

    public function show($id)
    {
        $categories = Category::all();
        $userEmail = auth()->user()->email ?? null;

        // Đã thêm .product vào eager loading 'items.product' để load thông tin ảnh từ bảng Product
        $order = Order::with('items.product')
                      ->where('id', $id)
                      ->where('email', $userEmail) 
                      ->firstOrFail();

        return view('orders.detail_order', compact('order', 'categories'));
    }
}