@extends('layouts.admin')
@section('title', 'Quản lý liên hệ')
@section('contant')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý liên hệ</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-danger" href="{{ route('admin.contact.index') }}">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
            <tbody>
                <div>
                    <form action="{{ route('admin.contact.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="name">Tên khách hàng: *</label>
                            <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                placeholder="Nhập tên khách hàng" name="fname" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="phone">Số điện thoại: *</label>
                            <input type="text" value="{{ old('phone') }}" class="form-control" name="phone"
                                placeholder="Nhập số điện thoại" name="fname" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="email">Số Email: *</label>
                            <input type="text" value="{{ old('email') }}" class="form-control" name="email"
                                placeholder="Nhập Email" name="fname" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="title">Tiêu đề: *</label>
                            <input type="text" class="form-control" name="title" placeholder="Nhập tiêu đề"
                                name="fname" />
                        </div>
                        <div class="form-group">
                            <label class="content">Nội dung: *</label>
                            <input type="text" class="form-control" name="content" placeholder="Nhập nội dung"
                                name="fname" />
                        </div>
                        <div class="mb-3">
                            <label for="replay_id">Sắp xếp: *</label>
                            <select name="replay_id" id="replay_id" class="form-control">
                                <option value="0">None</option>
                                {!! $htmlreplayid !!}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="2">Chưa xuất bản</option>
                                <option value="1">Xuất bản</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="create" class="btn btn-success">Thêm liên hệ</button>
                        </div>
                    </form>
                </div>
            </tbody>
        </div>
        </div>
    </section>
@endsection
