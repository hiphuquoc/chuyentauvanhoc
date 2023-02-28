<!DOCTYPE html>
<html lang="vi">

<!-- === START:: Head === -->
<head>
    @include('main.snippets.head')
</head>
<!-- === END:: Head === -->

<!-- === START:: Body === -->
<body>
    <!-- === START:: Header === -->
    {{-- <div class="headerTop">
        <div class="headerTop_phone"><i class="fa-solid fa-phone"></i>0828.580.381</div>
        <div class="headerTop_text">Chuyến tàu Văn Học - Học văn không khó vì có Cô Ngọc Anh!</div>
    </div> --}}
    @include('main.snippets.header')
    <!-- === END:: Header === -->

    <!-- === START:: Breadcrumb === -->
    @if(Route::current()->uri!=='/')
        @if(!empty($breadcrumb))
            @include('main.snippets.breadcrumb', compact('breadcrumb'))
        @endif
    @endif
    <!-- === END:: Breadcrumb === -->

    <!-- === START:: Content === -->
    @yield('content')

    <!-- === START:: Footer === -->
    @include('main.snippets.footer')
    <!-- === END:: Footer === -->

    <div id="gotoTop" class="gotoTop" onclick="javascript:gotoTop();" style="display: block;">
        <i class="fas fa-chevron-up"></i>
    </div>
    
    <!-- === START:: Scripts Default === -->
    @include('main.snippets.scripts-default')
    <!-- === END:: Scripts Default === -->

    <!-- === START:: Scripts Custom === -->
    @stack('scripts-custom')
    <!-- === END:: Scripts Custom === -->
</body>
<!-- === END:: Body === -->

</html>
