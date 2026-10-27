@extends('layout')

@section('content')
<!-- breadcrumbs -->
<div class="breadcrumbs" style="margin-bottom: 10px;">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
            <li class="active">Đăng nhập</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->

<!-- login -->
<div class="login" style="padding-top: 10px; padding-bottom: 30px;">
    <div class="container">
        
        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s" style="margin-top: 10px;">
            <h3 style="text-align: center; font-weight: bold; margin-bottom: 20px;">ĐĂNG NHẬP</h3>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input id="email" type="email" placeholder="Nhập tài khoản (email)..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror   

                <input id="password" type="password" placeholder="Nhập mật khẩu..." class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="margin-top: 15px;">
                @error('password')
                    <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                                
                <div class="forgot" style="margin-top: 10px;">
                    <a href="#">Quên mật khẩu?</a>
                </div>

                <input type="submit" value="Login" style="margin-top: 20px;">
            </form>
        </div>
        
        <h4 style="margin-top: 25px;">Dành cho người mới</h4>
        <p><a href="{{ route('dang-ky') }}">Đăng ký ngay</a> (hoặc) quay lại <a href="{{ route('/') }}">Trang chủ <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
    </div>
</div>
<!-- //login -->
@endsection