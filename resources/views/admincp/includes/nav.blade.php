<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Dashboard
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('/') }}">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">Danh mục</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">sản phẩm</a>
          </li>
          <li class="nav-item {{ Request::is('admin/coupons*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('coupons.index') }}">Mã giảm giá</a>
        </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('orders.index') }}">Đơn hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">Tài khoản(User)</a>
        </li>
        </ul>
      </div>
    </div>
  </nav>