<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use App\Models\Coupon; 

class CartController extends Controller
{
    public function add(Request $request){
        $id = $request->product_id;
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }
        $price = ($product->sale_price && $product->sale_price > 0) 
                    ? $product->sale_price 
                    : $product->price;
        Cart::add(array(
            'id' => $product->id, 
            'name' => $product->name_pd,
            'price' => $price, // Đã cập nhật tính giá chính xác
            'quantity' => $request->quantity ?? 1,
            'attributes' => [
                'image' => $product->image,
                'size' => $request->size ?? 'N/A',
                'color' => $request->color ?? 'N/A',
                'original_price' => $product->price // Lưu trữ thêm giá gốc nếu cần hiển thị
            ]
        ));
        return redirect()->route('gio-hang')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    public function update(Request $request){
        $id = $request->product_id;
        Cart::update($id, [
            'quantity' => [
                'relative' => false,    
                'value'    => $request->product_quantity,
            ]            
        ]);
        return redirect()->back()->with('success', 'Đã cập nhật số lượng thành công!');
    }

    public function delete($id){
        Cart::remove($id);
        return redirect()->route('gio-hang')->with('success', 'Đã xóa sản phẩm trong giỏ hàng thành công');
    }

    public function applyCoupon(Request $request)
    {
        $code = trim($request->coupon_code);
        $coupon = Coupon::where('code', $code)->where('status', 1)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại hoặc đã bị ẩn!');
        }

        $now = now();
        if ($coupon->start_date && $now->lt($coupon->start_date)) {
            return redirect()->back()->with('error', 'Mã giảm giá chưa đến thời gian áp dụng!');
        }
        if ($coupon->end_date && $now->gt($coupon->end_date)) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn sử dụng!');
        }

        if ($coupon->quantity !== null && $coupon->used_count >= $coupon->quantity) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng!');
        }
        session()->put('coupon', [
            'id'    => $coupon->id,
            'code'  => $coupon->code,
            'type'  => $coupon->type, 
            'value' => $coupon->value, 
        ]);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
    }
}