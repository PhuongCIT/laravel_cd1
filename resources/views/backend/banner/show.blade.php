@extends('layouts.admin')
@section('title', 'Quản lý thương hiệu')
@section('contant')
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết banner</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> Sửa
                        </a>
                        <a href="{{ route('admin.banner.delete', $banner->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-sm btn-info">
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
                            <td>{{ $banner->id }}</td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('images/banner/' . $banner->image) }}"
                                    alt="{{ $banner->image }}" style="width:70px; height:100px;">
                            </td>
                        </tr>
                        <tr>
                            <td>Tên</td>
                            <td>{{ $banner->name }}</td>
                        </tr>

                        <tr>
                            <td>Ngày tạo</td>
                            <td>{{ $banner->created_at }}</td>
                        </tr>
                        <tr>
                            <td>người tạo</td>
                            <td>{{ $banner->created_by }}</td>
                        </tr>
                        <tr>
                            <td>Ngày cập nhật</td>
                            <td>{{ $banner->updated_at }}</td>
                        </tr>
                        <tr>
                            <td>Người cập nhật</td>
                            <td>{{ $banner->updated_by }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>{{ $banner->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
@endsection
