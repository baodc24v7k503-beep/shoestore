@extends('layouts.app') {{-- Thay bằng layout admin tương ứng của bạn --}}

@section('content')
<div class="container" style="padding: 20px;">
    <h2>Chỉnh Sửa Mã Giảm Giá</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Mã giảm giá (Code):</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $coupon->code) }}" required style="text-transform: uppercase;">
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>Loại giảm giá:</label>
                <select name="type" class="form-control" required>
                    <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Số tiền cố định (VNĐ)</option>
                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Theo phần trăm (%)</option>
                </select>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Giá trị giảm:</label>
                <input type="number" name="value" class="form-control" value="{{ old('value', $coupon->value) }}" required min="0" step="any">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group mb-3">
                <label>Số lượng mã (Bỏ trống nếu không giới hạn):</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $coupon->quantity) }}" min="1">
            </div>
            <div class="col-md-4 form-group mb-3">
                <label>Ngày bắt đầu:</label>
                <input type="datetime-local" name="start_date" class="form-control" value="{{ $coupon->start_date ? date('Y-m-d\TH:i', strtotime($coupon->start_date)) : '' }}">
            </div>
            <div class="col-md-4 form-group mb-3">
                <label>Ngày kết thúc:</label>
                <input type="datetime-local" name="end_date" class="form-control" value="{{ $coupon->end_date ? date('Y-m-d\TH:i', strtotime($coupon->end_date)) : '' }}">
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="form-check">
                <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ $coupon->status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Kích hoạt mã giảm giá này</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection