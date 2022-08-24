@php
    $dataSlider     = [
        'desktop'   => [
            '/images/sources/banner-chuyen-tau-van-hoc-2.jpg',
            '/images/sources/banner-chuyen-tau-van-hoc-3.jpg',
            '/images/sources/banner-chuyen-tau-van-hoc-4.jpg'
        ],
        'mobile'   => [
            '/images/sources/slider-1-mobile.jpg',
            '/images/sources/slider-2-mobile.jpg',
            '/images/sources/slider-3-mobile.jpg'
        ]
    ];
@endphp

<div class="hide-767">
    <div class="sliderBoxHome">
        @foreach($dataSlider['desktop'] as $item)
            <div class="sliderBoxHome_item">
                <img src="{{ $item }}" alt="banner Chuyến tàu Văn học" title="banner Chuyến tàu Văn học" />
            </div>
        @endforeach
    </div>
</div>

<div class="show-767">
    <div class="sliderBoxHome">
        @foreach($dataSlider['mobile'] as $item)
            <div class="sliderBoxHome_item">
                <img src="{{ $item }}" alt="banner Chuyến tàu Văn học" title="banner Chuyến tàu Văn học" />
            </div>

        @endforeach
    </div>
</div>

@push('scripts-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            setupSlick();
            $(window).resize(function(){
                setupSlick();
            })

            $('.sliderBoxHome').slick({
                dots: true,
                arrows: true,
                autoplay: true,
                infinite: true,
                autoplaySpeed: 5000,
                lazyLoad: 'ondemand',
                responsive: [
                    {
                        breakpoint: 567,
                        settings: {
                            arrows: false,
                        }
                    }
                ]
            });
            
            function setupSlick(){
                setTimeout(function(){
                    $('.sliderBoxHome .slick-prev').html('<i class="fa-solid fa-arrow-left-long"></i>');
                    $('.sliderBoxHome .slick-next').html('<i class="fa-solid fa-arrow-right-long"></i>');
                    $('.sliderBoxHome .slick-dots button').html('');
                }, 0);
            }
        });

    </script>
@endpush