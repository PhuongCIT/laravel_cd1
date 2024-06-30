<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />

    @yield('header')
</head>

<body>
    <header>
        <div class="row mb-2 mt-5 text-center">
            <div class="col-md-4">
                <a href="{{ route('site.home') }}" class="navbar-brand">
                    <h1 class="text-primary display-6">DiDongViet</h1>
                </a>
            </div>
            <div class="col-md-4 mt-2">
                <form action="{{ route('site.product.search') }}" method="GET">
                    @csrf
                    <div class="input-group w-100 mx-auto d-flex">
                        <input type="text" class="form-control p-2" name="keyword"
                            placeholder="Nhập từ khóa tìm kiếm" aria-describedby="search-icon-1">
                        <button type="submit" id="search-icon-1"
                            class="input-group-text btn btn-primary btn-md-square p-2"><i
                                class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md ">
                @php
                    $count = count(session('carts', []));
                @endphp
                {{-- <a href="{{ route('site.product.filter') }}" class="position-relative  my-auto  me-3">
                    <i class="bi bi-funnel-fill fa-3x"></i>
                </a> --}}
                <a href="{{ route('site.cart.index') }}" class="position-relative  my-auto  me-3">
                    <i class="fa fa-shopping-bag fa-3x"></i>
                    <span
                        class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                        style="top: -25px; left: 25px; height: 30px; min-width: 30px;"
                        id="showqty">{{ $count }}</span>
                </a>

                @if (Auth::check())
                    @php
                        $user = Auth::user();
                    @endphp
                    @if (!$user->image)
                        <a href="{{ route('site.myaccount') }}" class="my-auto">
                            {{ $user->name }}
                        </a>
                    @else
                        <a href="{{ route('site.myaccount') }}" class="my-auto">
                            <img class="mr-2  rounded-circle  " style="width:50px "
                                src="{{ asset('images/user/' . $user->image) }}" alt="{{ $user->image }}">
                        </a>
                    @endif

                    <a href="{{ route('website.logout') }}" class="my-auto">
                        <span class="btn btn-danger">
                            <i class="bi bi-box-arrow-right"></i>
                        </span>

                    </a>
                @else
                    <a href="{{ route('website.getlogin') }}" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                @endif
            </div>
        </div>
    </header>
    <x-main-menu />
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-black-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">DiDongViet</h1>
                                <p class="text-secondary mb-0">Sản phẩm chất lượng</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-2 px-3 rounded-pill" type="number"
                                    placeholder="Your Email">
                                <button type="submit"
                                    class="btn btn-primary border-0 border-secondary py-2 px-3 position-absolute rounded-pill text-white"
                                    style="top: 0; right: 0;">Theo dõi ngay</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i
                                        class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Tại sao mọi người thích chúng tôi!</h4>
                            <p class="mb-4">typesetting, remaining essentially unchanged. It was popularised in the
                                1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                            <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Đọc
                                thêm</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Info</h4>
                            <a class="btn-link" href="">About Us</a>
                            <a class="btn-link" href="">Contact Us</a>
                            <a class="btn-link" href="">Privacy Policy</a>
                            <a class="btn-link" href="">Terms & Condition</a>
                            <a class="btn-link" href="">Return Policy</a>
                            <a class="btn-link" href="">FAQs & Help</a>
                        </div>
                    </div>

                    <div class="col-lg-3 text-black-50 col-md-6">
                        <div class="">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Địa chỉ: 18/152, tổ 8 khu phố 6, phường Linh Trung, TP.Thủ Đức, TP.HCM</p>
                            <p>Email: dvphuong@gmail.com</p>
                            <p>Phone: +123456789</p>
                            <p>Payment Accepted</p>
                            <img src="{{ asset('images/payment.png') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </footer>
    @yield('footer')



    @if (Session::has('message'))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "progressBar": true,
                    "closeButton": true,
                }
                toastr.error("{{ Session::get('message') }}");
            });
        </script>
    @endif

</body>

</html>
