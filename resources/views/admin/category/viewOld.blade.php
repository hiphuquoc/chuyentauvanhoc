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
    <div class="card">
        <form id="formCategory" class="needs-validation invalid" action="{{ route($submit) }}" method="POST" novalidate="" enctype="multipart/form-data">
        @csrf
        <!-- ===== Input Hidden ===== -->
        <input type="hidden" name="id_category" value="{{ $item->id ?? 0 }}" />
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
                        <!-- One Row -->
                        <div class="formBox_column2_item_row">
                            <div class="inputWithNumberChacractor">
                                <span data-toggle="tooltip" data-placement="top" title="
                                    Đây là Tiêu đề của Chuyên mục được hiển thị trên website
                                ">
                                    <i class="explainInput" data-feather='alert-circle'></i>
                                    <label class="form-label inputRequired" for="title">Tiêu đề Trang</label>
                                </span>
                                <div class="inputWithNumberChacractor_count" data-charactor="title">
                                    {{ !empty($item->pages->title) ? mb_strlen($item->pages->title) : 0 }}
                                </div>
                            </div>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $item->pages['title'] ?? '' }}" required>
                            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                        </div>
                        <!-- One Row -->
                        <div class="formBox_column2_item_row">
                            <div class="inputWithNumberChacractor">
                                <span data-toggle="tooltip" data-placement="top" title="
                                    Đây là Mô tả của Chuyên mục được hiển thị trên website
                                ">
                                    <i class="explainInput" data-feather='alert-circle'></i>
                                    <label class="form-label inputRequired" for="description">Mô tả Trang</label>
                                </span>
                                <div class="inputWithNumberChacractor_count" data-charactor="description">
                                    {{ !empty($item->pages->description) ? mb_strlen($item->pages->description) : 0 }}
                                </div>
                            </div>
                            <textarea class="form-control" id="description"  name="description" rows="5" required>{{ old('description') ?? $item->pages['description'] ?? '' }}</textarea>
                            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                        </div>
                        <!-- One Row -->
                        <div class="formBox_column2_item_row">
                            <span data-toggle="tooltip" data-placement="top" title="
                                Đây là Ảnh đại diện của Chuyên mục dùng làm Ảnh đại diện trên website, Ảnh đại diện ngoài Google, Ảnh đại diện khi Share link
                            ">
                                <i class="explainInput" data-feather='alert-circle'></i>
                                <label class="form-label inputRequired" for="image">Ảnh đại diện <span style="font-weight:700;">750 * 460 px</span></label>
                            </span>
                            <input class="form-control" type="file" id="image" name="image" onchange="readURL(this, 'imageUpload');" {{ $checkImage }}>
                            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
                            <div class="imageUpload">
                                @php
                                    $image  = '/images/image-default-750.png';
                                    if(!empty($item->pages->image_small)&&$type!='copy') $image = $item->pages->image_small ?? $item->pages->image;
                                @endphp
                                <img id="imageUpload" src="{{ $image }}" />
                            </div>
                        </div>
                        <!-- One Row -->
                        <div class="formBox_column2_item_row">
                            <span data-toggle="tooltip" data-placement="top" title="
                                Chọn một Category khác làm Category cha
                            ">
                                <i class="explainInput" data-feather='alert-circle'></i>
                                <label class="form-label" for="parent">Category cha</label>
                            </span>
                            <select class="select2 form-select select2-hidden-accessible" id="parent" name="parent" aria-hidden="true">
                                <option value="0">- Vui lòng chọn -</option>
                                @if(!empty($category))
                                    @foreach($category as $c)
                                        @if($type=='copy')
                                            @php
                                                $selected   = null;
                                                if(!empty($item->category_parent)&&$c->id==$item->category_parent) $selected = 'selected';
                                            @endphp
                                            <option value="{{ $c->id }}" {{ $selected }}>{{ $c->name }}</option>

                                        @else
                                            @if(!empty($item->id)&&$item->id!=$c->id)
                                                @php
                                                    $selected   = null;
                                                    if(!empty($item->category_parent)&&$c->id==$item->category_parent) $selected = 'selected';
                                                @endphp
                                                <option value="{{ $c->id }}" {{ $selected }}>{{ $c->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- One Row -->
                        <div class="formBox_column2_item_row">
                            <span data-toggle="tooltip" data-placement="top" title="
                                Nhập vào một số để thể hiện độ ưu tiên khi hiển thị cùng các Category khác (Số càng nhỏ càng ưu tiên cao - Để trống tức là không ưu tiên)
                            ">
                                <i class="explainInput" data-feather='alert-circle'></i>
                                <label class="form-label" for="ordering">Thứ tự</label>
                            </span>
                            <input type="number" min="0" id="ordering" class="form-control" name="ordering" value="{{ old('ordering') ?? $item->pages['ordering'] ?? '' }}">
                        </div>
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
                </div>
            </div>
            
        </div>
        <!-- ===== Card Footer ===== -->
        <div class="card-footer text-end" style="border-top:none;padding-bottom:0;padding-right:0;">
            <button type="button" class="btn btn-secondary waves-effect waves-float waves-light" tabindex="-1">Quay lại</button>
            <button type="submit" class="btn btn-success waves-effect waves-float waves-light" onClick="javascript:submitForm('formCategory');" style="width:100px;">Lưu</button>
        </div>
    </form>

</div>
@endsection
@push('scripts-custom')
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