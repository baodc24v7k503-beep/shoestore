@extends('layout')

@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
            <li class="active">Thanh toán</li>
        </ol>
    </div>
</div>

<div class="checkout-page" style="padding: 30px 0;">
    <div class="container">
        <h2 style="margin-bottom: 25px; text-transform: uppercase; font-weight: bold;">Thông tin thanh toán</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @php
            $cartCollection = Cart::getContent();
            $subtotal = Cart::getTotal();
            $discount = 0;

            if (session()->has('coupon')) {
                $coupon = session()->get('coupon');
                if ($coupon['type'] == 'fixed') {
                    $discount = $coupon['value'];
                } elseif ($coupon['type'] == 'percent') {
                    $discount = ($subtotal * $coupon['value']) / 100;
                }
            }

            $total = max(0, $subtotal - $discount);
        @endphp

        <!-- FORM CHÍNH BAO BỌC TOÀN BỘ KHU VỰC THANH TOÁN -->
        <form action="{{ route('checkout.process') }}" method="POST" id="main-checkout-form">
            @csrf
            <div class="row">
                <!-- Cột trái: Thông tin người nhận -->
                <div class="col-md-7">
                    <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; border: 1px solid #ddd;">
                        <h4 style="margin-bottom: 20px; color: #333; border-bottom: 2px solid #fe9100; padding-bottom: 8px;">Thông tin người nhận</h4>

                        <div class="form-group">
                            <label>Họ và tên <span style="color:red;">*</span></label>
                            <input type="text" name="name" class="form-control" 
                                value="{{ old('name', auth()->user()->name ?? '') }}" 
                                placeholder="Nhập họ và tên..." required>
                            @error('name') <small style="color:red;">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại <span style="color:red;">*</span></label>
                                <input type="text" name="phone" class="form-control" 
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                                    placeholder="Nhập số điện thoại..." required>
                                @error('phone') <small style="color:red;">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Email <span style="color:red;">*</span></label>
                                <input type="email" name="email" class="form-control" 
                                    value="{{ old('email', auth()->user()->email ?? '') }}" 
                                    placeholder="Nhập email..." required>
                                @error('email') <small style="color:red;">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Địa chỉ giao hàng <span style="color:red;">*</span></label>
                            <input type="text" name="address" class="form-control" 
                                value="{{ old('address', auth()->user()->address ?? '') }}" 
                                placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành..." required>
                            @error('address') <small style="color:red;">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label>Ghi chú đơn hàng</label>
                            <textarea name="note" class="form-control" rows="3" placeholder="Ghi chú về đơn hàng...">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Đơn hàng & Phương thức thanh toán -->
                <div class="col-md-5">
                    <!-- KHỐI ĐƠN HÀNG VÀ THANH TOÁN -->
                    <div style="background: #fff; padding: 20px; border-radius: 5px; border: 2px solid #fe9100;">
                        <h4 style="margin-bottom: 20px; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 8px;">Đơn hàng của bạn</h4>

                        <!-- Bảng đơn hàng -->
                        <table class="table table-bordered" style="margin-bottom: 15px;">
                            <thead>
                                <tr>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartCollection as $cart)
                                <tr>
                                    <td>
                                        <b>{{ $cart->name }}</b> x {{ $cart->quantity }}<br>
                                        <small style="color: #777;">
                                            Size: {{ $cart->attributes->size ?? 'N/A' }} | Màu: {{ $cart->attributes->color ?? 'N/A' }}
                                        </small>
                                    </td>
                                    <td class="text-right" style="vertical-align: middle; font-size: 15px;">
                                        {{ number_format($cart->price * $cart->quantity, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tạm tính:</th>
                                    <th class="text-right" style="font-size: 15px;">
                                        {{ number_format($subtotal, 0, ',', '.') }} đ
                                    </th>
                                </tr>
                                @if(session()->has('coupon'))
                                <tr>
                                    <th>
                                        Giảm giá <strong>({{ session('coupon')['code'] }})</strong>:
                                        <a href="{{ route('coupon.remove') }}" style="color: red; font-size: 12px;">[Xóa]</a>
                                    </th>
                                    <th class="text-right" style="font-size: 15px; color: #28a745;">
                                        -{{ number_format($discount, 0, ',', '.') }} đ
                                    </th>
                                </tr>
                                @endif
                                <tr>
                                    <th>Tổng cộng:</th>
                                    <th class="text-right" style="color: #fe9100; font-size: 18px; font-weight: bold;">
                                        {{ number_format($total, 0, ',', '.') }} đ
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Phương thức thanh toán -->
                        <div class="payment-methods" style="margin-top: 15px;">
                            <p><b>Phương thức thanh toán:</b></p>
                            <div class="radio-item" style="margin-bottom: 10px;">
                                <label style="font-weight: normal; cursor: pointer;">
                                    <input type="radio" name="payment_method" value="cod" checked onchange="togglePayment(this.value)"> 
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="radio-item" style="margin-bottom: 10px;">
                                <label style="font-weight: normal; cursor: pointer;">
                                    <input type="radio" name="payment_method" value="e-wallet" onchange="togglePayment(this.value)"> 
                                    Thanh toán qua ví điện tử 
                                </label>
                            </div>

                            <div id="e-wallet-qr-box" style="display: none; border: 1px dashed #e67e22; padding: 15px; background: #fffaf0; border-radius: 5px; margin-top: 10px; text-align: center;">
                                <p style="color: #d35400; font-weight: bold; margin-bottom: 5px;">Quét mã QR để thanh toán:</p>
                                <img src="{{ asset('frontend/images/momo.jpg') }}" alt="Mã QR" style="width: 180px; height: 180px; object-fit: contain; border: 1px solid #ddd; padding: 5px; background: #fff;">
                                <p style="font-size: 13px; margin-top: 8px; color: #555;">
                                    Số tiền: <b style="color: #e74c3c;">{{ number_format($total, 0, ',', '.') }} đ</b><br>
                                    Nội dung chuyển khoản: <b>Họ tên - SĐT</b>
                                </p>
                            </div>
                        </div>

                        <button type="submit" id="btn-submit-order" class="btn btn-primary btn-block" style="background: #fe9100; border: none; padding: 12px; font-weight: bold; font-size: 16px; margin-top: 20px; width: 100%; color: #fff;">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- KHỐI MÃ GIẢM GIÁ (ĐẶT ĐỘC LẬP BÊN DƯỚI/BÊN CẠNH DÙNG FORM RIÊNG) -->
        <div style="margin-top: 20px; max-width: 450px; margin-left: auto;">
            <div style="background: #f7fafc; padding: 15px; border-radius: 5px; border: 1px dashed #cbd5e0;">
                <form action="{{ route('coupon.apply') }}" method="POST" id="coupon-form">
                    @csrf
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Mã giảm giá / Quà tặng:</span>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" name="coupon_code" placeholder="Nhập mã..." value="{{ session('coupon')['code'] ?? '' }}" required autocomplete="off" style="flex: 1; padding: 6px 10px; border: 1px solid #cbd5e0; border-radius: 4px; font-size: 13px; outline: none; text-transform: uppercase; height: 38px;">
                        <button type="submit" style="background: #fe9100; color: #fff; border: none; padding: 0 16px; border-radius: 4px; font-weight: 600; font-size: 13px; cursor: pointer; height: 38px;">Áp dụng</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    function togglePayment(method) {
        var qrBox = document.getElementById('e-wallet-qr-box');
        var btnSubmit = document.getElementById('btn-submit-order');

        if (method === 'e-wallet') {
            qrBox.style.display = 'block';
            btnSubmit.style.background = '#28a745';
            btnSubmit.innerHTML = '<i class="glyphicon glyphicon-ok-sign"></i> TÔI ĐÃ CHUYỂN KHOẢN THÀNH CÔNG';
        } else {
            qrBox.style.display = 'none';
            btnSubmit.style.background = '#fe9100';
            btnSubmit.innerHTML = 'XÁC NHẬN ĐẶT HÀNG';
        }
    }
</script>
@endsection