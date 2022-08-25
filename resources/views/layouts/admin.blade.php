<!DOCTYPE html>
<html lang="vi">

<!-- === START:: Head === -->
<head>
    @include('admin.snippets.head')
</head>
<!-- === END:: Head === -->

<!-- === START:: Body === -->
<body>

    <div id="js_loadingFull" class="loadingFull">
        <div class="spinner-grow text-primary" role="status" style="color:#fff !important;">
            <span class="visually-hidden"></span>
        </div>
    </div>

    <!-- === START:: Header === -->
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