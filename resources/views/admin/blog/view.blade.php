@extends('layouts.admin')
@section('content')
@php
    $titlePage      = 'Thêm Bài viết mới';
    $submit         = 'admin.blog.create';
    $checkImage     = 'required';
    if($type=='edit'){
        $titlePage  = 'Chỉnh sửa Bài viết';
        $submit     = 'admin.blog.update';
        $checkImage = null;
    }else if($type=='copy') {
        $titlePage  = 'Sao chép Bài viết';
        $submit     = 'admin.blog.create';
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

                            @include('admin.blog.formPage')

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
                    <a href="/{{ $item->pages->seo_alias_full }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </a>
                    <button type="button" class="btn btn-secondary waves-effect waves-float waves-light" tabindex="-1">Quay lại</button>
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

    {{-- <!-- ===== Input Hidden ===== -->
    <input type="hidden" name="id_blog" value="{{ $item->id ?? 0 }}" />
    <input type="hidden" name="id_page" value="{{ $item->pages->id ?? 0 }}" />
    <!-- ===== Card Header ===== -->
    <div class="card-header">
        <h4 class="card-title">{{ $titlePage }}</h4>
    </div>
    <!-- ===== Card Body ===== -->
    <div class="card-body">
        <div class="formBox">
            <!-- One Column -->
            <div class="formBox_column2">
                <div class="formBox_column2_item">
                
                </div>
            </div>
            <!-- One Column -->
            <div class="formBox_column2">
                <div class="formBox_column2_item">
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <div class="inputWithNumberChacractor">
                        <span data-toggle="tooltip" data-placement="top" title="
                            Đây là Tiêu đề của Chuyên mục được hiển thị ngoài Google... Tốt nhất nên từ 55- 60 ký tự, có chứa từ khóa chính tranh top và thu hút người truy cập click
                        ">
                            <i class="explainInput" data-feather='alert-circle'></i>
                            <label class="form-label inputRequired" for="seo_title">Tiêu đề SEO</label>
                        </span>
                        <div class="inputWithNumberChacractor_count" data-charactor="seo_title">
                            {{ !empty($item->pages->seo_title) ? mb_strlen($item->pages->seo_title) : 0 }}
                        </div>
                    </div>
                    <input type="text" id="seo_title" class="form-control" name="seo_title" value="{{ old('seo_title') ?? $item->pages['seo_title'] ?? '' }}" required>
                    <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <div class="inputWithNumberChacractor">
                        <span class="inputWithNumberChacractor_label" data-toggle="tooltip" data-placement="top" title="
                            Đây là Mô tả của Chuyên mục được hiển thị ngoài Google... Tốt nhất nên từ 140 - 160 ký tự, có chứa từ khóa chính tranh top và mô tả được cái người dùng đang cần
                        ">
                            <i class="explainInput" data-feather='alert-circle'></i>
                            <label class="form-label inputRequired" for="seo_description">Mô tả SEO</label>
                        </span>
                        <div class="inputWithNumberChacractor_count" data-charactor="seo_description">
                            {{ !empty($item->pages->seo_description) ? mb_strlen($item->pages->seo_description) : 0 }}
                        </div>
                    </div>
                    <textarea class="form-control" id="seo_description"  name="seo_description" rows="5" required>{{ old('seo_description') ?? $item->pages['seo_description'] ?? '' }}</textarea>
                    <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là URL của trang Category để người dùng truy cập... viết liền không dấu và ngăn cách nhau bởi dấu gạch (-)... nên chứa từ khóa SEO chính và ngắn gọn
                    ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label inputRequired" for="seo_alias">Đường dẫn tĩnh</label>
                    </span>
                    <input type="text" id="seo_alias" class="form-control" name="seo_alias" value="{{ old('seo_alias') ?? $item->pages['seo_alias'] ?? '' }}" required>
                    <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là Số lượt đánh giá của trang Category này được hiển thị trên trang website và ngoài Google để thể hiện sự uy tín của Category (tự nhập tùy thích)
                    ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label inputRequired" for="rating_aggregate_count">Lượt đánh giá</label>
                    </span>
                    <input type="text" id="rating_aggregate_count" class="form-control" name="rating_aggregate_count" value="{{ old('rating_aggregate_count') ?? $item->pages['rating_aggregate_count'] ?? '' }}" required>
                    <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là Điểm đánh giá tương ứng của trang Category này được hiển thị trên trang website và ngoài Google để thể hiện sự uy tín của Category (tự nhập tùy thích)
                    ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label inputRequired" for="rating_aggregate_star">Điểm đánh giá</label>
                    </span>
                    <input type="text" id="rating_aggregate_star" class="form-control" name="rating_aggregate_star" value="{{ old('rating_aggregate_star') ?? $item->pages['rating_aggregate_star'] ?? '' }}" required>
                    <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là Mã Topic dùng đánh dấu Topic Clusther - Content Hub (sẽ cập nhật tính năng SEO này sau)
                    ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label" for="topic">Mã Topic</label>
                    </span>
                    <input type="text" id="topic" class="form-control" name="topic" disabled>
                </div>
                <!-- One Row -->
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là Ghi chú chỉ để xem và không hiển thị ở bất cứ đâu
                        ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label" for="note">Ghi chú</label>
                    </span>
                    <textarea class="form-control" id="note"  name="note" rows="3">{{ old('note') ?? $item->note ?? '' }}</textarea>
                </div>
                </div>
            </div>
            <!-- One Column -->
            <div class="formBox_full" style="margin-top:1rem;">
                <div class="formBox_column2_item_row">
                    <span data-toggle="tooltip" data-placement="top" title="
                        Đây là Nội dung chính của bài viết
                    ">
                        <i class="explainInput" data-feather='alert-circle'></i>
                        <label class="form-label" for="content">Nội dung bài viết</label>
                    </span>
                    <textarea class="form-control" id="content"  name="content" rows="30">{{ old('content') ?? $item->content ?? '' }}</textarea>
                </div>
            </div>
            <!-- One Row -->
            <div class="formBox_column2_item_row">
                <div class="form-check form-check-success">
                    <input type="checkbox" class="form-check-input" id="outstanding" name="outstanding" {{ !empty($item->outstanding) ? 'checked' : null }}>
                    <label class="form-check-label" for="outstanding">Đánh dấu đây là bài viết nổi bật!</label>
                </div>
            </div>
        </div>
        <!-- ===== Card Footer ===== -->
        <div class="card-footer text-end" style="border-top:none;padding-bottom:0;padding-right:0;">
            <button type="button" class="btn btn-secondary waves-effect waves-float waves-light" tabindex="-1">Quay lại</button>
            <button type="submit" class="btn btn-success waves-effect waves-float waves-light" onClick="javascript:submitForm('formAction');" style="width:100px;">Lưu</button>
        </div> --}}
</form>
@endsection
@push('scripts-custom')
    @include('admin.script.tiny')
    <!-- Script Page -->
    <script type="text/javascript">
        function submitForm(idForm){
            const elemt = $('#'+idForm);
            if(elemt.valid()) elemt.submit();
        }

        function readURL(input, idShow) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+idShow).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush