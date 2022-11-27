@extends('layouts.main')
@push('meta-info')
    @include('main.snippets.meta', compact('info'))
@endpush
@push('meta-schema')
    @include('main.snippets.schema', [
        'info'          => $info,
        'breadcrumb'    => $breadcrumb,
        'list'          => $list,
        'listType'      => ['article', 'creativeworkseries', 'listitem', 'breadcrumb']
    ])
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