  @extends('layouts.admin')
  @section('title', 'Quản lý Menu')
  @section('contant')

      <div class="content">
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h1>Thêm mới menu</h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="">Home</a></li>
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
                              <a class="btn btn-sm btn-info" href="{{ route('admin.menu.index') }}">
                                  <i class="fas fa-arrow-left"></i> Quay lại
                              </a>
                          </div>
                      </div>
                  </div>
                  <tbody>
                      <div>
                          <form action="{{ route('admin.menu.update', ['id' => $menu->id]) }}" method="POST">
                              @csrf
                              @method('put')
                              <div class="form-group">
                                  <label for="name">Tên</label>
                                  <input type="text" name="name" class="form-control" value="{{ $menu->name }}">
                              </div>
                              <div class="form-group">
                                  <label for="link">Đường dẫn</label>
                                  <input type="text" name="link" class="form-control" value="{{ $menu->link }}">
                              </div>
                              <div class="form-group">
                                  <label for="parent_id">Menu cha</label>
                                  <select name="parent_id" class="form-control">
                                      <option value="0" selected>None</option>
                                      @foreach ($menu_parent as $item)
                                          <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                      @endforeach
                                  </select>
                                  {{-- <input type="text" name="position" class="form-control" value="{{ $menu->position }}"> --}}
                              </div>
                              <div class="form-group">
                                  <label for="position">Vị trí</label>
                                  <select name="position" class="form-control">
                                      <option value="mainmenu">Main menu</option>
                                      <option value="footermenu">Footer menu</option>
                                  </select>
                                  {{-- <input type="text" name="position" class="form-control" value="{{ $menu->position }}"> --}}
                              </div>
                              <div class="form-group">
                                  <label for="status">Trạng thái</label>
                                  <select name="status" class="form-control">
                                      <option {{ $menu->status == 2 ? 'selected' : '' }} value="2">Chưa xuất bản
                                      </option>
                                      <option {{ $menu->status == 1 ? 'selected' : '' }} value="1">Xuất bản</option>
                                  </select>
                              </div>
                              <button type="submit" class="btn btn-success">Cập nhật</button>
                      </div>
                  </tbody>
              </div>
      </div>

  @endsection
