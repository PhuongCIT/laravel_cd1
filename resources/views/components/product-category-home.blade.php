@foreach ($category_list as $cat_row)
    <div class="my-5 py-4">

        <h2>{{ $cat_row->name }}</h2>
        <div class="row">
            {{-- <div class="col-md-3">
                    <img class="img-fluid w-100" src="{{ asset('images/category/' . $cat_row->image) }}" alt="">
                </div> --}}
            <div class="col-md">
                <x-product-category :catrow="$cat_row" />
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('site.product.category', ['slug' => $cat_row->slug]) }}"
                            class="btn border border-secondary rounded-pill px-3 text-primary">Xem thêm sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endforeach
