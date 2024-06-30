@extends('layouts.site')
@section('title', 'Tin tức')
@section('content')
    <div class="container-fluid fruite bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-2 ">
                    <div class="mb-3 alert alert-light">
                        <h4>Chủ Đề</h4>
                        <ul class="list-unstyled fruite-categorie">
                            {{-- @foreach ($topic as $row)
                                <li>
                                    <div class="d-flex justify-content-between fruite-name">
                                        <a href="/post/{{ $row->slug }}">{{ $row->name }}</a>
                                    </div>
                                </li>
                            @endforeach --}}

                        </ul>
                    </div>
                </div>
                <div class="col-md-10 bg-light">
                    <div class="section_post_new ">
                        {{-- <h4 class="text-uppercase mb-3">>{{ $topic_list->name }}</h4> --}}
                        <div class="row">
                            @foreach ($post_list as $row)
                                <div class="col-md-12 mb-2">
                                    <div class="row post-item">
                                        <div class="col-md-3">
                                            <a href="/post/{{ $row->slug }}">
                                                <img class="img-fluid w-20" src="{{ asset('images/post/' . $row->image) }}"
                                                    alt="{{ $row->image }}">
                                            </a>
                                        </div>
                                        <div class="col-md-9">
                                            <h3>
                                                <a class="line-clamp line-clamp-1" href="/post/{{ $row->slug }}"
                                                    title="{{ $row->title }}">{{ $row->title }}</a>
                                            </h3>
                                            <p class="line-clamp line-clamp-1" href="/post/{{ $row->slug }}"
                                                title="{{ $row->detail }}">{{ $row->detail }}</p>
                                            <p class="justify line-clamp line-clamp-3">{{ $row->description }}</p>
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
    </div>
    </div>
@endsection
@section('header')

@endsection
