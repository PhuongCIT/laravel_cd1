@extends('layouts.site')
@section('title', 'Thanh Toán')
@section('content')
    <div class="container-fluid contact">
        <div class="container pb-5">
            <div class=" bg-light rounded">
                <form action="{{ route('site.cart.docheckout') }}" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Thanh toán</h1>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md">
                                    <table class="h-100 w-100 table table-border">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th style="width:90px">Hình</th>
                                                <th>Tên sản phẩm</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-center">Giá </th>
                                                <th class="text-center">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalMoney = 0;
                                            @endphp
                                            @foreach ($list_cart as $row_cart)
                                                <tr>
                                                    <td>{{ $row_cart['id'] }}</td>
                                                    <td>
                                                        <img class="img-fluid"
                                                            src="{{ asset('images/product/' . $row_cart['image']) }}"
                                                            alt="{{ $row_cart['image'] }}">
                                                    </td>
                                                    <td>{{ $row_cart['name'] }}</td>
                                                    <td class="text-center rounded">
                                                        {{ $row_cart['qty'] }}
                                                    </td>
                                                    <td class="text-center rounded">{{ number_format($row_cart['price']) }}
                                                    </td>
                                                    <td class="text-center rounded">
                                                        {{ number_format($row_cart['price'] * $row_cart['qty']) }}</td>
                                                </tr>
                                                @php
                                                    $totalMoney += $row_cart['price'] * $row_cart['qty'];
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-danger fw-bold">
                                    <trong>Tổng tiền: {{ number_format($totalMoney) }} $</trong>
                                </div>
                                <div class="col-md-6  text-end">
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-danger">Đặt Mua</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            @if (!Auth::check())
                                <div class="col-md">
                                    <a href="{{ route('website.getlogin') }}">Hãy đăng nhập để thanh toán</a>
                                </div>
                            @else
                                <div class="col-md">

                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <label>Họ tên</label>
                                                <input type="text" class="form-control" name="name" required
                                                    value="{{ $user->name }}">
                                            </div>
                                            <div class="mb-6">
                                                <label>Giới tính</label>
                                                <input type="text" class="form-control" name="gender" required
                                                    value="{{ $user->gender }}">
                                            </div>

                                        </div>

                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" required
                                                value="{{ $user->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Điẹn thoại</label>
                                            <input type="text" class="form-control" name="phone" required
                                                value="{{ $user->phone }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" required
                                                value="{{ $user->address }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Ghi chú</label>
                                            <textarea type="text" class="form-control" name="note" value="{{ $user->address }}"></textarea>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('header')


@endsection
