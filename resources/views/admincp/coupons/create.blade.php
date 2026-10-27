@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo Mã Giảm Giá Mới</h2>
    
    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Mã giảm giá (Code):</label>
            <input type="text" name="code" class="form-control" placeholder="VD: KM2026, KHUYENMAI10" required>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>Loại giảm giá:</label>
                <select name="type" class="form-control" required>
                    <option value="fixed">Số tiền cố định (VNĐ)</option>
                    <option value="percent">Theo phần trăm (%)</option>
                </select>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Giá trị giảm:</label>
                <input type="number" name="value" class="form-control" placeholder="VD: 50000 hoặc 10" step="0.01" required>
            </div>
        </div>

        <div class="form-group mb-3">
            <label>Số lượng mã (Để trống nếu không giới hạn):</label>
            <input type="number" name="quantity" class="form-control" placeholder="VD: 100">
        </div>

        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label>Ngày bắt đầu:</label>
                <input type="datetime-local" name="start_date" class="form-control">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label>Ngày kết thúc (Hết hạn):</label>
                <input type="datetime-local" name="end_date" class="form-control">
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="status" class="form-check-input" value="1" checked id="status">
            <label class="form-check-label" for="status">Kích hoạt ngay</label>
        </div>

        <button type="submit" class="btn btn-success">Lưu mã giảm giá</button>
    </form>
</div>
@endsection