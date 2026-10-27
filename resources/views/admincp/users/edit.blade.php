@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Cập nhật thông tin tài khoản #{{ $user->id }}</h3>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="form-group mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $user->address) }}">
        </div>

        <div class="form-group mb-3">
            <label for="role" class="form-label">Vai trò</label>
            <select name="role" class="form-control" id="role">
                <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>Thành viên</option>
                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Quản trị viên</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Lưu thay đổi</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection