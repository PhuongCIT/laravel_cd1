@extends('layouts.admin')
@section('title', 'Quản lý đơn hàng')
@section('contant')
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        {{-- <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> Sửa
                        </a> --}}
                        <a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left"></i> Về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30%;">
                                <strong>Tên trường</strong>
                            </th>
                            <th class="text-center" style="width:70%;">Giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('images/order/' . $order->image) }}"
                                    alt="{{ $order->image }}" style="width:70px; height:100px;">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên</td>
                            <td>{{ $order->delivery_name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $order->delivery_email }}</td>
                        </tr>
                        <tr>
                            <td>Giới tính</td>
                            <td>{{ $order->delivery_gender }}</td>
                        </tr>
                        <tr>
                            <td>số điện thoại</td>
                            <td>{{ $order->delivery_phone }}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>{{ $order->delivery_address }}</td>
                        </tr>
                        <tr>
                            <td>Ghi chú</td>
                            <td>{{ $order->note }}</td>
                        </tr>
                        <tr>
                            <td>type</td>
                            <td>{{ $order->type }}</td>
                        </tr>
                        <tr>
                            <td>Ngày tạo</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td>người tạo</td>
                            <td>{{ $order->created_by }}</td>
                        </tr>
                        <tr>
                            <td>Ngày cập nhật</td>
                            <td>{{ $order->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Người cập nhật</td>
                            <td>{{ $order->updated_by }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
@endsection
