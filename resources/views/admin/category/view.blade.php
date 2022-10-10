@extends('layouts.admin')
@section('content')
    @php
        $titlePage      = 'Thêm Category mới';
        $submit         = 'admin.category.create';
        $checkImage     = 'required';
        if(!empty($type)&&$type=='edit'){
            $titlePage  = 'Chỉnh sửa Category';
            $submit     = 'admin.category.update';
            $checkImage = null;
        }
    @endphp

    <form id="formAction" class="needs-validation invalid" action="{{ route($submit) }}" method="POST" novalidate="" enctype="multipart/form-data">
    @csrf

        <div class="pageAdminWithRightSidebar withRightSidebar">
            <div class="pageAdminWithRightSidebar_header">
                {{ $titlePage }}
            </div>
            <!-- Error -->
                @if ($errors->any())
                <ul class="errorList">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <!-- MESSAGE -->
            @include('admin.template.messageAction')
            <!-- Content -->
            <div class="pageAdminWithRightSidebar_main">
                <div class="pageAdminWithRightSidebar_main_content">
                    <!-- START:: Main content -->
                    <div class="pageAdminWithRightSidebar_main_content_item">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Thông tin trang</h4>
                            </div>
                            <div class="card-body pt-2">

                                @include('admin.category.formPage')

                            </div>
                        </div>
                    </div>
                    <div class="pageAdminWithRightSidebar_main_content_item">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Thông tin SEO</h4>
                            </div>
                            <div class="card-body pt-2">

                                @include('admin.form.formSeo')
                                
                            </div>
                        </div>
                    </div>
                    <div class="pageAdminWithRightSidebar_main_content_item fullWidth">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Nội dung</h4>
                            </div>
                            <div class="card-body pt-2">
    
                                @include('admin.form.formContent')
                                
                            </div>
                        </div>
                    </div>
                    <!-- END:: Main content -->
                </div>
                <div class="pageAdminWithRightSidebar_main_rightSidebar">
                    <!-- Button Save -->
                    <div class="pageAdminWithRightSidebar_main_rightSidebar_item buttonAction" style="padding-bottom:1rem;">
                        @if(!empty($item->pages->seo_alias_full))
                        <a href="/{{ $item->pages->seo_alias_full }}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </a>
                        @endif
                        <button type="button" class="btn btn-secondary waves-effect waves-float waves-light"  onClick="history.back();">Quay lại</button>
                        <button type="submit" class="btn btn-success waves-effect waves-float waves-light" onClick="javascript:submitForm('formAction');" style="width:100px;">Lưu</button>
                    </div>
                    <div class="customScrollBar-y" style="height: calc(100% - 70px);border-top: 1px dashed #adb5bd;">
                        <!-- Form Upload -->
                        <div class="pageAdminWithRightSidebar_main_rightSidebar_item">
                            @include('admin.form.formImage')
                        </div>
                        <!-- Form Slider -->
                        {{-- <div class="pageAdminWithRightSidebar_main_rightSidebar_item">
                            @include('admin.form.formSlider')
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">

        function submitForm(idForm){
            const elemt = $('#'+idForm);
            if(elemt.valid()) elemt.submit();
        }
        
    </script>
@endpush