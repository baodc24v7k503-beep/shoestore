@extends('layout')

@section('content')
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
            <li class="active">Thông tin cá nhân</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->

<div class="products" style="padding: 40px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="col-md-8 col-md-offset-2" style="background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.08);">
            
            <h3 style="color: #fe9126; font-weight: bold; margin-bottom: 25px; text-transform: uppercase; border-bottom: 2px solid #fe9126; padding-bottom: 10px;">
                THÔNG TIN TÀI KHOẢN CÁ NHÂN
            </h3>

            @if(session('success'))
                <div class="alert alert-success" style="border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="border-radius: 4px;">
                    <ul style="margin-bottom: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 1. GIAO DIỆN XEM THÔNG TIN (MẶC ĐỊNH) -->
            <div id="view-profile-section">
                <table class="table table-bordered" style="font-size: 15px;">
                    <tr>
                        <th style="width: 35%; background: #f5f5f5;">Họ và tên</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f5f5f5;">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f5f5f5;">Số điện thoại</th>
                        <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                    </tr>
                    <tr>
                        <th style="background: #f5f5f5;">Địa chỉ nhận hàng</th>
                        <td>{{ $user->address ?? 'Chưa cập nhật' }}</td>
                    </tr>
                </table>

                <div style="margin-top: 20px; display: flex; gap: 10px;">
                    <button id="btn-show-edit" class="btn btn-warning" style="background-color: #fe9126; color: #fff; border: none; padding: 10px 20px; font-weight: bold; text-transform: uppercase;">
                        <i class="glyphicon glyphicon-edit"></i> Cập nhật thông tin
                    </button>
                    <button id="btn-show-password" class="btn btn-default" style="border: 1px solid #fe9126; color: #fe9126; padding: 10px 20px; font-weight: bold; text-transform: uppercase; margin-left: 10px;">
                        <i class="glyphicon glyphicon-lock"></i> Đổi mật khẩu
                    </button>
                </div>
            </div>

            <!-- 2. FORM CẬP NHẬT THÔNG TIN -->
            <div id="edit-profile-section" style="display: none;">
                <h4 style="font-weight: bold; color: #fe9126; margin-bottom: 20px;">CẬP NHẬT THÔNG TIN</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Họ và tên <span class="text-danger" style="color: red;">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="height: 42px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Email (Không thể thay đổi)</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled readonly style="height: 42px; background-color: #eef1f5;">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Nhập số điện thoại" style="height: 42px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Địa chỉ nhận hàng</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" placeholder="Nhập địa chỉ nhận hàng" style="height: 42px;">
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" class="btn btn-warning" style="background-color: #fe9126; color: #fff; border: none; padding: 10px 25px; font-weight: bold; text-transform: uppercase;">
                            Lưu thay đổi
                        </button>
                        <button type="button" class="btn-cancel btn btn-default" style="padding: 10px 20px; margin-left: 10px;">
                            Hủy bỏ
                        </button>
                    </div>
                </form>
            </div>

            <!-- 3. FORM ĐỔI MẬT KHẨU -->
            <div id="change-password-section" style="display: none;">
                <h4 style="font-weight: bold; color: #fe9126; margin-bottom: 20px;">ĐỔI MẬT KHẨU</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Giữ nguyên thông tin cũ để không bị mất khi submit -->
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    <input type="hidden" name="phone" value="{{ $user->phone }}">
                    <input type="hidden" name="address" value="{{ $user->address }}">

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600;">Mật khẩu mới <span class="text-danger" style="color: red;">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required style="height: 42px;">
                    </div>

                    <div class="form-group" style="margin-bottom: 25px;">
                        <label style="font-weight: 600;">Xác nhận mật khẩu mới <span class="text-danger" style="color: red;">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required style="height: 42px;">
                    </div>

                    <div style="margin-top: 25px;">
                        <button type="submit" class="btn btn-warning" style="background-color: #fe9126; color: #fff; border: none; padding: 10px 25px; font-weight: bold; text-transform: uppercase;">
                            Cập nhật mật khẩu
                        </button>
                        <button type="button" class="btn-cancel btn btn-default" style="padding: 10px 20px; margin-left: 10px;">
                            Hủy bỏ
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- JAVASCRIPT ĐIỀU KHIỂN -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const viewSection = document.getElementById("view-profile-section");
        const editSection = document.getElementById("edit-profile-section");
        const passSection = document.getElementById("change-password-section");

        const btnShowEdit = document.getElementById("btn-show-edit");
        const btnShowPassword = document.getElementById("btn-show-password");
        const btnCancels = document.querySelectorAll(".btn-cancel");

        // Mở form sửa thông tin
        btnShowEdit.addEventListener("click", function () {
            viewSection.style.display = "none";
            editSection.style.display = "block";
            passSection.style.display = "none";
        });

        // Mở form đổi mật khẩu
        btnShowPassword.addEventListener("click", function () {
            viewSection.style.display = "none";
            editSection.style.display = "none";
            passSection.style.display = "block";
        });

        // Quay lại giao diện xem
        btnCancels.forEach(function (btn) {
            btn.addEventListener("click", function () {
                viewSection.style.display = "block";
                editSection.style.display = "none";
                passSection.style.display = "none";
            });
        });
    });
</script>
@endsection