@extends('layouts.main')
@push('meta-info')
    @include('main.snippets.meta', compact('info'))
@endpush
@push('meta-schema')
    @include('main.schema.organization')
    @if(!empty($info))
        @include('main.schema.article', compact('info'))
        @include('main.schema.creativeworkseries', compact('info'))
    @endif
    @include('main.schema.breadcrumb', compact('breadcrumb'))
    @include('main.schema.itemlist', ['data' => $list])
@endpush
@section('content')
    <!-- === END:: Slider Home === -->
    <div class="mainContent" style="margin-top:-1.25rem;">
        <!-- === START:: BLOG === -->
        @include('main.home.file', compact('list'))
        <!-- === END:: BLOG === -->
    </div>
@endsection
@push('scripts-custom')

@endpush