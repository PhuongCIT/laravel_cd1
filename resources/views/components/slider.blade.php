<div class="my-5 py-4">
    <div id="carouselExampleIndicators" class="carousel slide my-4 " data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach ($list_slider as $row_slider)
                @if ($loop->first)
                    <div class="carousel-item active">
                        <img src="{{ asset('images/banner/' . $row_slider->image) }}"
                            class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                        <a href="#" class="btn px-4 py-2 text-white rounded">{{ $row_slider->name }}</a>
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{ asset('images/banner/' . $row_slider->image) }}"
                            class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                        <a href="#" class="btn px-4 py-2 text-white rounded">{{ $row_slider->name }}</a>
                    </div>
                @endif
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>
