<div class="formBox">
    <div class="formBox_full">

        <!-- One Column -->
        <textarea class="form-control" id="content"  name="content" rows="30">{{ old('content') ?? $item->content ?? '' }}</textarea>

    </div>
</div>

@push('scripts-custom')
    <script type="text/javascript">
        

    </script>
@endpush