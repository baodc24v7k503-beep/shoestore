@extends('layout')

@section('content')   
<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="{{ route('/') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Trang chủ</a></li>
            <li class="active">{{ $product->name_pd }}</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->

<div class="products">
    <div class="container">
        <div class="agileinfo_single">
            <div class="col-md-4 agileinfo_single_left">
                <img id="example" src="{{ asset('uploads/products/'.$product->image) }}" alt=" " class="img-responsive">
            </div>
            <div class="col-md-8 agileinfo_single_right">
                <h2>{{ $product->name_pd }}</h2>
                <div class="rating1">
                    <span class="starRating">
                        <input id="rating5" type="radio" name="rating" value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" name="rating" value="3" checked="">
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" name="rating" value="1">
                        <label for="rating1">1</label>
                    </span>
                </div>

                <div class="w3agile_description">
                    <h4>Mô tả:</h4>
                    <p>{!! $product->description !!}</p>
                </div>

                
                <div class="snipcart-thumb agileinfo_single_right_snipcart">
                    <h4 class="m-sing" style="font-size: 24px; color: #fe9100; font-weight: bold;">
                        {{-- Giá khuyến mãi (Giá bán thực tế) --}}
                        <span id="display-price" style="text-decoration: none !important; color: #fe9100 !important; font-weight: bold !important;">
                            {{ number_format($product->sale_price ?? $product->price, 0, ',', '.') }}
                        </span> VNĐ
                
                        {{-- Giá gốc (Gạch ngang mờ đi) --}}
                        @if($product->sale_price)
                            <span style="text-decoration: line-through !important; color: #aaa !important; font-size: 16px !important; margin-left: 12px !important; font-weight: normal !important;">
                                {{ number_format($product->price, 0, ',', '.') }} VNĐ
                            </span>
                        @endif
                    </h4>
                </div>

                    
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="sku" id="selected-sku" value="">

                            <!-- Đặt Chọn Size và Chọn Màu nằm ngang hàng -->
                            <div class="row" style="margin-bottom: 15px;">
                                {{-- Chọn Size --}}
                                @if($product->variants && $product->variants->whereNotNull('size')->count() > 0)
                                <div class="col-xs-6 col-sm-6 col-md-6" style="padding-left: 0;">
                                    <label for="size-select">Chọn Size:</label>
                                    <select name="size" id="size-select" class="form-control variant-option" required>
                                        <option value="">-- Chọn Size --</option>
                                        @foreach($product->variants->unique('size') as $variant)
                                            <option value="{{ $variant->size }}">{{ $variant->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                {{-- Chọn Màu --}}
                                @if($product->variants && $product->variants->whereNotNull('color')->where('color', '!=', '')->count() > 0)
                                <div class="col-xs-6 col-sm-6 col-md-6" style="padding-right: 0;">
                                    <label for="color-select" >Chọn Màu:</label>
                                    <select name="color" id="color-select" class="form-control variant-option">
                                        <option value="">-- Chọn Màu --</option>
                                        @foreach($product->variants->unique('color') as $variant)
                                            @if($variant->color)
                                                <option value="{{ $variant->color }}">{{ $variant->color }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            </div>

                            {{-- Chọn số lượng & Tình trạng --}}
                            <div style="margin-bottom: 15px;">
                                <p style="margin-bottom: 5px;">Tình trạng: <b id="stock-status" style="color: #666;">Vui lòng chọn Size/Màu</b></p>
                                <label style="font-weight: bold;">Số lượng:</label>
                                <input type="number" name="quantity" value="1" min="1" style="width: 70px; padding: 5px; text-align: center;" class="form-control d-inline-block">
                            </div>

                            <fieldset style="border: none; padding: 0; margin-top: 10px;">
                                <input type="submit" id="add-to-cart-btn" name="submit" value="Thêm vào giỏ hàng" class="button" style="background: #337ab7; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;" />
                            </fieldset>
                        </form>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<!-- new -->
<div class="newproducts-w3agile">
    <div class="container">
        <h3>New offers</h3>
        <div class="agile_top_brands_grids">
            @foreach ($related_products as $key => $item)
                <div class="col-md-3 top_brand_left-1">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid_pos">
                                <img src="{{ asset('uploads/products/'. $item->image) }}" alt=" " class="img-responsive" style="height: 250px">
                            </div>
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="{{ route('san-pham', ['id' => $item->id]) }}"><img title=" " alt=" " src="{{ asset('uploads/products/'. $item->image) }}" style="height: 250px"></a>       
                                            <p>{{ $item->name_pd }}</p>
                                            <div class="stars">
                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                            </div>
                                            <h4>{{ number_format($item->price, 0, ',', '.') }} VNĐ<span>{{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</span></h4>
                                        </div>
                                        <div class="snipcart-details top_brand_home_details">
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <fieldset>
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <input type="submit" name="submit" value="Thêm vào giỏ hàng" class="button" />
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const variants = @json($product->variants);
        const basePrice = {{ $product->sale_price ?? $product->price }};

        const variantInputs = document.querySelectorAll('.variant-option');
        const displayPrice = document.getElementById('display-price');
        const stockStatus = document.getElementById('stock-status');
        const selectedSku = document.getElementById('selected-sku');
        const submitBtn = document.getElementById('add-to-cart-btn');

        variantInputs.forEach(input => {
            input.addEventListener('change', function () {
                const sizeSelect = document.getElementById('size-select');
                const colorSelect = document.getElementById('color-select');

                const selectedSize = sizeSelect ? sizeSelect.value : null;
                const selectedColor = colorSelect ? colorSelect.value : null;

                // Kiểm tra xem đã chọn đủ các thuộc tính chưa
                if ((sizeSelect && !selectedSize) || (colorSelect && !selectedColor)) {
                    stockStatus.innerText = 'Vui lòng chọn đầy đủ Size/Màu';
                    stockStatus.style.color = '#666';
                    return;
                }

                // Tìm biến thể khớp với tùy chọn
                const matchedVariant = variants.find(v => 
                    (!selectedSize || v.size === selectedSize) && 
                    (!selectedColor || v.color === selectedColor)
                );

                if (matchedVariant) {
                    if (selectedSku) selectedSku.value = matchedVariant.sku ?? '';

                    const finalPrice = matchedVariant.price ? matchedVariant.price : basePrice;
                    displayPrice.innerText = new Intl.NumberFormat('vi-VN').format(finalPrice);

                    if (matchedVariant.stock_quantity > 0) {
                        stockStatus.innerText = 'Còn hàng (' + matchedVariant.stock_quantity + ' sản phẩm)';
                        stockStatus.style.color = 'green';
                        submitBtn.disabled = false;
                        submitBtn.style.opacity = '1';
                    } else {
                        stockStatus.innerText = 'Hết hàng';
                        stockStatus.style.color = 'red';
                        submitBtn.disabled = true;
                        submitBtn.style.opacity = '0.5';
                    }
                } else {
                    stockStatus.innerText = 'Tùy chọn này hiện không sẵn có';
                    stockStatus.style.color = 'orange';
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                }
            });
        });
    });
</script>
@endsection