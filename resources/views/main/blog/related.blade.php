@if($related->isNotEmpty()||$special->isNotEmpty())
    <div class="relatedBox">
        <div class="relatedBox_title">
        Bài viết liên quan
        </div>
        <div class="relatedBox_box">
            @if($special->isNotEmpty())
                @foreach($special as $item)
                    <div class="relatedBox_box_item background">
                        <div class="relatedBox_box_item_image">
                            <a href="{{ !empty($item->seo_alias_full) ? url($item->seo_alias_full) : null }}">
                                <img src="/images/image-default-750x460.png" data-src="{{ $item->image_small ?? $item->image }}" alt="{{ $item->title }}" title="{{ $item->title }}">
                            </a>
                        </div>
                        <div class="relatedBox_box_item_content">
                            <a href="{{ !empty($item->seo_alias_full) ? url($item->seo_alias_full) : null }}" class="relatedBox_box_item_content_title">
                                <h3 class="maxLine_2">
                                    {{ $item->title ?? null }}
                                </h3>
                            </a>
                            <div class="relatedBox_box_item_content_des maxLine_3">
                                {{ $item->description ?? null }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if($related->isNotEmpty())
                @foreach($related as $item)
                    <div class="relatedBox_box_item background">
                        <div class="relatedBox_box_item_image">
                            <a href="{{ !empty($item->pages->seo_alias_full) ? url($item->pages->seo_alias_full) : url($item->seo_alias_full) }}">
                                <img src="/images/image-default-750x460.png" data-src="{{ $item->pages->image_small ?? $item->pages->image }}" alt="{{ $item->name }}" title="{{ $item->name }}">
                            </a>
                        </div>
                        <div class="relatedBox_box_item_content">
                            <a href="{{ !empty($item->pages->seo_alias_full) ? url($item->pages->seo_alias_full) : url($item->seo_alias_full) }}" class="relatedBox_box_item_content_title">
                                <h3 class="maxLine_2">
                                    {{ $item->pages->title ?? $item->name ?? null }}
                                </h3>
                            </a>
                            <div class="relatedBox_box_item_content_des maxLine_3">
                                {{ $item->pages->description ?? $item->description ?? null }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @push('scripts-custom')
        {{-- @if($related->count()>=3) --}}
            <script type="text/javascript">
                $(document).ready(function(){
                    
                    $('.relatedBox_box').slick({
                        infinite: false,
                        slidesToShow: 2.7,
                        slidesToScroll: 3,
                        arrows: true,
                        responsive: [
                            {
                                breakpoint: 767,
                                settings: {
                                    infinite: false,
                                    slidesToShow: 2.4,
                                    slidesToScroll: 1,
                                    arrows: false,
                                }
                            },
                            {
                                breakpoint: 568,
                                settings: {
                                    infinite: false,
                                    slidesToShow: 1.4,
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
                            $('.relatedBox_box .slick-prev').html('<i class="fas fa-chevron-left"></i>');
                            $('.relatedBox_box .slick-next').html('<i class="fas fa-chevron-right"></i>');
                        }, 0);
                    }

                });

            </script>
        {{-- @endif --}}
    @endpush
@endif