@extends('layouts.site')
@section('title', 'Contact')
@section('content')
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Liên lạc</h1>
                            <p class="mb-4">Biểu mẫu liên hệ hiện không hoạt động. Nhận biểu mẫu liên hệ hoạt động hiệu quả
                                với Ajax & PHP trong vài phút. Chỉ cần sao chép và dán các tập tin, thêm một chút mã và bạn
                                đã hoàn tất. <a href="https://htmlcodex.com/contact-form">Tải ngay</a>.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d15673.042816259049!2d106.79830899999997!3d10.867765000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1zMi8xODEgVMSDbmcgTmjGoW4gUGjDuiBUxINuZyBOaMahbiBQaMO6IEIgUXXhuq1uIDkgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2sus!4v1717990352016!5m2!1svi!2sus"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{ route('site.contact.addcontact') }}" method="post" class="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="w-100 form-control border-0 py-3 mb-4"
                                        placeholder="Tên của bạn" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="w-100 form-control border-0 py-3 mb-4" name="email"
                                        required placeholder="Nhập email của bạn">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="w-100 form-control border-0 py-3 mb-4"
                                        placeholder="số điện thoại" name="phone" required>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="w-100 form-control border-0 py-3 mb-4"
                                        placeholder="tiêu đề" name="title" required>
                                </div>
                            </div>
                            <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Tin nhắn của bạn"
                                name="content"></textarea>
                            <button class=" btn form-control py-3 bg-white text-primary " type="submit">Gửi</button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Địa chỉ</h4>
                                <p class="mb-2">18/152, tổ 8 khu phố 6, phường Linh Trung, TP.Thủ Đức, TP.HCM</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Gửi thư cho chúng tôi</h4>
                                <p class="mb-2">dvphuong@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Điện thoại</h4>
                                <p class="mb-2">+0123 4567 8910</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        @if (Session::has('message'))
            <script>
                toastr.options = {
                    "processBar": true,
                    "closeButton": true,
                }
                toastr.error("{{ Session::get('message') }}");
            </script>
        @endif
    @endpush


@endsection
@section('header')

@endsection
