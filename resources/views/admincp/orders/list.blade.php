@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách đơn hàng</h3>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Trạng thái thanh toán</th>
                <th>Trạng thái đơn hàng</th>
                <th>Ngày đặt</th>
                <th class="text-center" style="white-space: nowrap;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><b>#{{ $order->id }}</b></td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td style="color: #e74c3c;  font-weight: bold;">
                    {{ number_format($order->total_price, 0, ',', '.') }}đ
                </td>
                <td>
                    @if(strtolower($order->payment_method) == 'cod')
                        <span class="badge badge-secondary" style="background: #6c757d; color: #fff; padding: 5px 8px;">COD</span>
                    @else
                        <span class="badge badge-info" style="background: #17a2b8; color: #fff; padding: 5px 8px;">Ví điện tử</span>
                    @endif
                </td>
                <td>
                    @if (strtolower($order->payment_method) == 'cod')
                        @if ($order->status == 'Chưa nhận hàng')
                            <span class="badge badge-warning" style="background-color: #f0ad4e; color: #fff; padding: 5px 8px; border-radius: 4px;">Chưa thanh toán</span>
                        @else
                            <span class="badge badge-success" style="background-color: #5cb85c; color: #fff; padding: 5px 8px; border-radius: 4px;">Đã thanh toán</span>
                        @endif
                    @else
                        <select class="form-control update-payment-status" 
                                data-id="{{ $order->id }}" 
                                style="font-size: 13px; font-weight: bold; width: 140px; height: 32px; color: {{ $order->payment_status == 'Đã thanh toán' ? '#27ae60' : '#e74c3c' }};">
                            <option value="Chưa thanh toán" {{ $order->payment_status == 'Chưa thanh toán' ? 'selected' : '' }} style="color: #e74c3c;">Chưa thanh toán</option>
                            <option value="Đã thanh toán" {{ $order->payment_status == 'Đã thanh toán' ? 'selected' : '' }} style="color: #27ae60;">Đã thanh toán</option>
                        </select>
                    @endif
                </td>
                <td>
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="form-control form-control-sm" 
                                style="font-weight: bold; {{ $order->status == 'Đã nhận hàng' ? 'color: green;' : ($order->status == 'Trả hàng, hoàn tiền' ? 'color: red;' : 'color: #d35400;') }}">
                            <option value="Chưa nhận hàng" {{ $order->status == 'Chưa nhận hàng' ? 'selected' : '' }}>Chưa nhận hàng</option>
                            <option value="Đã nhận hàng" {{ $order->status == 'Đã nhận hàng' ? 'selected' : '' }}>Đã nhận hàng</option>
                            <option value="Trả hàng, hoàn tiền" {{ $order->status == 'Trả hàng, hoàn tiền' ? 'selected' : '' }}>Trả hàng, hoàn tiền</option>
                        </select>
                    </form>
                </td>
    
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary" style="  margin-right: 3px;">Chi tiết</a>
                    
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links('pagination::bootstrap-4') }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.update-payment-status').change(function() {
        var orderId = $(this).data('id');
        var paymentStatus = $(this).val();
        var selectElement = $(this);

        $.ajax({
            url: "{{ route('orders.updatePaymentStatus') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                order_id: orderId,
                payment_status: paymentStatus
            },
            success: function(response) {
                if (response.success) {
                    selectElement.css('color', paymentStatus === 'Đã thanh toán' ? '#27ae60' : '#e74c3c');
                    alert('Cập nhật trạng thái thanh toán thành công!');
                }
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        });
    });
});
</script>
@endsection