@extends('layout')
@section('slider')
    @include('includes.slider')
@endsection   
@section('content')   

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

<style>
    .top-brands {
        background-color: #f9fafb;
        padding: 40px 0;
    }
    .agile_top_brand_left_grid {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    .agile_top_brand_left_grid:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #e2e8f0;
    }
    .agile_top_brand_left_grid1 {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .snipcart-item {
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: space-between;
    }
    .snipcart-thumb {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex-grow: 1;
    }
    .snipcart-thumb a {
        display: block;
        width: 100%;
        overflow: hidden;
        border-radius: 8px;
        background-color: #f8fafc;
        margin-bottom: 12px;
    }
    .snipcart-thumb img {
        height: 200px !important;
        width: auto !important;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
        padding: 10px;
    }
    .agile_top_brand_left_grid:hover .snipcart-thumb img {
        transform: scale(1.05);
    }
    .snipcart-thumb p {
        margin: 8px 0;
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
        height: 42px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .stars {
        margin-bottom: 10px;
        color: #f59e0b;
        font-size: 13px;
    }
    .stars .gray-star {
        color: #cbd5e1;
    }
    .snipcart-thumb h4 {
        font-size: 17px;
        color: #ef4444;
        font-weight: 700;
        margin: 6px 0 16px 0;
    }
    .snipcart-thumb h4 span {
        text-decoration: line-through;
        color: #94a3b8;
        font-size: 13px;
        font-weight: 400;
        margin-left: 8px;
    }
    .top_brand_home_details .button {
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        width: 100%;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.2s ease;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
    }
    .top_brand_home_details .button:hover {
        background: #1d4ed8;
        box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
    }
    .product-slider .item {
        padding: 5px;
    }
    .product-slider .agile_top_brand_left_grid {
        height: auto;
    }
</style>

<!-- top-brands -->
<div class="top-brands">
    <div class="container">
        <h2>Sản phẩm mới nhất</h2>
        <div class="grid_3 grid_5">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Sản phẩm mới</a></li>
                    <li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Sản phẩm nổi bật</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
    
                    <div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
                        <div class="agile-tp">
                            <h5>Sản phẩm mới trong tuần</h5>
                            <p class="w3l-ad">Sản phẩm mới ra mắt. Bạn không nên bỏ lỡ.</p>
                        </div>
                        <div class="agile_top_brands_grids">
                            @foreach ($products as $key => $product)
                                <div class="col-md-4 top_brand_left" style="margin-bottom: 30px;">
                                    <div class="agile_top_brand_left_grid">
                                        <div class="agile_top_brand_left_grid1">
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="{{ route('san-pham', ['id' => $product->id]) }}">
                                                        <img title="{{ $product->name_pd }}" alt="{{ $product->name_pd }}" src="{{ asset('uploads/products/'. $product->image) }}"/>
                                                    </a>        
                                                    <p>{{ $product->name_pd }}</p>
                                                    <div class="stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                    </div>
                                                    <h4>
                                                        {{ number_format($product->sale_price ?? $product->price, 0, ',', '.') }} VNĐ
                                                        @if($product->sale_price)
                                                            <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details">
                                                    <button type="button" 
                                                            class="button open-cart-modal" 
                                                            data-toggle="modal" 
                                                            data-target="#quickAddToCartModal"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name_pd }}">
                                                        THÊM VÀO GIỎ HÀNG
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"> </div>
                            <nav class="numbering">
                                {{ $products->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
                        <div class="agile-tp">
                            <h5>Sản phẩm nổi bật</h5>
                            <p class="w3l-ad">Sản phẩm nổi bật. Bạn không nên bỏ lỡ.</p>
                        </div>
                        <div class="agile_top_brands_grids">
                            @foreach ($products_featured as $key => $product)
                                <div class="col-md-4 top_brand_left" style="margin-bottom: 30px;">
                                    <div class="agile_top_brand_left_grid">
                                        <div class="agile_top_brand_left_grid1">
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="{{ route('san-pham', ['id' => $product->id]) }}">
                                                        <img title="{{ $product->name_pd }}" alt="{{ $product->name_pd }}" src="{{ asset('uploads/products/'. $product->image) }}"/>
                                                    </a>        
                                                    <p>{{ $product->name_pd }}</p>
                                                    <div class="stars">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                    </div>
                                                    <h4>
                                                        {{ number_format($product->sale_price ?? $product->price, 0, ',', '.') }} VNĐ
                                                        @if($product->sale_price)
                                                            <span>{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details">
                                                    <button type="button" 
                                                            class="button open-cart-modal" 
                                                            data-toggle="modal" 
                                                            data-target="#quickAddToCartModal"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name_pd }}">
                                                        THÊM VÀO GIỎ HÀNG
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"> </div>
                            <nav class="numbering">
                                {{ $products_featured->links('pagination::bootstrap-4') }}
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>  

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <a href="#"> <img class="first-slide" src="{{ asset('frontend/images/banner4.webp') }}" alt="First slide"></a>
        </div>
        <div class="item">
            <a href="#"> <img class="second-slide " src="{{ asset('frontend/images/banner5.webp') }}" alt="Second slide"></a>
        </div>
        <div class="item">
            <a href="#"><img class="third-slide " src="{{ asset('frontend/images/banner6.png') }}" alt="Third slide"></a>
        </div>
    </div>    
</div>

<div class="newproducts-w3agile" style="padding: 3em 0;">
    <div class="container">
        <h3 style="text-align: center; margin-bottom: 25px; font-weight: bold;">SẢN PHẨM MỚI</h3>
            <div class="owl-carousel owl-theme product-slider">
            @if(isset($products) && $products->count() > 0)
                @foreach ($products as $key => $item)
                    <div class="item">
                        <div class="agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid1">
                                <div class="snipcart-item block">
                                    <div class="snipcart-thumb">
                                        <a href="{{ route('san-pham', ['id' => $item->id]) }}">
                                            <img title="{{ $item->name_pd }}" alt="{{ $item->name_pd }}" src="{{ asset('uploads/products/'. $item->image) }}">
                                        </a>        
                                        <p>{{ $item->name_pd }}</p>
                                        <div class="stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                        </div>
                                        <h4>
                                            {{ number_format($item->sale_price ?? $item->price, 0, ',', '.') }} VNĐ
                                            @if($item->sale_price)
                                                <span>{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <button type="button" 
                                                class="button open-cart-modal" 
                                                data-toggle="modal" 
                                                data-target="#quickAddToCartModal"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name_pd }}">
                                            THÊM VÀO GIỎ HÀNG
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


<div class="modal fade" id="quickAddToCartModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document" style="max-width: 480px; margin-top: 80px;">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 15px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalProductTitle" style="font-weight: bold; color: #1e293b; font-size: 16px;">Tên sản phẩm</h4>
            </div>
            
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="modal_product_id">

                <div class="modal-body" style="padding: 20px;">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label style="font-weight: 600; font-size: 13px; color: #475569;">Chọn Size:</label>
                            <select name="size" id="modal_select_size" class="form-control" style="border-radius: 6px;" required>
                                <option value="">-- Đang tải... --</option>
                            </select>
                        </div>

                          <div class="col-md-6 form-group">
                            <label style="font-weight: 600; font-size: 13px; color: #475569;">Chọn Màu:</label>
                            <select name="color" id="modal_select_color" class="form-control" style="border-radius: 6px;" required>
                                <option value="">-- Đang tải... --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 10px 0;">
                        <span style="font-size: 13px; color: #64748b;">Tình trạng: </span>
                        <strong id="modal_stock_status" style="color: #16a34a; font-size: 13px;">
                            Còn hàng (<span id="modal_stock">0</span> sản phẩm)
                        </strong>
                    </div>

                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 13px; color: #475569;">Số lượng:</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" style="width: 100px; border-radius: 6px;" required>
                    </div>
                </div>

                <div class="modal-footer" style="text-align: right; background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="submit" id="modal_btn_submit" class="btn btn-primary" style="background-color: #2563eb; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px;">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>          

<script>
    $(document).ready(function(){
        var currentVariants = [];

        $('.product-slider').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive:{
                0:{ items: 1 },
                600:{ items: 2 },
                1000:{ items: 4 }
            }
        });

        $(document).on('click', '.open-cart-modal', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('name');

            $('#modal_product_id').val(productId);
            $('#modalProductTitle').text(productName);
            
            $('#modal_select_size').html('<option value="">Đang tải...</option>');
            $('#modal_select_color').html('<option value="">Đang tải...</option>');

            $.ajax({
                url: '/get-variants/' + productId,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success' && response.variants.length > 0) {
                        currentVariants = response.variants;

                        var sizes = [];
                        $.each(currentVariants, function(index, variant) {
                            var sizeVal = variant.size || variant.size_name;
                            if(sizeVal && $.inArray(sizeVal, sizes) === -1) {
                                sizes.push(sizeVal);
                            }
                        });

                        var sizeHtml = '';
                        $.each(sizes, function(i, size) {
                            sizeHtml += '<option value="' + size + '">' + size + '</option>';
                        });
                        $('#modal_select_size').html(sizeHtml);

                        updateColorOptions();
                    } else {
                        $('#modal_select_size').html('<option value="">Hết hàng</option>');
                        $('#modal_select_color').html('<option value="">Hết hàng</option>');
                        $('#modal_stock').text(0);
                    }
                },
                error: function() {
                    alert('Không thể tải biến thể sản phẩm!');
                }
            });
        });

        $('#modal_select_size').on('change', function() {
            updateColorOptions();
        });

        $('#modal_select_color').on('change', function() {
            updateStockQuantity();
        });

        function updateColorOptions() {
            var selectedSize = $('#modal_select_size').val();
            var colorSelect = $('#modal_select_color');
            colorSelect.empty();

            var filteredVariants = $.grep(currentVariants, function(variant) {
                return variant.size == selectedSize;
            });

            $.each(filteredVariants, function(index, variant) {
                colorSelect.append(
                    '<option value="' + variant.color + '" data-stock="' + (variant.stock_quantity || 0) + '">' + 
                    variant.color + 
                    '</option>'
                );
            });

            updateStockQuantity();
        }

        function updateStockQuantity() {
            var stock = $('#modal_select_color option:selected').data('stock');
            if(stock !== undefined) {
                $('#modal_stock').text(stock);
                if(stock > 0) {
                    $('#modal_stock_status').html('Còn hàng (<span id="modal_stock">' + stock + '</span> sản phẩm)').css('color', '#16a34a');
                    $('#modal_btn_submit').prop('disabled', false);
                } else {
                    $('#modal_stock_status').html('Tạm hết hàng').css('color', '#dc2626');
                    $('#modal_btn_submit').prop('disabled', true);
                }
            }
        }
    });
</script>
@endsection