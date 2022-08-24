<!-- ===== ===== -->
@if(!$outstanding->isEmpty())
    <div class="sideBox background">
        <div class="sideBox_title">
            Bài viết nổi bật
        </div>
        <div class="sideBox_content">
            <div class="blogBoxSidebar">
                @foreach($outstanding as $item)
                    <div class="blogBoxSidebar_item">
                        <div class="blogBoxSidebar_item_image">
                            <a href="{{ url($item->pages->seo_alias) }}">
                                <img src="/images/image-default-750x460.png" data-src="{{ $item->pages->image_small }}" alt="{{ $item->pages->title }}" title="{{ $item->pages->title }}" />
                            </a>
                        </div>
                        <div class="blogBoxSidebar_item_content">
                            <a href="{{ url($item->pages->seo_alias) }}" class="blogBoxSidebar_item_content__title">
                                <h3 class="maxLine_2">
                                    {{ $item->pages->title }}
                                </h3>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

 <!-- ===== ===== -->
 {{-- <div class="sideBox">
    <div class="sideBox_content">
        <a href="#" style="display:flex;">
            <img src="/images/sources/banner-course.jpg" alt="Khóa học của Chuyến tàu Văn Học"  title="Khóa học của Chuyến tàu Văn Học">
        </a>
    </div>
 </div> --}}
 <!-- ===== ===== -->

@if(!empty($category))
    <div class="sideBox background">
        <div class="sideBox_title" style="margin-bottom: 0;">
            Chuyên mục chính
        </div>
        <div class="sideBox_content">
            <div class="categoryBoxSidebar">
                @foreach($category as $item)
                    @if($item->title!='Tìm kiếm'&&$item->title!='Đề thi')
                        <div class="categoryBoxSidebar_item">
                            <a href="{{ url($item->seo_alias_full) }}">{{ $item->title }}</a>
                            @if(!empty($item->child))
                                <ul>
                                    @foreach($item->child as $child1)
                                        <li style="position:relative;">
                                            <a href="{{ url($child1->seo_alias_full) }}">{{ $child1->title }}</a>
                                            @if(!empty($child1->child))
                                                <div class="iconHasChild nowOff" onClick="showHideChild(this);"></div>
                                                <ul style="display:none;">
                                                    @foreach($child1->child as $child2)
                                                        <li><a href="{{ url($child2->seo_alias_full) }}">{{ $child2->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                    <!-- Riêng cho Đề thi -->
                    @if($item->title=='Đề thi')
                        <div class="categoryBoxSidebar_item" style="position:relative;">
                            <a href="{{ url($item->seo_alias_full) }}">{{ $item->title }}</a>
                            @if(!empty($item->child))
                                <div class="iconHasChild nowOff" onClick="showHideChild(this);"></div>
                                <ul style="display:none;">
                                    @foreach($item->child as $child1)
                                        <li style="position:relative;">
                                            <a href="{{ url($child1->seo_alias_full) }}">{{ $child1->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif

<!-- ===== ===== -->
{{-- <div class="sideBox">
    <div class="sideBox_content">
        <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/Chuy%E1%BA%BFn-t%C3%A0u-V%C4%83n-H%E1%BB%8Dc-102735669150242" data-tabs="timeline, events, messages" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=412989459053103&amp;container_width=320&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FChuy%25E1%25BA%25BFn-t%25C3%25A0u-V%25C4%2583n-H%25E1%25BB%258Dc-102735669150242&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline%2C%20events%2C%20messages&amp;width=">
            <span style="vertical-align: bottom; width: 320px; height: 500px;">
                <iframe name="f3a5c93a40e4c44" width="1000px" height="1000px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v14.0/plugins/page.php?adapt_container_width=true&amp;app_id=412989459053103&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df49474c5676e8c%26domain%3Dvanhoc.com%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fvanhoc.com%252Ff2ccfd56e475c14%26relation%3Dparent.parent&amp;container_width=320&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FChuy%25E1%25BA%25BFn-t%25C3%25A0u-V%25C4%2583n-H%25E1%25BB%258Dc-102735669150242&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline%2C%20events%2C%20messages&amp;width=" style="border: none; visibility: visible; width: 320px; height: 500px;" class=""></iframe>
            </span>
        </div>
    </div>
</div> --}}