@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Quản lý Size/Màu cho sản phẩm: <span class="text-primary">{{ $product->name_pd }}</span></h3>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Cột trái: Form thêm Size/Màu mới --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">Thêm Size / Tồn kho mới</div>
                <div class="card-body">
                    <form action="{{ route('variants.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Kích cỡ (Size) <span class="text-danger">*</span></label>
                            <input type="text" name="size" class="form-control" placeholder="VD: 39, 40, 41, M, L..." required>
                        </div>

                        <div class="mb-3">
                            <label>Màu sắc</label>
                            <input type="text" name="color" class="form-control" placeholder="VD: Đen, Trắng (Nếu có)">
                        </div>

                        <div class="mb-3">
                            <label>Số lượng tồn kho <span class="text-danger">*</span></label>
                            <input type="number" name="stock_quantity" class="form-control" value="10" min="0" required>
                        </div>

                        {{-- <div class="mb-3">
                            <label>Giá riêng (Bỏ trống nếu lấy giá gốc)</label>
                            <input type="number" name="price" class="form-control" placeholder="Để trống nếu bằng giá gốc">
                        </div> --}}
                        <button type="submit" class="btn btn-success w-100">Thêm Biến Thể</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Cột phải: Bảng danh sách các Size hiện có --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách Size/Màu hiện có</div>
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Size</th>
                                <th>Màu</th>
                                <th>Tồn kho</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($product->variants as $key => $variant)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><span class="badge bg-dark">{{ $variant->size }}</span></td>
                                    <td>{{ $variant->color ?? 'Mặc định' }}</td>
                                    <td>
                                        <span class="badge {{ $variant->stock_quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $variant->stock_quantity }} đôi
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('variants.destroy', ['product_id' => $product->id, 'id' => $variant->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa Size này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Chưa có size nào được thêm cho sản phẩm này.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection