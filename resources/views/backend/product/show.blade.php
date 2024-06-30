@extends('layouts.admin')
@section('title', 'Quản lý sản phẩm')
@section('contant')
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết sản phẩm</h1>
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
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> Sửa
                        </a>
                        <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-info">
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
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('images/product/' . $product->image) }}"
                                    alt="{{ $product->image }}" style="width:70px; height:100px;">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Slug</td>
                            <td>{{ $product->slug }}</td>
                        </tr>
                        <tr>
                            <td>Detail</td>
                            <td>{{ $product->detail }}</td>
                        </tr>
                        <tr>
                            <td>Mô tả</td>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <td>Danh mục id</td>
                            <td>{{ $product->category_id }}</td>
                        </tr>
                        <tr>
                            <td>thương hiệu id</td>
                            <td>{{ $product->brand_id }}</td>
                        </tr>
                        <tr>
                            <td>Số lượng</td>
                            <td>{{ $product->qty }}</td>
                        </tr>
                        <tr>
                            <td>Giá</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td>Giá khuyến mãi</td>
                            <td>{{ $product->pricesale }}</td>
                        </tr>
                        <tr>
                            <td>Ngày tạo</td>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                        <tr>
                            <td>người tạo</td>
                            <td>{{ $product->created_by }}</td>
                        </tr>
                        <tr>
                            <td>Ngày cập nhật</td>
                            <td>{{ $product->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Người cập nhật</td>
                            <td>{{ $product->updated_by }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>{{ $product->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
@endsection
