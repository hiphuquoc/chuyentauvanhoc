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

    <div class="container">
        <div class="pageContent">
            <div class="pageContent_content background">
            
                <h1 class="siteTitlePage">
                    {{ $info->pages->title ?? null }}
                    @if(!empty($searchName))
                    theo: "{{ $searchName }}"
                    @endif
                </h1>

                <div class="articleBox">
                    
                    @if($list->isNotEmpty())
                        @foreach ($list as $item)
                            <div class="articleBox_item">
                                <a href="{{ url($item->pages->seo_alias_full) }}" class="articleBox_item_image">
                                    <img src="/images/image-default-750x460.png" data-src="{{ $item->pages->image_small }}" alt="{{ $item->name }}" title="{{ $item->name }}" />
                                </a>
                                <div class="articleBox_item_content">
                                    <a href="{{ url($item->pages->seo_alias_full) }}" class="articleBox_item_content_title">
                                        <h2 class="maxLine_2">{{ $item->name }}</h2>
                                    </a>
                                    <div class="articleBox_item_content_subtitle">
                                        <span>
                                            <i class="fa-regular fa-clock"></i>
                                            {{ date('H:i, d/m/Y', strtotime($item->pages->updated_at)) }}
                                        </span>
                                        <span class="articleBox_item_content_subtitle_author">
                                            <i class="fa-solid fa-user-pen"></i>
                                            Cô Ngọc Anh
                                        </span>
                                    </div>
                                    <div class="articleBox_item_content_des maxLine_3">
                                        {{ $item->pages->description }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <div style="margin-bottom:0.25rem;">Không tìm thấy nội dung phù hợp!</div>
                    @endif

                    {{ !empty($list) ? $list->appends(request()->query())->links('main.blog.paginate') : '' }}

                </div>
            </div>
            <div class="pageContent_sidebar">
                @include('main.blog.sidebar', compact('category', 'outstanding'))
            </div>
            
        </div>
        
        @if(!empty($info->content))
            <div class="moreContent">
                <div id="js_viewMoreContent_element" class="moreContent_content">
                    <div>
                        {!! $info->content !!}
                    </div>
                </div>
                <div class="moreContent_button" onClick="viewMoreContent(this, 'js_viewMoreContent_element', 400);">
                    Xem thêm<i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        @endif
    </div>

@endsection
@push('scripts-custom')
    <script type="text/javascript">
        function viewMoreContent(btn, idContent, maxHeight){
            const heightNow     = $('#'+idContent).outerHeight();
            const heightFull    = $('#'+idContent+' div').outerHeight();
            if(Math.floor(heightNow)<Math.floor(heightFull)){
                $('#'+idContent).css('height', heightFull);
                $(btn).html('Thu gọn<i class="fa-solid fa-arrow-left-long"></i>');
            }else {
                $('#'+idContent).css('height', maxHeight);
                $(btn).html('Xem thêm<i class="fa-solid fa-arrow-right-long"></i>');
            }
        }
    </script>
    <!-- Facebook Script -->
    <script src="https://connect.facebook.net/vi_VN/sdk.js?hash=1589878c8f70a5f02472da6fb4fe2085" async="" crossorigin="anonymous"></script><script async="" defer="" crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v14.0&amp;appId=412989459053103&amp;autoLogAppEvents=1" nonce="X8ejeuha"></script>
@endpush