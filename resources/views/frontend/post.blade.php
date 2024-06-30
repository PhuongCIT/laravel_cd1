@extends('layouts.site')
@section('title', 'Tin tức')
@section('content')
    <div class=" bg-light">

        <div class="row g-4">
            <div class="col-md-2 ">
                <div class="mb-3 alert alert-light">
                    <h4>Chủ Đề</h4>
                    <ul class="list-unstyled fruite-categorie">
                        @foreach ($topic_list as $topic_row)
                            <li>
                                <div class="d-flex justify-content-between fruite-name">
                                    {{-- <a href="{{ route('site.post.tocpic', $topic_row->slug) }}">{{ $topic_row->name }}</a> --}}
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-md-10 bg-light">
                <div class="section_post_new ">
                    <h4 class="text-uppercase mb-3">Tin tức mới nhất</h4>
                    <div class="row">
                        @foreach ($post_list as $post)
                            <div class="col-md-12 mb-2">
                                <div class="row post-item card">
                                    <div class="col-md-3">
                                        <a href="{{ route('site.post.detail', $post->slug) }}">
                                            <img style="max-height: 150px" class="img-fluid "
                                                src="{{ asset('images/post/' . $post->image) }}" alt="{{ $post->image }}">
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <h3>
                                            <a class="line-clamp line-clamp-1"
                                                href="{{ route('site.post.detail', $post->slug) }}"
                                                title="{{ $post->title }}">{{ $post->title }}</a>
                                        </h3>
                                        <p class="line-clamp line-clamp-1">{{ $post->detail }}</p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    {{ $post->links() }}
                                </div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>

    </div>
@endsection
@section('header')

@endsection
