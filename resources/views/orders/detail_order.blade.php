@extends('layout')

@section('content')
<style>
    .order-detail-wrapper {
        padding: 30px 0 60px 0;
        background-color: #f4f6f8;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    
    .custom-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .custom-card-header {
        background: #ffffff;
        padding: 18px 24px;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .custom-card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 15px;
        color: #1a202c;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .custom-card-header i {
        color: #fe9126;
        font-size: 16px;
    }

    .custom-card-body {
        padding: 24px;
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
    }
    
    .info-label {
        color: #718096;
        font-weight: 500;
    }
    
    .info-value {
        color: #2d3748;
        font-weight: 600;
        text-align: right;
    }

    .divider {
        height: 1px;
        background-color: #edf2f7;
        margin: 8px 0;
    }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .badge-payment-pending { background-color: #fffaf0; color: #dd6b20; border: 1px solid #fbd38d; }
    .badge-payment-success { background-color: #f0fff4; color: #38a169; border: 1px solid #9ae6b4; }
    .badge-order-process { background-color: #ebf8ff; color: #3182ce; border: 1px solid #bee3f8; }
    .badge-order-success { background-color: #38a169; color: #ffffff; }
    .badge-order-cancel { background-color: #fff5f5; color: #e53e3e; border: 1px solid #feb2b2; }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .modern-table th {
        background-color: #f7fafc;
        color: #718096;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        border-bottom: 1px solid #edf2f7;
        text-align: center;
    }
    
    .modern-table td {
        padding: 18px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f7fafc;
        font-size: 14px;
    }

    .product-box {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .product-img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #edf2f7;
    }

    .product-info-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 4px;
        display: block;
    }

    .variant-tag {
        background: #edf2f7;
        color: #4a5568;
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 500;
        display: inline-block;
        margin-right: 4px;
    }

    .table-summary {
        background-color: #fafbfc;
        padding: 20px 24px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 16px;
        border-top: 1px solid #edf2f7;
    }

    .summary-label {
        font-size: 15px;
        font-weight: 600;
        color: #4a5568;
    }

    .summary-total {
        font-size: 20px;
        font-weight: 700;
        color: #e53e3e;
    }

    .btn-flat-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #edf2f7;
        color: #4a5568 !important;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .btn-flat-back:hover {
        background-color: #e2e8f0;
        color: #2d3748 !important;
    }
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home"></span>Trang chủ</a></li>
            <li><a href="{{ route('user.orders') }}">Đơn hàng của tôi</a></li>
            <li class="active">Chi tiết đơn hàng</li>
        </ol>
    </div>
</div>

<div class="order-detail-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="glyphicon glyphicon-user"></i>
                        <h5>Thông tin giao hàng</h5>
                    </div>
                    <div class="custom-card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Mã đơn hàng</span>
                                <span class="info-value" style="color: #3182ce;">#{{ $order->id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Người nhận</span>
                                <span class="info-value">{{ $order->name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Số điện thoại</span>
                                <span class="info-value">{{ $order->phone }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $order->email }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Địa chỉ giao hàng</span>
                                <span class="info-value">{{ $order->address }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ghi chú</span>
                                <span class="info-value" style="font-weight: 400; color: #718096;">{{ $order->note ?? 'Không có ghi chú' }}</span>
                            </div>
                            
                            <div class="divider"></div>

                            <div class="info-item">
                                <span class="info-label">Phương thức thanh toán</span>
                                <span class="info-value"><span class="label label-default">{{ strtoupper($order->payment_method) }}</span></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Trạng thái thanh toán</span>
                                <span class="info-value">
                                    @if($order->payment_status == 'Đã thanh toán')
                                        <span class="badge-custom badge-payment-success"><i class="glyphicon glyphicon-ok-sign"></i> Đã thanh toán</span>
                                    @else
                                        <span class="badge-custom badge-payment-pending"><i class="glyphicon glyphicon-time"></i> Chưa thanh toán</span>
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Trạng thái đơn hàng</span>
                                <span class="info-value">
                                    @if($order->status == 'Đã nhận hàng')
                                        <span class="badge-custom badge-order-success">{{ $order->status }}</span>
                                    @elseif($order->status == 'Trả hàng, hoàn tiền' || $order->status == 'Đã hủy')
                                        <span class="badge-custom badge-order-cancel">{{ $order->status }}</span>
                                    @else
                                        <span class="badge-custom badge-order-process">{{ $order->status }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <h5>Sản phẩm đã đặt</h5>
                    </div>
                    <div style="padding: 0; overflow-x: auto;">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="text-align: left; padding-left: 24px;">Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th style="text-align: right; padding-right: 24px;">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td style="padding-left: 24px;">
                                        <div class="product-box">
                                            @php
                                                $imgName = $item->product->image ?? $item->image ?? null;
                                                $imgPath = $imgName ? asset('uploads/products/' . $imgName) : 'https://via.placeholder.com/60?text=No+Img';
                                            @endphp
                                            <img src="{{ $imgPath }}" 
                                                 alt="{{ $item->product_name }}" 
                                                 class="product-img"
                                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/60?text=No+Img';">
                                            <div>
                                                <span class="product-info-title">{{ $item->product_name }}</span>
                                                <div>
                                                    @if(!empty($item->size))
                                                        <span class="variant-tag">Size: {{ $item->size }}</span>
                                                    @endif
                                                    @if(!empty($item->color))
                                                        <span class="variant-tag">Màu: {{ $item->color }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center; color: #718096;">{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                    <td style="text-align: center;"><strong>{{ $item->quantity }}</strong></td>
                                    <td style="text-align: right; padding-right: 24px; font-weight: 600; color: #2d3748;">
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-summary">
                        <span class="summary-label">Tổng thanh toán:</span>
                        <span class="summary-total">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('user.orders') }}" class="btn-flat-back">
                    <i class="glyphicon glyphicon-arrow-left"></i> Quay lại danh sách đơn hàng
                </a>
            </div>
        </div>
    </div>
</div>
@endsection