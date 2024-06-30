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
                    <form action="{{ route('admin.contact.update', ['id' => $contact->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="name">Tên khách hàng: *</label>
                            <input type="text" value="{{ old('name', $contact->name) }}" class="form-control"
                                name="name" name="fname" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="phone">Số điện thoại: *</label>
                            <input type="text" value="{{ old('phone', $contact->phone) }}" class="form-control"
                                name="phone" name="fname" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="email">Số Email: *</label>
                            <input type="text" value="{{ old('email', $contact->email) }}" class="form-control"
                                name="email" name="fname" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="title">Tiêu đề: *</label>
                            <input type="text" value="{{ old('title', $contact->title) }}" class="form-control"
                                name="title" name="fname" />
                        </div>
                        <div class="form-group">
                            <label class="content">Nội dung: *</label>
                            <input type="text" value="{{ old('content', $contact->content) }}" class="form-control"
                                name="content" name="fname" />
                        </div>
                        <div class="mb-3">
                            <label for="replay_id">replay_id</label>
                            <input name="replay_id" id="replay_id" value="{{ old('content', $contact->replay_id) }}"
                                class="form-control" />
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
