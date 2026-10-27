<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product_Variants; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('admincp.orders.list', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admincp.orders.detail', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Đã xóa đơn hàng thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::with('items')->findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = $request->status;

        if ($oldStatus !== $newStatus) {
            DB::transaction(function () use ($order, $oldStatus, $newStatus) {

                // 1. Chuyển sang "Đã nhận hàng": TRỪ tồn kho & ĐỒNG BỘ TRẠNG THÁI THANH TOÁN
                if ($newStatus == 'Đã nhận hàng') {
                    foreach ($order->items as $item) {
                        $variant = Product_Variants::where('product_id', $item->product_id)
                            ->where('size', $item->size)
                            ->where('color', $item->color)
                            ->first();

                        if ($variant) {
                            $variant->decrement('stock_quantity', $item->quantity);
                        }
                    }

                    // Tự động chuyển sang Đã thanh toán khi giao hàng thành công
                    $order->payment_status = 'Đã thanh toán';
                } 
                
                // 2. Chuyển từ "Đã nhận hàng" sang trạng thái khác: CỘNG TRẢ tồn kho
                elseif ($oldStatus == 'Đã nhận hàng' && $newStatus != 'Đã nhận hàng') {
                    foreach ($order->items as $item) {
                        $variant = Product_Variants::where('product_id', $item->product_id)
                            ->where('size', $item->size)
                            ->where('color', $item->color)
                            ->first();

                        if ($variant) {
                            $variant->increment('stock_quantity', $item->quantity);
                        }
                    }

                    if ($newStatus == 'Trả hàng, hoàn tiền' || $newStatus == 'Đã hủy') {
                        $order->payment_status = 'Đã hủy / Hoàn tiền';
                    }
                }

                // Cập nhật trạng thái đơn hàng
                $order->status = $newStatus;
                $order->save();
            });
        }

        return redirect()->back()->with('success', 'Đã cập nhật trạng thái và tồn kho thành công!');
    }

    public function updatePaymentStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        
        // Sửa điều kiện check: Kiểm tra cả 'e-wallet', 'Ví điện tử', hoặc hỗ trợ đổi cho COD nếu Admin muốn duyệt
        $allowedMethods = ['e-wallet', 'Ví điện tử', 'cod', 'COD'];

        if (in_array($order->payment_method, $allowedMethods)) {
            $order->payment_status = $request->payment_status;
            $order->save();

            return response()->json([
                'success' => true, 
                'message' => 'Cập nhật trạng thái thanh toán thành công!'
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'Không thể cập nhật trạng thái thanh toán!'
        ]);
    }
}