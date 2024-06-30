@extends('layouts.site')
@section('title', 'Tìm kiếm sản phẩm')
@section('content')
    <div class="container-fluid fruite py-5">
        <div class="container">
            <div class="col-lg">
                <div class="row mb-3 ">
                    <h3 class="mt-5 mb-5 rounded">kết quả tìm kiếm </h3>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($products as $product)
                        <div class="col-md-3 ">
                            <div
                                class="col-md  rounded position-relative  border border-secondary border-top rounded-bottom rounded-top">
                                @if ($product->pricesale > 0)
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">sale
                                    </div>
                                @endif
                                <div class="">
                                    <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset('images/product/' . $product->image) }}"
                                            class="img-fluid w-90 h-100 rounded-top pt-2" alt="{{ $product->image }}">
                                    </a>
                                </div>
                                <div class="p-4">
                                    <h4 class="card-title">
                                        <a
                                            href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        @if ($product->pricesale > 0)
                                            <h5 class="fw-bold me-2 text-danger">{{ number_format($product->pricesale) }} $
                                            </h5>
                                            <h5 class=" text-decoration-line-through">{{ number_format($product->price) }} $
                                            </h5>
                                        @else
                                            <h5 class="fw-bold me-2 text-danger">{{ number_format($product->price) }} $</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <div class="pagination">
                                {{ $products->links() }}
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
