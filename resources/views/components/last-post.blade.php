<div class="section_post_new my-5">
    <div class="container">
        <h1 class="text-uppercase  md-3">Tin tức mới nhất</h1>
        <div class="row">
            @foreach ($post_new as $post)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('site.post.detail', $post->slug) }}">
                                <img class="img-fluid " src="{{ asset('images/post/' . $post->image) }}"
                                    alt="{{ $post->image }}">
                            </a>
                            <h3>
                                <a class="line-clamp line-clamp-1" href="{{ route('site.post.detail', $post->slug) }}"
                                    title="{{ $post->title }}">{{ $post->title }}</a>
                            </h3>
                            <p class="justify line-clamp line-clamp-3">{{ $post->description }}</p>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- {{ route('site.post.detail', ['slug' => $post->slug]) }} --}}
