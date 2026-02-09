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
@endpush
@section('content')
    <!-- === START:: Slider Home === -->
    @include('main.home.slider')
    <!-- === END:: Slider Home === -->
    <div class="mainContent">

        <!-- === START:: BLOG === -->
        @include('main.home.blogGrid')
        <!-- === END:: BLOG === -->

        <!-- === START:: BLOG === -->
        {{-- @include('main.home.blogThumnailAndList') --}}
        <!-- === END:: BLOG === -->

        <!-- === START:: BLOG === -->
        @include('main.home.fileLimit')
        <!-- === END:: BLOG === -->

        <!-- === START:: BLOG === -->
        @include('main.home.about')
        <!-- === END:: BLOG === -->
        
    </div>

@endsection
@push('scripts-custom')

@endpush