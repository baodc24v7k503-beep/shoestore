@extends('layout')

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1">
                <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
    </div>

    <!-- Main Checkout Section -->
    <div class="cart-section">
        <div class="container">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success custom-alert">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger custom-alert">{{ session('error') }}</div>
            @endif

            @php
                $cartCollection = Cart::getContent();   
            @endphp

            <div class="cart-header-title">
                <h2>Giỏ hàng của bạn <span>({{ $cartCollection->count() }} sản phẩm)</span></h2>
            </div>

            <!-- Bảng danh sách sản phẩm (Phía trên) -->
            <div class="cart-table-wrapper">
                <table class="table cart-table">
                    <thead>
                        <tr>    
                            <th>Sản phẩm</th>
                            <th>Tùy chọn</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th class="text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cartCollection as $key => $cart)
                            <tr>
                                <td>
                                    <div class="product-item-info">
                                        <img src="{{ asset('uploads/products/'.$cart->attributes->image) }}" alt="{{ $cart->name }}" class="cart-prod-img"/>
                                        <span class="cart-prod-name">{{ $cart->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="product-variant">
                                        @if($cart->attributes->size)
                                            <span class="badge-variant">Size: {{ $cart->attributes->size }}</span>
                                        @endif
                                        @if($cart->attributes->color)
                                            <span class="badge-variant">Màu: {{ $cart->attributes->color }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="price-col">{{ number_format($cart->price, 0, ',', '.') }} đ</td>
                                <td>
                                    <form action="{{ route('cart.update') }}" method="POST" class="qty-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $cart->id }}">
                                        <input type="number" min="1" name="product_quantity" value="{{ $cart->quantity }}" class="qty-input" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="total-col">{{ number_format($cart->price * $cart->quantity, 0, ',', '.') }} đ</td>
                                <td class="text-center">
                                    <a href="{{ route('cart.delete', [$cart->id]) }}" class="btn-delete" title="Xóa sản phẩm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center empty-cart">
                                    <p>Giỏ hàng của bạn đang trống!</p>
                                    <a href="{{ route('/') }}" class="btn btn-primary">Mua sắm ngay</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Khối Tổng thanh toán (Sửa triệt để lỗi tràn khung) -->
            <div class="row">
                <div class="col-md-5 col-md-offset-7 col-sm-7 col-sm-offset-5 col-xs-12">
                    <div class="custom-cart-summary">
                        @php
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

                        <!-- Tạm tính -->
                        <div class="c-row">
                            <span class="c-title">Tạm tính:</span>
                            <span class="c-num">{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                        </div>

                        <!-- Mã giảm giá đã áp dụng -->
                        @if(session()->has('coupon'))
                            <div class="c-row c-coupon">
                                <span class="c-title">
                                    Mã giảm giá <strong>({{ session('coupon')['code'] }})</strong>
                                    <a href="{{ route('coupon.remove') }}" class="c-remove">[Xóa]</a>
                                </span>
                                <span class="c-num c-discount">-{{ number_format($discount, 0, ',', '.') }} đ</span>
                            </div>
                        @endif

                        <div class="c-divider"></div>

                        <!-- Tổng cộng -->
                        <div class="c-row c-total">
                            <span class="c-title">Tổng cộng:</span>
                            <span class="c-num c-final-price">{{ number_format($total, 0, ',', '.') }} đ</span>
                        </div>

                        <!-- Khung nhập Mã giảm giá -->
                        <div class="c-coupon-box">
                            <span class="c-coupon-label">Mã giảm giá / Quà tặng:</span>
                            <form action="{{ route('coupon.apply') }}" method="POST" class="c-coupon-form">
                                @csrf
                                <input type="text" name="coupon_code" placeholder="Nhập mã..." value="{{ session('coupon')['code'] ?? '' }}" required autocomplete="off">
                                <button type="submit">Áp dụng</button>
                            </form>
                        </div>

                        <!-- Nút Hành động -->
                        <a href="{{ route('checkout.index') }}" class="btn-checkout">THANH TOÁN</a>
                        <a href="{{ route('/') }}" class="btn-continue-shopping">
                            <i class="fa fa-angle-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

<style>
/* Layout chung */
.cart-section {
    padding: 30px 0 60px;
    background: #f8fafc;
}
.cart-header-title h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 25px;
}
.cart-header-title h2 span {
    font-size: 15px;
    color: #718096;
    font-weight: normal;
}
.custom-alert {
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Bảng Giỏ hàng */
.cart-table-wrapper {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    margin-bottom: 30px;
}
.cart-table {
    margin-bottom: 0;
    vertical-align: middle;
}
.cart-table thead tr {
    background: #f7fafc;
    border-bottom: 1px solid #e2e8f0;
}
.cart-table th {
    font-weight: 700;
    color: #4a5568;
    padding: 16px !important;
    border-bottom: none !important;
    font-size: 14px;
}
.cart-table td {
    padding: 16px !important;
    vertical-align: middle !important;
    border-top: 1px solid #edf2f7 !important;
    color: #2d3748;
    font-size: 14px;
}
.product-item-info {
    display: flex;
    align-items: center;
    gap: 12px;
}
.cart-prod-img {
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #edf2f7;
}
.cart-prod-name {
    font-weight: 600;
    color: #2d3748;
}
.badge-variant {
    display: inline-block;
    background: #edf2f7;
    color: #4a5568;
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 12px;
    margin-right: 4px;
}
.qty-input {
    width: 60px;
    height: 36px;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
}
.price-col {
    color: #718096;
}
.total-col {
    font-weight: 700;
    color: #2d3748;
}
.btn-delete {
    color: #a0aec0;
    font-size: 16px;
    transition: color 0.2s;
}
.btn-delete:hover {
    color: #e53e3e;
}
.empty-cart {
    padding: 40px !important;
}

/* CSS MỚI - ĐÁNH SẬP STYLE CŨ BẰNG CLASS ISOLATED */
.custom-cart-summary {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px !important;
    padding: 24px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04) !important;
    width: 100% !important;
    box-sizing: border-box !important;
    display: block !important;
    position: relative !important;
    overflow: hidden !important;
}

.custom-cart-summary .c-row {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 14px !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: static !important;
    float: none !important;
}

.custom-cart-summary .c-title {
    font-size: 15px !important;
    font-weight: 500 !important;
    color: #4a5568 !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
    position: static !important;
    display: inline-block !important;
}

.custom-cart-summary .c-num {
    font-size: 15px !important;
    font-weight: 600 !important;
    color: #2d3748 !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
    position: static !important;
    text-align: right !important;
    white-space: nowrap !important;
}

.custom-cart-summary .c-discount {
    color: #38a169 !important;
}

.custom-cart-summary .c-remove {
    color: #e53e3e !important;
    font-size: 12px !important;
    font-weight: bold !important;
    margin-left: 4px !important;
    text-decoration: none !important;
}

.custom-cart-summary .c-divider {
    height: 1px !important;
    background-color: #edf2f7 !important;
    margin: 16px 0 !important;
    width: 100% !important;
}

.custom-cart-summary .c-total .c-title {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #1a202c !important;
}

.custom-cart-summary .c-final-price {
    font-size: 22px !important;
    font-weight: 800 !important;
    color: #ff6b00 !important;
}

/* Coupon Box */
.custom-cart-summary .c-coupon-box {
    margin: 20px 0 !important;
    background: #f7fafc !important;
    padding: 14px !important;
    border-radius: 8px !important;
    border: 1px dashed #cbd5e0 !important;
    box-sizing: border-box !important;
}

.custom-cart-summary .c-coupon-label {
    display: block !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #4a5568 !important;
    margin-bottom: 8px !important;
}

.custom-cart-summary .c-coupon-form {
    display: flex !important;
    gap: 8px !important;
    width: 100% !important;
}

.custom-cart-summary .c-coupon-form input {
    flex: 1 !important;
    padding: 8px 12px !important;
    border: 1px solid #cbd5e0 !important;
    border-radius: 6px !important;
    font-size: 13px !important;
    outline: none !important;
    text-transform: uppercase !important;
    box-sizing: border-box !important;
    height: 38px !important;
}

.custom-cart-summary .c-coupon-form button {
    background: #3182ce !important;
    color: #fff !important;
    border: none !important;
    padding: 0 16px !important;
    border-radius: 6px !important;
    font-weight: 600 !important;
    font-size: 13px !important;
    cursor: pointer !important;
    white-space: nowrap !important;
    height: 38px !important;
}

/* Buttons */
.custom-cart-summary .btn-checkout {
    display: block !important;
    width: 100 !important;
    background: #ff6b00 !important;
    color: #ffffff !important;
    text-align: center !important;
    padding: 14px 0 !important;
    border-radius: 8px !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    text-decoration: none !important;
    box-shadow: 0 4px 10px rgba(255, 107, 0, 0.25) !important;
    box-sizing: border-box !important;
}

.custom-cart-summary .btn-continue-shopping {
    display: block !important;
    text-align: center !important;
    margin-top: 14px !important;
    color: #718096 !important;
    font-size: 14px !important;
    text-decoration: none !important;
    font-weight: 500 !important;
}
</style>
@endsection