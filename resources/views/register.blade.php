@extends('layouts.site')
@section('title', 'Đăng Ký Tài Khoản')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-3 alert alert-info">
            <form action="{{ route('website.getregister') }}" method="post">
                @csrf
                <h1 class="text-center">Đăng ký</h1>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="name" required
                        aria-describedby="emailHelp" placeholder="Họ tên">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" required
                        aria-describedby="emailHelp" placeholder="tên đăng nhập">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="email" required
                        aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="mat khau"
                        required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="repassword" name="repassword"
                        placeholder="nhập lại mật khẩu" required>
                </div>

                <button type="submit" class=" btn btn-info">Đăng Ký</button>
            </form>
        </div>
    </div>
@endsection
@section('header')
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.15.4/css/all.css') }}" />
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css') }}"
        rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

@endsection
