@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <h3>Cập nhật thông tin sản phẩm</h3>
        <hr>
        <a href="{{ route('products.index') }}" class="btn btn-success" style="">Danh sách sản phẩm</a>
        <hr>
        @if (session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
        @elseif(session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('danger') }}
          </div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Tên sản phẩm:</label>
              <input type="text" class="form-control" name="name_pd" placeholder="Tên sản phẩm" value="{{ $product->name_pd }}" id="exampleInputEmail1" aria-describedby="emailHelp">
              @error('name_pd')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Hình ảnh:</label>
                <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp">
                <img src="{{ asset('uploads/products/'. $product->image) }}" alt="" class="img img-responsive" width="120" style="position: relative; top: 2px">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Giá:</label>
                <input type="number" class="form-control" name="price" placeholder="Giá sản phẩm" value="{{ $product->price }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('price')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Giá (sale):</label>
                <input type="number" class="form-control" name="sale_price" placeholder="Giá (sale) sản phẩm" value="{{ $product->sale_price }}" id="exampleInputEmail1" aria-describedby="emailHelp">            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mô tả ngắn:</label>
                <textarea class="form-control" name="short_description" placeholder="Mô tả ngắn ..." id="exampleInputPassword1">{{ $product->short_description }}</textarea>
                @error('short_descriptionn')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Mô tả:</label>
              <textarea class="form-control" name="description" placeholder="Mô tả sản phẩm ..." id="exampleInputPassword1">{{ $product->description }}</textarea>
              @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Danh mục:</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    @foreach ($categories as $key => $cate)
                        <option {{ ($cate->id==$product->category_id ? 'selected': '') }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                    @endforeach              
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nổi bật</label>
                <select class="form-select" name="is_featured" aria-label="Default select example">
                    @if($product->is_featured==1)
                        <option selected value="1">Nổi bật</option>
                        <option value="0">Mới</option>
                    @else
                        <option value="1">Nổi bật</option>
                        <option selected value="0">Mới</option>
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Trạng thái</label>
                <select class="form-select" name="status" aria-label="Default select example">
                    @if ($product->status==1)
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Tạm ẩn</option>
                    @else
                        <option value="1">Hiển thị</option>
                        <option selected value="0">Tạm ẩn</option>
                    @endif    
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
@endsection