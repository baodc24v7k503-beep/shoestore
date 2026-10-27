@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Quản lý Mã Giảm Giá</h3>
        <a href="{{ route('coupons.create') }}" class="btn btn-primary">+ Tạo mã mới</a>
    </div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#STT</th>
                <th>Mã Code</th>
                <th>Loại giảm</th>
                <th>Giá trị</th>
                <th>Lượt dùng</th>
                <th>Trạng thái</th>
                <th class="text-center" style="white-space: nowrap;">Quản lý</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupons as $key => $coupon)
                <tr>
                    <td><b>#{{ $key + 1 }}</b></td>
                    <td><strong class="text-primary">{{ $coupon->code }}</strong></td>
                    <td>{{ $coupon->type == 'fixed' ? 'Tiền cố định' : 'Theo phần trăm (%)' }}</td>
                    <td>
                        {{ $coupon->type == 'fixed' ? number_format($coupon->value, 0, ',', '.') . ' VNĐ' : $coupon->value . '%' }}
                    </td>
                    <td>{{ $coupon->used_count }} / {{ $coupon->quantity ?? '∞' }}</td>
                    <td>
                        @if($coupon->status == 1)
                            <span class="badge" style="background-color: #fff; color: #007bff; border: 1px solid #ced4da; padding: 6px 12px; font-weight: bold; border-radius: 4px;">
                                Hoạt động
                            </span>
                        @else
                            <span class="badge" style="background-color: #fff; color: #6c757d; border: 1px solid #ced4da; padding: 6px 12px; font-weight: bold; border-radius: 4px;">
                                Đã khóa
                            </span>
                        @endif
                    </td>
                    <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning" style="color: #212529; font-weight: bold; margin-right: 3px;">Cập nhật</a>
                        
                        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display: inline-block; margin: 0;" onsubmit="return confirm('Bạn có chắc muốn xóa mã này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection