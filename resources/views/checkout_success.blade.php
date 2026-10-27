@extends('layout')

@section('content')
<div class="container text-center" style="padding: 60px 0;">
    <div style="max-width: 600px; margin: 0 auto; background: #f9f9f9; padding: 40px; border-radius: 8px; border: 1px solid #e0e0e0;">
        <span class="glyphicon glyphicon-ok-circle" style="font-size: 60px; color: #5cb85c; margin-bottom: 20px;"></span>
        <h2 style="color: #333; font-weight: bold;">ĐẶT HÀNG THÀNH CÔNG!</h2>
        <p style="margin: 15px 0; color: #666; font-size: 16px;">Cảm ơn bạn đã mua sắm. Đơn hàng của bạn đã được ghi nhận và đang xử lý.</p>
        
        @if(session('order_id'))
            <p>Mã đơn hàng của bạn là: <b>#{{ session('order_id') }}</b></p>
        @endif

        <a href="{{ route('/') }}" class="btn btn-primary" style="background: #fe9100; border: none; padding: 10px 25px; margin-top: 20px; font-weight: bold;">
            Tiếp tục mua hàng
        </a>
    </div>
</div>
@endsection