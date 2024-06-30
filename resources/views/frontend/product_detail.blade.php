@extends('layouts.site')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row ">
                <div class="col-md-12">
                    <div class="row">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid rounded"
                                            alt="{{ $product->image }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold mb-3"> {{ $product->name }}</h4>
                                @if ($product->pricesale > 0)
                                    <h5 class="fw-bold mb-3">Giá {{ number_format($product->pricesale) }} $</h5>
                                @else
                                    <h5 class="fw-bold mb-3">Giá {{ number_format($product->price) }} $</h5>
                                @endif
                                <div class="d-flex mb-4">
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star text-secondary"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5 class="mb-3">Hàng trong kho : <span class="text-danger">{{ $product->qty }}</span>
                                </h5>
                                <div class="input-group md-3">
                                    <input type="number" aria-describedby="basic-addon2" class="text-center" value="1"
                                        min="0" id="qty">
                                    <button onclick="handleAddCart({{ $product->id }})"
                                        class="btn border border-secondary text-primary" id="basic-addon2"><i
                                            class="fa fa-plus me-2 text-primary"></i>
                                        Thêm
                                        vào giỏ
                                    </button>
                                </div>

                            </div>

                            <div class="col-md-12 mt-5">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="related-tab" data-toggle="tab"
                                            data-target="#related" type="button" role="tab" aria-controls="related"
                                            aria-selected="true">Sản phẩm
                                            liên quan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="detail-tab" data-toggle="tab" data-target="#detail"
                                            type="button" role="tab" aria-controls="detail" aria-selected="false">Thông
                                            số kỹ thuật
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="comment-tab" data-toggle="tab" data-target="#comment"
                                            type="button" role="tab" aria-controls="comment" aria-selected="false">Bình
                                            luận</button>
                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="related" role="tabpanel"
                                        aria-labelledby="related-tab">
                                        <div class="row ">
                                            @foreach ($product_cat_list as $productitem)
                                                <div class="col-md-6 col-lg-3 col-xl-2">
                                                    <x-product-card :$productitem />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                                        thông số sản phẩm</div>
                                    <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                                        tích hợp facebook</div>

                                </div>
                            </div>
                            <form action="#">
                                <h4 class="mb-5 mt-5 fw-bold">Để lại một câu trả lời</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="text" class="form-control border-0 me-4"
                                                placeholder="Tên của bạn *">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="email" class="form-control border-0"
                                                placeholder="Email của bạn *">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                                                placeholder="Đánh giá của bạn *" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Vui lòng đánh giá:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <a href="#"
                                                class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                                Đăng
                                                bình luận</a>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('header')

@endsection
@section('footer')
    <script>
        function handleAddCart(productid) {
            let qty = document.getElementById("qty").value;
            $.ajax({
                url: "{{ route('site.cart.addcart') }}",
                type: "GET",
                data: {
                    productid: productid,
                    qty: qty
                },
                success: function(result, status, xhr) {
                    document.getElementById("showqty").innerHTML = result;
                    alert("Thêm thành công");
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            })
        }
    </script>
@endsection
