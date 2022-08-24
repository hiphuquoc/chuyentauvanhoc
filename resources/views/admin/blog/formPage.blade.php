<input type="hidden" name="id" value="{{ !empty($item->id)&&$type=='edit' ? $item->id : null }}" />

<div class="formBox">
    <div class="formBox_full">

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
                Bài viết này thuộc về các Category nào?
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label" for="category">Category</label>
            </span>
            <select class="select2 form-select select2-hidden-accessible" id="category" name="category[]" aria-hidden="true" multiple="true">
                @if(!empty($categoryAll))
                    @foreach($categoryAll as $c)
                        @php
                            $selected       = null;
                            if(!empty($category)){
                                foreach($category as $cActive){
                                    if($c->id===$cActive->id) {
                                        $selected = 'selected';
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <option value="{{ $c->id }}" {{ $selected }}>{{ $c->name }}</option>
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
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <span data-toggle="tooltip" data-placement="top" title="
                Bài viết phần 1, phần 2, phần 3 sẽ được ưu tiên hiển thị gợi ý cho nhau
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label" for="ordering">Bài viết liên quan đặc biệt</label>
            </span>
            <select class="select2 form-select select2-hidden-accessible" id="relation_blog" name="relation_blog[]" aria-hidden="true" multiple="true">
                @if(!empty($blogInCategory))
                    @foreach($blogInCategory as $blog)
                        @php
                            $selected   = null;
                            if(!empty($item->relationBlog)){
                                foreach($item->relationBlog as $b){
                                    if($blog->id==$b->blog_relation_id) {
                                        $selected = 'selected';
                                        break;
                                    }
                                }
                            }
                        @endphp 
                        <option value="{{ $blog->id }}" {{ $selected }}>{{ $blog->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <div class="form-check form-check-success">
                <input type="checkbox" class="form-check-input" id="outstanding" name="outstanding" {{ !empty($item->outstanding) ? 'checked' : null }}>
                <label class="form-check-label" for="outstanding">Đánh dấu đây là bài viết nổi bật</label>
            </div>
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <div class="form-check form-check-success">
                <input type="checkbox" class="form-check-input" id="download" name="download" {{ !empty($item->download) ? 'checked' : null }}>
                <label class="form-check-label" for="download">Cho phép tải bài này làm tài liệu</label>
            </div>
        </div>
    </div>
</div>