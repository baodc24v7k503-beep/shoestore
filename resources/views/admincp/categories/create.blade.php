@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tạo danh mục</h3>
        <hr>
        <a href="{{ route('categories.index') }}" class="btn btn-success" style="">Danh sách danh mục</a>
        <hr>
        @if (@session()->has('success'))
          <div class="alert alert-success">
            {{ session()->get('success') }}
          </div>
        @elseif(@session()->has('error'))
          <div class="alert alert-danger">
            {{ session()->get('danger') }}
          </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Tên danh mục:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
              @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mã danh mục (slug):</label>
                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('slug')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Mô tả:</label>
              <input type="text" class="form-control" name="description" value="{{ old('description') }}" id="exampleInputPassword1">
              @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Trạng thái:</label>
              <select class="form-select" name="status" aria-label="Default select example">
                <option value="1">Hiển thị</option>
                <option value="0">Tạm ẩn</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Tạo</button>
          </form>
    </div>
@endsection