@extends('layouts.admin')
@section('title', 'Chỉnh sửa Banner')
@section('contant')
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật banner</h1>
                </div>

            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a class="btn btn-sm btn-info" href="{{ route('admin.banner.index') }}">
                            <i class="fas fa-arrow-left"></i> Quay về danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.banner.update', ['id' => $banner->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name">Tên danh mục</label>
                        <input type="text" value="{{ old('name', $banner->name) }}" name="name" id="name"
                            class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Mô tả</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $banner->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link">Liên kết</label>
                        <input type="text" value="{{ old('link', $banner->link) }}" name="link" id="link"
                            class="form-control" placeholder="Nhập Link liên kết">
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
                            <option {{ $banner->status == 2 ? 'selected' : '' }} value="2">Chưa xuất bản</option>
                            <option {{ $banner->status == 1 ? 'selected' : '' }} value="1">Xuất bản</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="create" class="btn btn-success">Cập nhât</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
@endsection
