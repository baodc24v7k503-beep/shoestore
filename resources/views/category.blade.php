@extends('layout')

@section('content') 
<style>
    .agile_top_brand_left_grid {
        border: 1px solid #eef2f5 !important;
        background: #ffffff !important;
        border-radius: 12px !important;
        padding: 15px !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02) !important;
        position: relative !important;
        overflow: hidden !important;
    }
    
    .agile_top_brand_left_grid:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
        transform: translateY(-3px) !important;
    }

    .product-img-holder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .product-img-holder img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        mix-blend-mode: multiply;
        transition: transform 0.3s ease;
    }

    .agile_top_brand_left_grid:hover .product-img-holder img {
        transform: scale(1.05);
    }

    .product-name-title {
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        margin: 8px 0 6px 0;
        text-align: center;
        height: 38px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        margin-bottom: 12px;
    }

    .product-price-container .current-price {
        font-size: 15px;
        font-weight: 700;
        color: #e53e3e;
    }

    .product-price-container .old-price {
        font-size: 12px;
        color: #a0aec0;
        text-decoration: line-through;
        margin-top: 2px;
    }

    .btn-add-cart-custom {
        width: 100%;
        background: #fe9126 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 9px 0 !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        transition: background 0.2s ease !important;
        cursor: pointer;
    }

    .btn-add-cart-custom:hover {
        background: #e07d1a !important;
    }
</style>

<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
            <li class="active">{{ $category->name }}</li>
        </ol>
    </div>
</div>

<div class="products">
    <div class="container">
        <div class="col-md-4 products-left">
            <div class="categories">
                <h2>Danh mục: <span style="color: #fe9126">{{ $category->name }}</span></h2>
                <ul class="cate">
                    @foreach($categories as $key => $cate)
                    <li>
                        <a href="{{ route('danh-muc', $cate->slug) }}">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>{{ $cate->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>                                                                                                                                                                                                                                                                                                                                                                        
        </div>
        
        <div class="col-md-8 products-right">
            <div class="products-right-grid">
                <div class="products-right-grids">
                    <div class="sorting">
                        <select class="frm-field required sect" onchange="location = this.value;">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}" {{ request('sort') == 'default' ? 'selected' : '' }}>Mặc định</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Sắp theo giá từ thấp đến cao</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Sắp theo giá từ cao đến thấp</option>
                        </select>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            
            <div class="agile_top_brands_grids" style="margin: 0 -10px;">
                @foreach ($product_category as $key => $product)
                    <div class="col-md-4 top_brand_left" style="margin-bottom: 25px; padding: 0 10px;">
                        <div class="agile_top_brand_left_grid">
                           
                            <div class="product-img-holder">
                                <a href="{{ route('san-pham', ['id' => $product->id]) }}">
                                    <img src="{{ asset('uploads/products/'. $product->image) }}" alt="{{ $product->name_pd }}" onerror="this.onerror=null;this.src='https://via.placeholder.com/200?text=No+Image';">
                                </a>
                            </div>

                            <a href="{{ route('san-pham', ['id' => $product->id]) }}" style="text-decoration: none;">
                                <div class="product-name-title" title="{{ $product->name_pd }}">
                                    {{ $product->name_pd }}
                                </div>
                            </a>

                            <div class="product-price-container">
                                @if($product->sale_price && $product->sale_price > 0)
                                    <span class="current-price">{{ number_format($product->sale_price, 0, ',', '.') }} VNĐ</span>
                                    <span class="old-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @else
                                    <span class="current-price" style="color: #2d3748;">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </div>

                            <div class="snipcart-details">
                                <form action="{{ route('cart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="submit" name="submit" value="Thêm giỏ hàng" class="btn-add-cart-custom" />
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix"> </div>
            </div>
           
            <nav class="numbering">
                {{ $product_category->links('pagination::bootstrap-4') }}
            </nav>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection