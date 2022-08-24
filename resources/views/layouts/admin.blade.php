<!DOCTYPE html>
<html lang="vi">

<!-- === START:: Head === -->
<head>
    @include('admin.snippets.head')
</head>
<!-- === END:: Head === -->

<!-- === START:: Body === -->
<body>
    <!-- === START:: Header === -->
    {{-- <div class="headerTop">
        <div class="headerTop_phone"><i class="fa-solid fa-phone"></i>0388.189.089</div>
        <div class="headerTop_text">Chuyến tàu Văn Học - Học văn không khó vì có Cô Ngọc Anh!</div>
    </div> --}}
    @include('admin.snippets.menu')
    <!-- === END:: Header === -->

    <!-- === START:: Breadcrumb === -->
    {{-- @if(Route::current()->uri!=='/')
        @include('snippets.breadcrumb')
    @endif --}}
    
    <!-- === END:: Breadcrumb === -->

    <!-- === START:: Content === -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-body">
            
            <section id="basic-horizontal-layouts">
            @yield('content')
            </section>
            
        </div>
    </div>

    <!-- === START:: Footer === -->
    {{-- @include('snippets.footer') --}}
    <!-- === END:: Footer === -->
    
    <!-- === START:: Scripts Default === -->
    @include('admin.snippets.scripts-default')
    <!-- === END:: Scripts Default === -->

    <!-- === START:: Scripts Custom === -->
    @stack('scripts-custom')
    <!-- === END:: Scripts Custom === -->
</body>
<!-- === END:: Body === -->

</html>