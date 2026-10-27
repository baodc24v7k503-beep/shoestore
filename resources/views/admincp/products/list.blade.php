@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Danh sách sản phẩm</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary" style="">Thêm sản phẩm</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Mã sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Giá (sale)</th>
                <th scope="col">Mô tả ngắn</th>
                {{-- <th scope="col">Mô tả sản phẩm</th> --}}
                <th scope="col">Phân loại</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Quản lý</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $prod)
                <tr>
                    <td scope="row">{{ $key }}</td>
                    <td>{{ $prod->name_pd }}</td>
                    <td>{{ $prod->slug }}</td>
                    <td><img src="{{ asset('uploads/products/'. $prod->image) }}" alt="" class="img img-responsive" width="120"></td>
                    <td>{{ number_format($prod->price, 0, ',','.') }}</td>
                    <td>{{ number_format($prod->sale_price, 0, ',','.') }}</td>
                    <td>{{ $prod->short_description }}</td>
                    <td>
                        @if ($prod->is_featured == 1)
                            <span class="text text-success">Nổi bật</span>
                        @else
                            <span class="text text-danger">Mới</span>
                        @endif
                    </td>
                    <td>
                        @if ($prod->status == 1)
                            <span class="text text-success">Hiển thị</span>
                        @else
                            <span class="text text-danger">Tạm ẩn</span>
                        @endif
                    </td>
                    <td>
                        {{ $prod->category->name}}
                    </td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <form method="POST" action="{{ route('products.destroy', $prod->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger btn-sm" style="width: 80px;" value="Xóa SP" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                                </form>
                            </div>
                        </div>
                        <div class="row" style="position:relative; top: 2px">
                            <div class="col">
                                <a href="{{ route('products.edit', $prod->id) }}" class="btn btn-warning btn-sm text-white" style="width: 80px;">Cập nhật</a>
                            </div>
                        </div>
                        <div class="row" style="position:relative; top: 4px">
                            <div class="col">
                                <a href="{{ route('variants.index', $prod->id) }}" class="btn btn-sm btn-info text-white" style="width: 80px;">Biến thể</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
@endsection