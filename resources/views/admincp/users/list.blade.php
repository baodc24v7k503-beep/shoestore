@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách tài khoản (Users)</h3>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><b>#{{ $user->id }}</b></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                <td>{{ $user->address ?? 'Chưa cập nhật' }}</td>
                <td>
                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                        @csrf
                        <select name="role" onchange="this.form.submit()" class="form-control form-control-sm" 
                                style="font-weight: bold; width: 130px; {{ $user->role == 1 ? 'color: #d35400;' : 'color: #2980b9;' }}">
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Thành viên</option>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                        </select>
                    </form>
                </td>
                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                <td>
                    {{-- Nút Cập nhật màu vàng --}}
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" style="font-weight: 500;">Cập nhật</a>
                    
                    {{-- Nút Xóa --}}
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection