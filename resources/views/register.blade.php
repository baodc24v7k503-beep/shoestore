@extends('layout')

@section('content')
<style>
    /* Bổ sung CSS đảm bảo khoảng cách giữa các ô luôn đều đẹp */
    .register {
        padding-top: 10px !important;
        padding-bottom: 30px !important;
    }
    .register .login-form-grids {
        margin-top: 10px !important;
    }
    .login-form-grids .form-group {
        margin-bottom: 12px;
    }
    .login-form-grids input[type="text"],
    .login-form-grids input[type="email"],
    .login-form-grids input[type="password"] {
        margin-bottom: 0px !important; /* Ghi đè margin mặc định của template */
    }
</style>

<div class="breadcrumbs" style="margin-bottom: 10px;">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Đăng ký</li>
        </ol>
    </div>
</div>

<div class="register">
    <div class="container">
        <div class="login-form-grids">
                
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h3 style="text-align: center; margin-bottom: 20px; font-weight: bold;">ĐĂNG KÝ</h3>
                
                <div class="form-group">
                    <input id="name" type="text" placeholder="Tên người dùng" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" placeholder="Địa chỉ Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="phone" type="text" placeholder="Số điện thoại" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="tel">
                    @error('phone')
                        <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="address" type="text" placeholder="Địa chỉ giao hàng" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="street-address">
                    @error('address')
                        <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">                    
                    @error('password')
                        <span class="invalid-feedback" role="alert" style="color: red; display: block; margin-top: 5px;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu -->
                <div class="form-group">
                    <input id="password-confirm" type="password" placeholder="Xác thực mật khẩu" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                            
                <div class="register-check-box" style="margin-top: 15px;">
                    <div class="check">
                        <label class="checkbox"><input type="checkbox" name="checkbox" required><i> </i>Tôi chấp nhận điều khoản.</label>
                    </div>
                </div>
                <input type="submit" value="{{ __('Đăng ký') }}" style="margin-top: 15px;">
            </form>
        </div>
    </div>
</div>
@endsection