@extends('layouts.admin')
@section('title', 'Thùng Rác Sản Phẩm')
@section('contant')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác Sản Phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
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
                        <a class="btn btn-sm btn-info" href="{{ route('admin.product.index') }}">
                            <i class="fa fa-arrow-left"></i> Về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30px">#</th>
                            <th class="text-center" style="width:90px;">Hình</th>
                            <th>Tên thương hiệu</th>
                            <th>slug</th>
                            <th class="text-center" style="width:220px">Chức năng</th>
                            <th class="text-center" style="width:30px">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                @php
                                    $args = ['id' => $row->id]; //gút gonj cho trạng thái
                                @endphp
                                <td class="text-center">
                                    <input type="checkbox" name="checkID[]" id="checkID">
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('images/product/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ $row->slug }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.product.show', $args) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.product.restore', $args) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-undo"></i>
                                    </a>

                                    <form class="d-inline" action="{{ route('admin.product.destroy', $args) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    {{ $row->id }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
