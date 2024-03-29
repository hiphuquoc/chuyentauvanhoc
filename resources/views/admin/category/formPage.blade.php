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
        {{-- <!-- One Row -->
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
        </div> --}}
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