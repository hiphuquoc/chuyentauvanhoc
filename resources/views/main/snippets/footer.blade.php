<!-- === START:: Footer === -->
@php
    $params     = [
        'paginate' => 5
    ];
    $blogNLXH   = \App\Models\Blog::getListBySeoAliasCategory('nghi-luan-xa-hoi', $params);
@endphp
<footer>
    <div class="container">
       <div class="footerBox">
            <div class="footerBox_item">
                <div class="footerBox_item_title">
                    Nghị luận văn học
                </div>
                <div class="footerBox_item_main">
                    <div class="footerColumn">
                        <div class="footerColumn_item">
                            <div class="footerColumn_item_title">
                                Văn THCS
                            </div>
                            <ul>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-6">Lớp 6</a></li>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-7">Lớp 7</a></li>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-8">Lớp 8</a></li>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-co-so/lop-9">Lớp 9</a></li>
                            </ul>
                        </div>
                        <div class="footerColumn_item">
                            <div class="footerColumn_item_title">
                                Văn THPT
                            </div>
                            <ul>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-10">Lớp 10</a></li>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-11">Lớp 11</a></li>
                                <li><a href="/nghi-luan-van-hoc/van-trung-hoc-pho-thong/lop-12">Lớp 12</a></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="footerBox_item_title">Kết nối với chúng tôi</div>
                        <div class="socialShareBox">
                            <a class="socialShareBox_item facebook" target="_blank" rel="nofollow" href="https://facebook.com/chuyentauvanhoc"></a>
                            <a class="socialShareBox_item instagram" target="_blank" rel="nofollow" href="https://instagram.com/chuyentauvanhoc"></a>
                            {{-- <a class="socialShareBox_item youtube" target="_blank" href="#"></a>
                            <a class="socialShareBox_item tiktok" target="_blank" href="#"></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerBox_item">
                <div class="footerBox_item_title">
                   Nghị luận xã hội
                </div>
                <div class="footerBox_item_main">
                   <div class="blogBoxFooter">
                        @if(!empty($blogNLXH))
                            @foreach($blogNLXH as $item)
                                <div class="blogBoxFooter_item">
                                    <div class="blogBoxFooter_item_image">
                                        <a href="/{{ $item->pages->seo_alias_full }}">
                                            <img src="/images/image-default-750x460.png" data-src="{{ $item->pages->image_small }}" alt="{{ $item->name }}" title="{{ $item->name }}">
                                        </a>
                                    </div>
                                    <div class="blogBoxFooter_item_content maxLine_2">
                                        <a href="/{{ $item->pages->seo_alias_full }}">
                                            {{ $item->name }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                   </div>
                </div>
            </div>
            <div class="footerBox_item">
                <div class="footerBox_item_title">
                    Thông tin trang
                </div>
                <div class="footerBox_item_main">
                    <div class="footerBox_item_main_about">
                        Đây không chỉ là một trang web mà còn là trang đời, trang văn, trang thơ, trang ký sự, trang cảm xúc... rất nhỏ, rất riêng!
                    </div>
                    <ul>
                        <li>
                            Founder: <a href="https://www.facebook.com/ngocanhphamm.236" class="link" rel="nofollow noopener noreferrer">Phạm Thị Ngọc Anh</a>
                        </li>
                        <li>
                            Email: <a href="mailto:chuyentauvanhoc@gmail.com" class="link">chuyentauvanhoc@gmail.com</a>
                        </li>
                        <li>
                            Fanpage: <a href="https://www.facebook.com/chuyentauvanhoc" class="link" rel="nofollow noopener noreferrer">Chuyến tàu Văn học</a>
                        </li>
                    </ul>
                    <div class="footerBox_item_main_phone">
                        <div class="footerBox_item_main_callPhone__title">Gọi Cô Ngọc Anh ngay!</div>
                        <a href="tel:0828580381" class="footerBox_item_main_callPhone__phone">0828.580.381</a>
                    </div>
                    <div class="footerBox_item_main">
                        <a href="//www.dmca.com/Protection/Status.aspx?ID=93d7b793-f100-45c2-a797-4e62873680db" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca-badge-w200-5x1-07.png?ID=93d7b793-f100-45c2-a797-4e62873680db"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyRight">
    <div class="container">
        © 2022 - Bản quyền thuộc <a href="https://chuyentauvanhoc.edu.vn">Chuyến tàu Văn học</a> - Thiết kế bởi Phạm Văn Phú
    </div>
</div>
<!-- === END:: Footer === -->