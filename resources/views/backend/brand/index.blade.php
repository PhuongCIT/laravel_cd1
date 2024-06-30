@extends('layouts.admin')
@section('title', 'Quản lý thương hiệu')
@section('contant')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý thương hiệu</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.brand.trash') }}">
                            <i class="fas fa-trash"></i>
                            Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @includeIf('backend.message')

                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="name">Tên thương hiệu: *</label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                    placeholder="Nhập tên thương hiệu" id="name" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" value="{{ old('description') }}" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="sort_order">Sắp xếp</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">None</option>
                                    {!! $htmlsortorder !!}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image">Hình</label>
                                <input type="file" name="image" id="image" value="{{ old('image') }}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2">Chưa xuất bản</option>
                                    <option value="1">Xuất bản</option>
                                </select>
                            </div>
                            <div class="mb ">
                                <button class="btn btn-success" type="submit" id="submit" name="submit">
                                    <p>Thêm thương hiệu</p>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:30px">#</th>
                                    <th class="text-center" style="width:90px;">Hình</th>
                                    <th>Tên thương hiệu</th>
                                    <th>slug</th>
                                    <th class="text-center" style="width:190px">Chức năng</th>
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
                                            <img src="{{ asset('images/brand/' . $row->image) }}" class="img-fluid"
                                                alt="{{ $row->image }}">
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>
                                            {{ $row->slug }}
                                        </td>

                                        <td class="text-center">
                                            @if ($row->status == 1)
                                                <a href="{{ route('admin.brand.status', $args) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.brand.status', $args) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-toggle-off"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.brand.show', $args) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.brand.edit', $args) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.brand.delete', $args) }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
            </div>
        </div>
    </section>
@endsection
