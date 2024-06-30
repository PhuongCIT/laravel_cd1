<div class="rounded position-relative fruite-item border border-secondary border-top rounded-bottom rounded-top">
    @if ($product->pricesale > 0)
        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">sale
        </div>
    @endif
    <div class=" px-4">
        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}" class="text-center">
            <img src="{{ asset('images/product/' . $product->image) }}" class="img-fluid rounded-top pt-2"
                style="width: 100%; height:100%;" alt="{{ $product->image }}">
        </a>
    </div>
    <div class="p-1">
        <h4 class="card-title">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
        </h4>
        <p>Số lượng còn : {{ $product->qty }} </p>
        <div class="d-flex justify-content-between flex-lg-wrap text-end">
            @if ($product->pricesale > 0)
                <div class="col-md-12">
                    <p class=" text-decoration-line-through">{{ number_format($product->price) }} VND</p>
                </div>
                <div class="col-md-12">
                    <p class="fw-bold me-2 text-danger">{{ number_format($product->pricesale) }} VND</p>
                </div>
            @else
                <div class="col-md-12">
                    <p class="fw-bold me-2 text-danger">{{ number_format($product->price) }} VND</p>
                </div>
            @endif
        </div>
    </div>
</div>
