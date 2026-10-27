@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 font-weight-bold" style="color: #1e293b; font-size: 24px;">Chi tiết đơn hàng #{{ $order->id }}</h3>
        <a href="{{ route('orders.index') }}" class="btn btn-sm" style="background-color: #64748b; color: #fff; border-radius: 6px; padding: 6px 14px; font-weight: 500;">« Quay lại danh sách</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 mb-4" style="border-radius: 8px;">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- THÔNG TIN GIAO HÀNG --}}
        <div class="col-md-5 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background-color: #fff;">
                <div class="card-body p-4">
                    <h6 class="font-weight-bold text-uppercase mb-4 d-flex align-items-center" style="color: #334155; font-size: 13px; letter-spacing: 0.5px;">
                        <span style="font-size: 16px; margin-right: 8px;">👤</span> THÔNG TIN GIAO HÀNG
                    </h6>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Mã đơn hàng</span>
                        <span class="font-weight-bold" style="color: #0284c7; font-size: 14px;">#{{ $order->id }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Người nhận</span>
                        <span class="font-weight-bold" style="color: #334155; font-size: 14px;">{{ $order->name }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Số điện thoại</span>
                        <span class="font-weight-bold" style="color: #334155; font-size: 14px;">{{ $order->phone }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Email</span>
                        <span class="font-weight-bold" style="color: #334155; font-size: 14px;">{{ $order->email ?? ($order->user->email ?? 'N/A') }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Địa chỉ giao hàng</span>
                        <span class="font-weight-bold text-right" style="color: #334155; font-size: 14px; max-width: 60%;">{{ $order->address ?? 'N/A' }}</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span style="color: #64748b; font-size: 14px;">Ghi chú</span>
                        <span style="color: #64748b; font-size: 14px;">{{ $order->note ?? 'Không có ghi chú' }}</span>
                    </div>

                    <div style="border-bottom: 1px dashed #e2e8f0;" class="mb-4"></div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Phương thức thanh toán</span>
                        <span class="badge" style="background-color: #64748b; color: #fff; padding: 5px 10px; border-radius: 6px; font-weight: 600; font-size: 11px;">
                            {{ strtoupper($order->payment_method ?? 'COD') }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span style="color: #64748b; font-size: 14px;">Trạng thái thanh toán</span>
                        <span class="badge d-flex align-items-center" style="background-color: #fef3c7; color: #d97706; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 12px;">
                            <span style="margin-right: 4px;">🕒</span> {{ $order->payment_status ?? 'Chưa thanh toán' }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span style="color: #64748b; font-size: 14px;">Trạng thái đơn hàng</span>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="m-0">
                            @csrf
                            <select name="status" onchange="this.form.submit()" 
                                    style="background-color: #e0f2fe; color: #0284c7; border: none; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 12px; cursor: pointer; outline: none;">
                                <option value="Chưa nhận hàng" {{ $order->status == 'Chưa nhận hàng' ? 'selected' : '' }}>Chưa nhận hàng</option>
                                <option value="Đã nhận hàng" {{ $order->status == 'Đã nhận hàng' ? 'selected' : '' }}>Đã nhận hàng</option>
                                <option value="Trả hàng, hoàn tiền" {{ $order->status == 'Trả hàng, hoàn tiền' ? 'selected' : '' }}>Trả hàng, hoàn tiền</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- SẢN PHẨM ĐÃ ĐẶT --}}
        <div class="col-md-7 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; background-color: #fff;">
                <div class="card-body p-4">
                    <h6 class="font-weight-bold text-uppercase mb-4 d-flex align-items-center" style="color: #334155; font-size: 13px; letter-spacing: 0.5px;">
                        <span style="font-size: 16px; margin-right: 8px;">🛒</span> SẢN PHẨM ĐÃ ĐẶT
                    </h6>

                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead>
                                <tr style="color: #94a3b8; font-size: 11px; text-transform: uppercase; border-bottom: 1px solid #f1f5f9;">
                                    <th style="padding-left: 0; font-weight: 600;">SẢN PHẨM</th>
                                    <th class="text-center" style="font-weight: 600;">ĐƠN GIÁ</th>
                                    <th class="text-center" style="font-weight: 600;">SỐ LƯỢNG</th>
                                    <th class="text-right" style="padding-right: 0; font-weight: 600;">THÀNH TIỀN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr style="border-bottom: 1px solid #f8fafc;">
                                    <td style="padding-left: 0; padding-top: 18px; padding-bottom: 18px;">
                                        <div class="d-flex align-items-center">
                                            @php
                                                $img = $item->product->image ?? '';
                                                if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                                                    $imgUrl = $img;
                                                } elseif (str_starts_with($img, 'uploads/')) {
                                                    $imgUrl = asset($img);
                                                } elseif (!empty($img)) {
                                                    $imgUrl = asset('uploads/products/' . ltrim($img, '/'));
                                                } else {
                                                    $imgUrl = 'https://via.placeholder.com/52';
                                                }
                                            @endphp

                                            <div style="width: 52px; height: 52px; border-radius: 10px; overflow: hidden; background-color: #f8fafc; margin-right: 12px; flex-shrink: 0; border: 1px solid #f1f5f9;">
                                                <img src="{{ $imgUrl }}" 
                                                     alt="Product" 
                                                     style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>

                                            <div>
                                                <div class="font-weight-bold" style="color: #334155; font-size: 13px; line-height: 1.3;">
                                                    {{ $item->product_name ?? ($item->product->name ?? 'Sản phẩm #'.$item->product_id) }}
                                                </div>
                                                <div class="mt-1 d-flex align-items-center">
                                                    @if(!empty($item->size))
                                                        <span style="background-color: #f1f5f9; color: #64748b; font-size: 11px; padding: 2px 8px; border-radius: 12px; margin-right: 6px;">
                                                            Size: {{ $item->size }}
                                                        </span>
                                                    @endif
                                                    @if(!empty($item->color))
                                                        <span style="background-color: #f1f5f9; color: #64748b; font-size: 11px; padding: 2px 8px; border-radius: 12px;">
                                                            Màu: {{ $item->color }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle" style="color: #64748b; font-size: 13px; white-space: nowrap;">
                                        {{ number_format($item->price, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="text-center align-middle font-weight-bold" style="color: #334155; font-size: 13px;">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-right align-middle font-weight-bold" style="color: #334155; padding-right: 0; font-size: 13px; white-space: nowrap;">
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-4 pt-3" style="border-top: 1px solid #f1f5f9;">
                        <span style="color: #334155; font-size: 15px; font-weight: 500;" class="mr-2">Tổng thanh toán: 
                            <span class="font-weight-bold text-danger h4 mb-0" style="color: #dc2626 !important; font-size: 18px;">
                                {{ number_format($order->total_price, 0, ',', '.') }} VNĐ
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection