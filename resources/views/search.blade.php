@extends('layout') {{-- Đảm bảo 'layout' là tên file layout chính của bạn trong resources/views --}}

@section('content')
<div class="products">
    <div class="container">
        <h3 class="w3ls_w3l_banner_nav_right_grid_head w3ls_w3l_banner_nav_right_grid_head_sub">
            Kết quả tìm kiếm cho: "{{ request('keywords') }}"
        </h3>
        
        <div class="agile_top_brands_grids" style="margin-top: 30px;">
            @forelse($products as $product)
                <div class="col-md-3 top_brand_left" style="margin-bottom: 30px;">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid">
                            <div class="agile_top_brand_left_grid1">
                                <figure>
                                    <div class="snipcart-item block">
                                        <div class="snipcart-thumb">
                                            <a href="{{ url('/san-pham/' . $product->id) }}">
                                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name_pd }}" class="img-responsive" style="height: 200px; object-fit: cover; width: 100%;" />
                                            </a>
                                            <p>{{ $product->name_pd }}</p>
                                            <h4>
                                                @if($product->sale_price > 0)
                                                    {{ number_format($product->sale_price) }}đ 
                                                    <span>{{ number_format($product->price) }}đ</span>
                                                @else
                                                    {{ number_format($product->price) }}đ
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center" style="padding: 50px 0;">
                    <h4>Không tìm thấy sản phẩm nào phù hợp với từ khóa của bạn.</h4>
                </div>
            @endforelse
            <div class="clearfix"> </div>
        </div>
        
        <!-- Phân trang -->
        <div class="text-center">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection