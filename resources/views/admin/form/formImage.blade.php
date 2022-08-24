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

@push('scripts-custom')
    <script type="text/javascript">

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