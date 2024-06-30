@extends('layouts.site')
@section('title', 'Thông tin tài khoản')
@section('content')
    <div class="container-fluid contact ">
        <div class="container pb-5">
            <div class=" bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Thông tin tài khoản</h1>
                        </div>
                    </div>
                    @php
                        $user = Auth::user();
                    @endphp
                    <div class="col-lg-12 p-4 rounded">
                        <div class="row ">
                            <div class="col-md-3">
                                <img class="img-fluid  rounded-circle px-2" src="{{ asset('images/user/' . $user->image) }}"
                                    alt="{{ $user->image }}" style="width:200px; height:200px;">
                            </div>
                            <div class="col-md-9">
                                <div class="">Tên : {{ $user->name }}</div>
                                <div class="">số điện thoại : {{ $user->phone }}</div>
                                <div class="">giới tính : {{ $user->gender }}</div>
                                <div class="">Địa chỉ : {{ $user->address }}</div>
                                <div class="">Tên tài khoản : {{ $user->uername }}</div>
                                <div class="">email : {{ $user->email }}</div>
                                <div class="">Quyền : {{ $user->roles }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('header')


    @endsection
