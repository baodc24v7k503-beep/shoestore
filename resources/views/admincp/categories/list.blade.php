@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Danh sách danh mục</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
        </div>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Mã danh mục (slug)</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" class="text-center" style="white-space: nowrap;">Quản lý</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $cate)
                <tr>
                    <th scope="row"><b>#{{ $key }}</b></th>
                    <td>{{ $cate->name }}</td>
                    <td>{{ $cate->slug }}</td>
                    <td>{{ $cate->description }}</td>
                    <td>
                        @if ($cate->status == 1)
                            <span class="badge" style="background-color: #fff; color: #28a745; border: 1px solid #ced4da; padding: 6px 12px; font-weight: bold; border-radius: 4px;">Hiển thị</span>
                        @else
                            <span class="badge" style="background-color: #fff; color: #dc3545; border: 1px solid #ced4da; padding: 6px 12px; font-weight: bold; border-radius: 4px;">Tạm ẩn</span>
                        @endif
                    </td>
                    <td style="white-space: nowrap; text-align: center; vertical-align: middle;">
                        <a href="{{ route('categories.edit', $cate->id) }}" class="btn btn-sm btn-warning" style="color: #212529; font-weight: bold; margin-right: 3px;">Cập nhật</a>
                        <form method="POST" action="{{ route('categories.destroy', $cate->id) }}" style="display: inline-block; margin: 0;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links('pagination::bootstrap-4') }}
    </div>
@endsection