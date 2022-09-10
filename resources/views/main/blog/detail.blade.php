@extends('layouts.main')
@push('meta-info')
    @include('main.snippets.meta', compact('info'))
@endpush
@push('meta-schema')
    @include('main.snippets.schema', [
        'info'          => $info,
        'breadcrumb'    => $breadcrumb,
        'list'          => [],
        'listType'      => ['article', 'creativeworkseries', 'breadcrumb']
    ])
@endpush
@section('content')

@if(!empty($info))
   <div class="container">
      <div class="pageContent">
         <div class="pageContent_content">

            <!-- ===== START:: H1 Title Blog ===== -->
            <h1 class="siteTitleBlog">{{ $info->pages->title ?? null }}</h1>
            <!-- ===== END:: H1 Title Blog ===== -->

            <!-- ===== START:: Social Box ===== -->
            @include('main.blog.socialDetail', compact('info'))
            <!-- ===== END:: Social Box ===== -->

            <!-- ===== START:: Content Blog ===== -->
            @if(!empty($info->content))
               <div class="backgroundFull js_buildTocContent_content" style="text-align:justify;">
                  @if(!empty($info->pages->image))
                     <img src="{{ $info->pages->image }}" src="{{ $info->pages->title }}" title="{{ $info->pages->title }}" style="margin-bottom:1rem;width:100%;" />
                  @endif
                  
                  <div id="tocContent"></div>

                  {{-- @include('main.blog.tocContent', compact('info')) --}}

                  {!! $info->content !!}
               </div>
            @endif
            <!-- ===== END:: Content Blog ===== -->

            <!-- ===== START:: Related Blog ===== -->
            @if(!$related->isEmpty())
               @include('main.blog.related', compact('special', 'related'))
            @endif
            <!-- ===== START:: Related Blog ===== -->

         </div>
         <div class="pageContent_sidebar">
            @include('main.blog.sidebar', compact('category', 'outstanding'))
         </div>
      </div>
   </div>
@endif

@endsection
@push('scripts-custom')
   <script type="text/javascript">
      $(window).ready(function(){
         buildTocContent();

         $('.pageContent').find('table:not(.noResponsive)').each(function(){
            $(this).wrapAll('<div class="customScrollBar-x" />');
         })
      });

      function buildTocContent(elemtSearch = 'js_buildTocContent_content'){
         let data    = [];
         let i       = 0;
         $('.'+elemtSearch).find('h2, h3').each(function(){
               let idHeading   = $(this).attr('id');
               if(idHeading==null) idHeading = 'buildTocContent_'+i;
               // add id cho heading
               $(this).attr('id', idHeading);
               // tạo mảng truyển dữ liệu xử lý
               data.push({
                  type    : this.nodeName,
                  content : $(this).html(),
                  id      : idHeading
               });
               ++i;
         });
         $.ajax({
               url         : '{{ route("main.blog.buildTocContent") }}',
               type        : 'get', 
               dataType    : 'html',
               data        : {
                  // _token  : '{{ csrf_token() }}',
                  data    : data
               },
               success     : function(data){
                  $('#tocContent').html(data);
                  // fixedTocContentIcon();
                  setHeightTocFixed();

                  $(window).resize(function() {
                     // fixedTocContentIcon();
                     setHeightTocFixed();
                  });

                  $('.tocFixedIcon, .tocContent.tocFixed .tocContent_close').click(function(){
                     let elementMenu = $('.tocContent.tocFixed');
                     let displayMenu = elementMenu.css('display');
                     if(displayMenu=='none'){
                           elementMenu.css('display', 'block');
                     }else {
                           elementMenu.css('display', 'none');
                     }
                  });

                  $('.tocContent_title, .tocContent_close').click(function(){
                     let elemtMenu   = $('.tocContent .tocContent_list');
                     let displayMenu = elemtMenu.css('display');
                     if(displayMenu=='none'){
                           elemtMenu.css('display', 'block');
                           $('.tocContent_close').removeClass('hidden');
                     }else {
                           elemtMenu.css('display', 'none');
                           $('.tocContent_close').addClass('hidden');
                     }
                  });

                  function fixedTocContentIcon(){
                     let widthS      = $(window).width();
                     let widthC      = $('.'+elemtSearch).outerWidth();
                     let widthE      = $('.tocFixedIcon').outerWidth();
                     let leftE       = parseInt((widthS - widthC - widthE - 20) / 2);
                     if($(window).width() < 1200){
                           leftE       = parseInt((widthS - widthC - widthE + 30) / 2);
                     }
                     
                     $('.tocFixedIcon').css('left', leftE);
                  }

                  function setHeightTocFixed(){
                     let heightToc   = parseInt($(window).height() - 210);
                     $('.tocContent.tocFixed .tocContent_list').css('height', heightToc+'px');
                  }

                  let element     = $('.tocContent');
                  let positionE   = element.offset().top;
                  let heightE     = element.outerHeight();
                  let boxContent  = $('.'+elemtSearch);
                  let positionB   = boxContent.offset().top;
                  let heightB     = boxContent.outerHeight();
                  $(document).scroll(function(){
                     let scrollNow   = $(document).scrollTop();
                     let minScroll   = parseInt(heightE + positionE);
                     let maxScroll   = parseInt(heightB + positionB);
                     if(scrollNow > minScroll && scrollNow < maxScroll){ 
                           $('.tocFixedIcon').css('display', 'block');
                     }else {
                           $('.tocFixedIcon').css('display', 'none');
                     }
                  });
               }
         });
      }   

   </script>
   <!-- Facebook Script -->
   <script src="https://connect.facebook.net/vi_VN/sdk.js?hash=1589878c8f70a5f02472da6fb4fe2085" async="" crossorigin="anonymous"></script><script async="" defer="" crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&amp;version=v14.0&amp;appId=412989459053103&amp;autoLogAppEvents=1" nonce="X8ejeuha"></script>
@endpush