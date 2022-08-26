@extends('layouts.main')
@section('content')
    
    <div class="errorBox">
        <div class="container">
            <h1 class="zoom-area titlePage">Lỗi tải trang... Trang này không tồn tại!</h1>
            <section class="error-container">
                <span class="four"><span class="screen-reader-text">4</span></span>
                <span class="zero"><span class="screen-reader-text">0</span></span>
                <span class="four"><span class="screen-reader-text">4</span></span>
            </section>
            <div class="link-container">
                <a href="/" class="more-link"><i class="fa-solid fa-angles-left"></i>Quay lại trang chủ</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts-custom')
    
@endpush