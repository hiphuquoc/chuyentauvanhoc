@extends('layouts.admin')
@section('content')

<div class="titlePage">Danh sách Bài viết</div>
<!-- ===== START: SEARCH FORM ===== -->
<form id="formSearch" method="get" action="{{ route('admin.blog.list') }}">
<div class="searchBox">
    <div class="searchBox_item">
        <div class="input-group">
            <input type="text" class="form-control" name="search_name" placeholder="Tìm theo tên" value="{{ $params['search_name'] ?? null }}">
            <button class="btn btn-primary waves-effect" id="button-addon2" type="submit">Tìm</button>
        </div>
    </div>
    @if(!empty($categories))
        <div class="searchBox_item">
            <select class="form-select select2" name="search_category" onChange="submitForm('formSearch');">
                <option value="0">- Tìm theo Category -</option>
                @foreach($categories as $category)
                    @php
                        $selected   = null;
                        if(!empty($params['search_category'])&&$params['search_category']==$category->id) $selected = 'selected';
                    @endphp
                    <option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
</form>
<!-- ===== END: SEARCH FORM ===== -->

<div class="card">
    <!-- ===== Table ===== -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Ảnh</th>
                    <th class="text-center">Thông tin trang</th>
                    <th class="text-center">Thông tin SEO</th>
                    <th class="text-center" style="min-width:180px;">Khác</th>
                    <th class="text-center" width="60px">-</th>
                </tr>
            </thead>
            <tbody>
                @if($list->isNotEmpty())
                    @foreach($list as $item)
                        @include('admin.blog.oneRow', ['item' => $item])
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">Không tìm thấy dữ liệu phù hợp!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        function submitForm(idForm){
            const elemt = $('#'+idForm);
            if(elemt.valid()) elemt.submit();
        }
    </script>
@endpush