@php
    $params     = [
        'outstanding'   => 1,
        'limit'         => 10
    ];
    $dataBlog   = \App\Models\Blog::getList($params);
@endphp


@if(!empty($dataBlog))
    <div class="container">
        <div class="blogBox">
            <h2 class="blogBox_title">
                Bài viết nổi bật
            </h2>
            <div class="blogBox_des">
                Bài viết nổi bật của Chuyến tàu Văn học
            </div>
            <div class="blogBox_main">
                @foreach($dataBlog->sortBy('pages.ordering')->sortByDesc('pages.created_at') as $blog)
                    <div class="blogBox_main_item">
                        <div class="blogBox_main_item_image">
                            <a href="/{{ $blog->pages->seo_alias }}">
                                <img src="/images/image-default-750x460.png" data-src="{{ $blog->pages->image_small }}" alt="{{ $blog->name }}" title="{{ $blog->name }}" />
                            </a>
                        </div>
                        <div class="blogBox_main_item_content">
                            <div class="blogBox_main_item_content_title">
                                <a href="/{{ $blog->pages->seo_alias }}">
                                    <h3 class="maxLine_2">{{ $blog->pages->title }}</h3>
                                </a>
                            </div>
                            <div class="blogBox_main_item_content_subTitle maxLine_1">
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    {{ date('d/m/Y', strtotime($blog->pages->updated_at)) }}
                                </span>
                                <span>
                                    <i class="fa-solid fa-user-pen"></i>
                                    Cô Ngọc Anh
                                </span>
                            </div>
                            <div class="blogBox_main_item_content_des maxLine_3">
                                {{ $blog->pages->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
        
            </div>
        
        </div>

    </div>
@endif

@push('scripts-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.blogBox_main').slick({
                infinite: false,
                slidesToShow: 3.6,
                slidesToScroll: 3,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            infinite: false,
                            slidesToShow: 3.2,
                            slidesToScroll: 3,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            infinite: false,
                            slidesToShow: 2.4,
                            slidesToScroll: 2,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 567,
                        settings: {
                            infinite: false,
                            slidesToShow: 1.3,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    }
                ]
            });
            setupSlick();
            $(window).resize(function(){
                setupSlick();
            })

            function setupSlick(){
                setTimeout(function(){
                    $('.blogBox .slick-prev').html('<i class="fas fa-chevron-left"></i>');
                    $('.blogBox .slick-next').html('<i class="fas fa-chevron-right"></i>');
                }, 0);
            }
        });

    </script>
@endpush