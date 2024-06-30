@extends('layouts.site')
@section('title', 'Tất cả sản phẩm')
@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container py-2">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-xl-12 mb-3 ">
                                    <form action="{{ route('site.product.search') }}" method="GET">
                                        @csrf
                                        <div class="input-group w-100 mx-auto d-flex">
                                            <input type="text" class="form-control p-4" name="keywork"
                                                placeholder="Nhập từ khóa tìm kiếm" aria-describedby="search-icon-1">
                                            <button type="submit" id="search-icon-1" class="input-group-text p-3"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="alert alert-primary w-100">Danh Mục</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($category_list as $cat_row)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a
                                                            href="">{{ $cat_row->name }}</a>
                                                        <span>(3)</span>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="alert alert-primary w-100">Thương Hiệu</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($brand_list as $brand_row)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#"></i>{{ $brand_row->name }}</a>
                                                        <span>(3)</span>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div> --}}
                                <!-- Form lọc sản phẩm -->
                                <form action="{{ route('site.product.product_filter') }}" method="GET">
                                    @csrf
                                    {{-- <!-- Lọc theo danh mục -->
                                    <label>Chọn danh mục:</label><br>
                                    <select class="form-group" name="category">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($category_list as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select><br> 
                                    <!-- Lọc theo thương hiệu -->
                                    <label>Chọn thương hiệu:</label><br>
                                    <select name="brand">
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach ($brand_list as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select><br> --}}

                                    <label class="text-danger">Chọn Danh mục:</label><br>
                                    @foreach ($category_list as $category)
                                        <label>
                                            <input type="checkbox" name="category[]" value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </label><br>
                                    @endforeach
                                    <label class="text-danger">Chọn thương hiệu:</label><br>
                                    @foreach ($brand_list as $brand)
                                        <label>
                                            <input type="checkbox" name="brands[]" value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </label><br>
                                    @endforeach

                                    <!-- Lọc theo giá -->
                                    {{-- <label for="min_price">Giá từ:</label>
                                    <input type="number" id="min_price" name="min_price" min="0" step="any"
                                        class="px-1">

                                    <label for="max_price">Đến:</label>
                                    <input type="number" id="max_price" name="max_price" min="0" step="any"> --}}
                                    <input type="range" id="max_price" name="max_price" min="1000000" max="50000000"
                                        step="1000" class="px-1"
                                        oninput="document.getElementById('max_price_value').innerText = this.value">
                                    <span id="max_price_value">0</span>
                                    <div class="col-md-6  btn tbn-primary">
                                        <button class="btn btn-primary" type="submit">Lọc</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row mb-3 ">
                                <h1 class="text-center text-uppercase alert alert-primary ">Tất cả sản phẩm</h1>
                            </div>
                            <div class="row g-4 justify-content-center">
                                @foreach ($product_all_list as $productitem)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <x-product-card :$productitem />
                                    </div>
                                @endforeach
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        {{ $product_all_list->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('header')


@endsection
