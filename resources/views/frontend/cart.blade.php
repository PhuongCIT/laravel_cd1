@extends('layouts.site')
@section('title', 'Giỏ Hàng')
@section('content')
    <div class="container-fluid contact ">
        <div class="container pb-5">
            <div class=" bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Giỏ Hàng Của Tôi</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <form action="{{ route('site.cart.update') }}" method="POST">
                            @csrf
                            <table class="h-100 w-100 table table-border">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width:90px">Hình</th>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Giá </th>
                                        <th class="text-center">Thành tiền</th>
                                        <th class="text-center"><a href="{{ route('site.cart.deleteAll') }}"
                                                class="btn btn-danger">Xóa tất cả </a>
                                        </th>
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
                                                <input type="number" style="width:60px" min="1"
                                                    name="qty[{{ $row_cart['id'] }}]" value="{{ $row_cart['qty'] }}">
                                            </td>
                                            <td class="text-center rounded">{{ number_format($row_cart['price']) }}</td>
                                            <td class="text-center rounded">
                                                {{ number_format($row_cart['price'] * $row_cart['qty']) }}</td>
                                            <td class="text-center ">
                                                <a href="{{ route('site.cart.delete', ['id' => $row_cart['id']]) }}"
                                                    class=" btn btn-danger btn-sm"><i class="bi bi-x-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $totalMoney += $row_cart['price'] * $row_cart['qty'];
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-danger">
                                            <trong>Tổng tiền: {{ number_format($totalMoney) }} VND

                                            </trong>
                                        </th>
                                        <th colspan="4" class="text-end">
                                            <a href="{{ route('site.cart.checkout') }}"
                                                class="btn  border-secondary  bg-white text-primary">Thanh toán</a>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="text-end">
                                <a href="{{ route('site.home') }}" class="btn  border-secondary  bg-white text-primary">Mua
                                    thêm</a>
                                <button type="submit" class="btn  border-secondary  bg-white text-primary">Cập
                                    nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('header')

@endsection
