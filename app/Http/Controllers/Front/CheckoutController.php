<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use DB;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    // 1. Hiển thị trang Thanh toán
    public function checkout()
    {
        $cartCollection = Cart::getContent();
        
        if ($cartCollection->isEmpty()) {
            return redirect()->route('gio-hang')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $total = Cart::getTotal();
        $categories = Category::all();

        return view('checkout', compact('cartCollection', 'total', 'categories'));
    }

    // 2. Xử lý đặt hàng
    public function process(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'address' => 'required|string|max:500',
        ], [
            'name.required'    => 'Vui lòng nhập họ tên',
            'phone.required'   => 'Vui lòng nhập số điện thoại',
            'email.required'   => 'Vui lòng nhập email hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng',
        ]);

        $cartCollection = Cart::getContent();
        if ($cartCollection->isEmpty()) {
            return redirect()->route('gio-hang');
        }

        // --- BẮT ĐẦU TÍNH TOÁN MÃ GIẢM GIÁ ---
        $subtotal = Cart::getTotal();
        $discount = 0;
        $couponModel = null;

        if (session()->has('coupon')) {
            $sessionCoupon = session()->get('coupon');
            
            $couponModel = Coupon::where('code', $sessionCoupon['code'])->where('status', 1)->first();

            if ($couponModel) {
                if ($couponModel->type == 'fixed') {
                    $discount = $couponModel->value;
                } elseif ($couponModel->type == 'percent') {
                    $discount = ($subtotal * $couponModel->value) / 100;
                }
            }
        }

        $finalTotal = max(0, $subtotal - $discount);
        // --- KẾT THÚC TÍNH TOÁN ---

        // Chuẩn hóa dữ liệu lưu chuẩn theo DB hiện tại của bạn
        $paymentMethod = $request->payment_method ?? 'cod';
        
        // Trạng thái thanh toán
        $paymentStatus = ($paymentMethod == 'e-wallet') ? 'Đã thanh toán' : 'Chưa thanh toán';

        DB::beginTransaction();
        try {
            // Lưu thông tin đơn hàng
            $order = Order::create([
                'name'           => $request->name,
                'email'          => $request->email,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'note'           => $request->note,
                'total_price'    => $finalTotal,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,       // 'Chưa thanh toán' nếu COD, 'Đã thanh toán' nếu e-wallet
                'status'         => 'Chưa nhận hàng',      // Khớp trực tiếp với các dòng cũ trong DB
            ]);

            // Lưu chi tiết các sản phẩm trong đơn hàng
            foreach ($cartCollection as $item) {
                $productId = explode('-', $item->id)[0];

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $productId,
                    'product_name' => $item->name,
                    'size'         => $item->attributes->size ?? null,
                    'color'        => $item->attributes->color ?? null,
                    'price'        => $item->price,
                    'quantity'     => $item->quantity,
                ]);
            }

            // Trừ số lượng coupon sử dụng
            if ($couponModel && $couponModel->quantity !== null && $couponModel->quantity > 0) {
                $couponModel->decrement('quantity');
            }

            DB::commit();

            // Xóa giỏ hàng và Session coupon
            Cart::clear();
            session()->forget('coupon');

            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi xử lý đơn hàng. Vui lòng thử lại! ' . $e->getMessage());
        }
    }

    // 3. Trang đặt hàng thành công
    public function success()
    {
        $categories = Category::all();
        return view('checkout_success', compact('categories'));
    }

    // 4. Hàm Áp dụng mã giảm giá
    public function applyCoupon(Request $request)
    {
        $code = strtoupper(trim($request->coupon_code));
        $today = date('Y-m-d');

        $coupon = Coupon::where('code', $code)->where('status', 1)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại hoặc đã bị khóa!');
        }

        if ($coupon->start_date && $coupon->start_date > $today) {
            return redirect()->back()->with('error', 'Mã giảm giá chưa đến ngày sử dụng!');
        }
        if ($coupon->end_date && $coupon->end_date < $today) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn!');
        }

        if ($coupon->quantity !== null && $coupon->quantity <= 0) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng!');
        }

        session()->put('coupon', [
            'code'  => $coupon->code,
            'type'  => $coupon->type,
            'value' => $coupon->value,
        ]);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    // 5. Hàm Xóa mã giảm giá
    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Đã xóa mã giảm giá!');
    }
}