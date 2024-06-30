@extends('layouts.admin')
@section('title', 'Quản lý sản phẩm')
@section('contant')
    <div>
        <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="content">
                <!-- CONTENT -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Thêm mới sản phẩm</h1>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" name="update" class="btn btn-sm btn-success">
                                        <i class="fa fa-save"></i> Lưu
                                    </button>
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.product.index') }}">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                        <tbody>
                            <div>
                                <section class="content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="mb-3">
                                                    <label for="name">Tên sản phẩm</label>
                                                    <input type="text" value="{{ old('name', $product->name) }}"
                                                        name="name" id="name" class="form-control">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="detail">Chi tiết</label>
                                                    <textarea name="detail" id="detail" rows="8" class="form-control">{{ old('detail', $product->detail) }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description">Mô tả</label>
                                                    <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="category_id">Danh mục</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="brand_id">Thương hiệu</label>
                                                    <select name="brand_id" id="brand_id" class="form-control">
                                                        <option value="">Chọn thương hiệu</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}"
                                                                {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                                {{ $brand->name }}
                                                            </option>
                                                        @endforeach
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        {{ old('brand_id', $product->brand_id) }}
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="price">Giá</label>
                                                    <input type="number" value="{{ old('price', $product->price) }}"
                                                        name="price" id="price" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pricesale">Giá khuyến mãi</label>
                                                    <input type="number"
                                                        value="{{ old('pricesale', $product->pricesale) }}"
                                                        name="pricesale" id="pricesale" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qty">Số lượng</label>
                                                    <input type="number" value="{{ old('qty', $product->qty) }}"
                                                        name="qty" id="qty" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image">Hình</label>
                                                    <input type="file" name="image" id="image"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status">Trạng thái</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option {{ $product->status == 2 ? 'selected' : '' }}
                                                            value="2">
                                                            Chưa xuất bản</option>
                                                        <option {{ $product->status == 1 ? 'selected' : '' }}
                                                            value="1">
                                                            Xuất bản</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </section>
        </form>

    @endsection
