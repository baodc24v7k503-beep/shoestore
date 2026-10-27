@extends('layout')

@section('content')
<style>
    .order-container {
        padding: 40px 0;
        background-color: #fdfdfd;
        min-height: 500px;
    }
    .order-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        padding: 25px;
        border: 1px solid #eee;
    }
    .order-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
        text-transform: uppercase;
        border-bottom: 2px solid #fe9126;
        padding-bottom: 10px;
        display: inline-block;
    }
    .table-order {
        margin-bottom: 0;
    }
    .table-order thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        border-bottom: 2px solid #dee2e6 !important;
        vertical-align: middle !important;
    }
    .table-order tbody td {
        vertical-align: middle !important;
        font-size: 14px;
        padding: 12px 15px !important;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }
    .bg-payment-pending { background-color: #fff3cd; color: #856404; }
    .bg-payment-success { background-color: #d4edda; color: #155724; }
    .bg-order-process { background-color: #d1ecf1; color: #0c5460; }
    .bg-order-success { background-color: #28a745; color: #fff; }
    .bg-order-cancel { background-color: #f8d7da; color: #721c24; }
    
    .btn-view-detail {
        background-color: #fe9126;
        color: #fff !important;
        border-radius: 4px;
        font-size: 13px;
        padding: 6px 14px;
        transition: all 0.3s;
        border: none;
    }
    .btn-view-detail:hover {
        background-color: #e07d1a;
        box-shadow: 0 2px 8px rgba(254, 145, 38, 0.4);
    }
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home"></span>Trang chủ</a></li>
            <li class="active">Đơn hàng của tôi</li>
        </ol>
    </div>
</div>

<div class="order-container">
    <div class="container">
        <div class="order-card">
            <h2 class="order-title"><i class="glyphicon glyphicon-list-alt" style="margin-right: 8px;"></i> Đơn hàng của tôi</h2>

            @if($orders->isEmpty())
                <div class="alert alert-info text-center" style="margin: 30px 0;">
                    <p style="font-size: 16px; margin-bottom: 15px;">Bạn chưa có đơn hàng nào!</p>
                    <a href="{{ route('/') }}" class="btn btn-warning" style="background: #fe9126; border: none;">Mua sắm ngay</a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-order align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Mã đơn</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th class="text-center">Trạng thái thanh toán</th>
                                <th class="text-center">Trạng thái giao hàng</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center"><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td><strong style="color: #d9534f; font-size: 15px;">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</strong></td>
                                <td><span class="label label-default" style="font-size: 11px;">{{ strtoupper($order->payment_method) }}</span></td>
                                
                                <td class="text-center">
                                    @if($order->payment_status == 'Đã thanh toán')
                                        <span class="badge-status bg-payment-success"> Đã thanh toán</span>
                                    @else
                                        <span class="badge-status bg-payment-pending"> Chưa thanh toán</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    @if($order->status == 'Đã nhận hàng')
                                        <span class="badge-status bg-order-success">{{ $order->status }}</span>
                                    @elseif($order->status == 'Trả hàng, hoàn tiền' || $order->status == 'Đã hủy')
                                        <span class="badge-status bg-order-cancel">{{ $order->status }}</span>
                                    @else
                                        <span class="badge-status bg-order-process">{{ $order->status }}</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    <a href="{{ route('user.orders.detail', $order->id) }}" class="btn btn-view-detail">
                                        <i class="glyphicon glyphicon-eye-open"></i> Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center" style="margin-top: 25px;">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection