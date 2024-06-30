<div class="row">
    @foreach ($product_cat_list as $productitem)
        <div class="col-md-6 col-lg-6 col-xl-3 mt-4 mb-4">
            <x-product-card :$productitem />
        </div>
    @endforeach

</div>
