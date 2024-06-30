@extends('layouts.site')
@section('title', 'Trang Chu')
@section('content')
    <!-- Navigation -->


    <!-- Page Content -->
    <div class="container">

        <x-slider />
        <x-product-new />
        <x-flash-sale />
        <x-product-category-home />
        <x-last-post />
    </div>

    <!-- /.container -->
@endsection
