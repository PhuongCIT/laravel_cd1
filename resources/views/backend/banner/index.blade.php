@extends('layouts.admin')
@section('title', 'Quản lý Banner')
@section('contant')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý Banner</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.banner.trash') }}">
                            <i class="fas fa-trash"></i> Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Tên banner : *</label>
                                <input type="text" value="{{ old('name') }}" name="name" id="name"
                                    class="form-control" placeholder="Nhập tên banner">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="link">Liên kết</label>
                                <input type="text" value="{{ old('link') }}" name="link" id="link"
                                    class="form-control" placeholder="Nhập Link liên kết">
                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="position">Vị trí</label>
                                <select name="position" id="position" class="form-control">
                                    <option value="0">None</option>
                                    <option value="slideshow">Slideshow</option>
                                    {!! $htmlparentid !!}
                                </select>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="2">Chưa xuất bản</option>
                                    <option value="1">Xuất bản</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create" class="btn btn-success">Thêm banner</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:30px">#</th>
                                    <th class="text-center" style="width:90px">Hình</th>
                                    <th>Tên banner</th>
                                    <th>Vị trí</th>
                                    <th class="text-center" style="width:190px">Chức năng</th>
                                    <th class="text-center" style="width:30px">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                    <tr>
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <td class="text-center">
                                            <input type="checkbox" name="checkID[]" id="checkID">
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('images/banner/' . $row->image) }}" class="img-fluid"
                                                alt="{{ $row->image }}">
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>
                                            {{ $row->position }}
                                        </td>
                                        <td class="text-center">
                                            @if ($row->status == 1)
                                                <a href="{{ route('admin.banner.status', $args) }}"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.banner.status', $args) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-toggle-off"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.banner.show', $args) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.banner.edit', $args) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.banner.delete', $args) }}"
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
    </section>
@endsection
