<div class="row my-5 py-4">
    <h1 class="">Sản Phẩm Khuyến Mãi</h1>
    @foreach ($product_sale as $productitem)
        <div class="col-md-6 col-lg-6 col-xl-3 mt-4 mb-4">
            <x-product-card :$productitem />
        </div>
    @endforeach
</div>
