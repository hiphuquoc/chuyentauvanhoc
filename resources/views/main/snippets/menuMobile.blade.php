<div class="show-767">
    <div class="header_menuMobile">
        <div class="header_menuMobile_item">
            <form id="formSearchMobile" method="get" action="/tim-kiem">
                <div class="searchHeaderMobile">
                    <input type="text" name="search_name" placeholder="Tìm kiếm..." />
                    <i class="fa-solid fa-magnifying-glass noBackground" onClick="submitForm('formSearchMobile');"></i>
                </div>
            </form>
        </div>
        <div class="header_menuMobile_item" onclick="javascript:openCloseElemt('nav-mobile');">
            <img src="/images/svg/icon-menu-mobile.svg" alt="Menu Chuyến tàu văn học" title="Menu Chuyến tàu văn học" />
        </div>
    </div>
</div>

@php
    $dataMenu                   = config('menu.header-main-menu');
    $xhtmlMenu                  = null;
    if(!empty($dataMenu)){
        foreach($dataMenu as $item){
            $iconMore           = null;
            $menuChild          = null;
            if(!empty($item['child'])) {
                // $iconMore       = '<span class="right-icon" onclick="javascript:showHideListMenuMobile(this);"><i class="fas fa-chevron-right"></i></span>';
                // menu child
                $menuChild      .= '<ul>';
                foreach($item['child'] as $child){
                    $iconMore2  = null;
                    $menuChild2 = null;
                    if(!empty($child['child'])){
                        $menuChild2 = '<ul>';
                        foreach($child['child'] as $child2) {
                            $iconMore2  = '<span class="right-icon" onclick="javascript:showHideListMenuMobile(this);"><i class="fas fa-chevron-right"></i></span>';
                            $menuChild2 .= '<li>
                                                <a href="/'.$child2['url'].'">'.$child2['name'].'</a>
                                            </li>';
                        }
                        $menuChild2 .= '</ul>';
                    }
                    $menuChild  .= '<li>
                                    <a href="/'.$child['url'].'">
                                        <div>'.$child['name'].'</div>
                                    </a>
                                    '.$iconMore2.'
                                    '.$menuChild2.'
                                </li>';
                }
                $menuChild      .= '</ul>';
            }   
            $xhtmlMenu          .= '<li>
                                        <a href="/'.$item['url'].'">
                                            '.$item['icon'].'
                                            '.$item['name'].'
                                        </a>
                                        '.$iconMore.'
                                        '.$menuChild.'
                                    </li>';
        }
    }
@endphp

<div id="nav-mobile" style="display:none;">
    <div class="nav-mobile">
        <div class="nav-mobile_bg" onclick="javascript:openCloseElemt('nav-mobile');"></div>
        <div class="nav-mobile_main customScrollBar-y">
            <div class="nav-mobile_main__exit" onclick="javascript:openCloseElemt('nav-mobile');">
                <i class="fas fa-times"></i>
            </div>
            <a href="/">
                <img src="/images/logo-chuyentauvanhoc.png" alt="Logo chuyến tàu văn học" title="Logo chuyến tàu văn học" style="width:70px;margin:0.25rem auto 0 auto;display:flex;"/>
            </a>
            <ul>
                <li>
                    <a href="/">
                        <div><i class="fas fa-home"></i>Trang chủ</div>
                        <div class="right-icon"></div>
                    </a>
                </li>
                {!! $xhtmlMenu !!}
            </ul>
        </div>
    </div>
</div>

@push('scripts-custom')
    <script type="text/javascript">
        function showHideListMenuMobile(thisD){
            let elemtC      = $(thisD).parent().find('ul');
            let displayC    = elemtC.css('display');
            if(displayC=='none'){
                elemtC.css('display', 'block');
                $(thisD).html('<i class="fas fa-chevron-down"></i>');
            }else {
                elemtC.css('display', 'none');
                $(thisD).html('<i class="fas fa-chevron-right"></i>');
            }
        }
        function openCloseElemt(idElemt){
            let displayE    = $('#' + idElemt).css('display');
            if(displayE=='none'){
                $('#' + idElemt).css('display', 'block');
                $('body').css('overflow', 'hidden');
            }else {
                $('#' + idElemt).css('display', 'none');
                $('body').css('overflow', 'unset');
            }
        }
    </script>
@endpush