@extends('layouts.site')
@section('title', 'Chi tiết bài viết')
@section('content')
    <div class="container-fluid py-5">
        <div class="row ">
            <div class="col-md-10">
                <h4 class="fw-bold "> {{ $post->title }}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p> ngày đăng: {{ $post->created_at }}</p>
                    </div>
                    <div class="col-md-6 text-end ">
                        <p class=" "> Được đăng bởi : {{ $post->created_by }}</p>
                    </div>
                </div>
                <hr class="text-danger fw-bold" />
                <div class="col-md mt-5">
                    <div class="border rounded">
                        <img src="{{ asset('images/post/' . $post->image) }}" class="img-fluid w-100"
                            alt="{{ $post->image }}">
                    </div>
                </div>
                <div class="col-md ">
                    <h5 class=" mb-3"> {{ $post->detail }}</h5>
                </div>
            </div>
            <div class="col-md">
                <h2 class="btn btn btn-dark">Bài viết liên quan</h2>
                <div class="row ">
                    @foreach ($list_post as $post)
                        <div class="card bg-light">
                            <div class="col-md-12 mt-3">
                                <div class="row post-item">
                                    <div class="col-md-3">
                                        <a href="/post/{{ $post->slug }}">
                                            <img class="img-fluid" style="width:70px; height: 70px;"
                                                src="{{ asset('images/post/' . $post->image) }}" alt="{{ $post->image }}">
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <a class="line-clamp line-clamp-1" href="/post/{{ $post->slug }}"
                                            title="{{ $post->title }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('header')

@endsection
@section('footer')

@endsection
