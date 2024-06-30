@extends('layouts.site')
@section('title', 'sản phẩm theo danh mục')
@section('content')
    <div class="container ">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <h4 class="alert alert-primary w-100">Danh Mục</h4>
                            <ul class="list-unstyled fruite-categorie">
                                @foreach ($row_cat as $cat_row)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#">{{ $cat_row->name }}</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <h4 class="alert alert-primary w-100">Thương Hiệu</h4>
                            <ul class="list-unstyled fruite-categorie">
                                @foreach ($row_brand as $brand_row)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="#">{{ $brand_row->name }}</a>
                                            <span>(3)</span>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="row ">
                    <h4 class="text-center text-uppercase alert alert-primary mb-4">{{ $category->name }}
                    </h4>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($product_cat_list as $productitem)
                        <div class="col-md-6 col-lg-6 col-xl-4">
                            <x-product-card :$productitem />
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $product_cat_list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('header')

@endsection
