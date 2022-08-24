<input type="hidden" name="seo_id" value="{{ !empty($item->pages->id)&&$type=='edit' ? $item->pages->id : null }}" />

<div class="formBox">
    <div class="formBox_full">

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