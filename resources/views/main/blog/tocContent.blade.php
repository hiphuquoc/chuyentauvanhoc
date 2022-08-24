<!-- ====================== View -->
<?php
    $listMenu           = null;
    if(!empty($data)){
        foreach($data as $item){
            $marginLeft = ((int)substr($item['type'], -1)-2)*2.5;
            $listMenu   .= '<a href="#'.$item['id'].'" class="tocContent_list__item" style="margin-left:'.$marginLeft.'rem;">
                                '.$item['content'].'
                            </a>';
        }
    }
?>

<!-- TOC CONTENT -->
<div class="tocContent">
    <div class="tocContent_title">
    <span class="tocContent_title_icon"></span>
    <span class="tocContent_title_text">Mục lục</span>
    </div>
    <div class="tocContent_list">
    {!! $listMenu !!}
    </div>
    <div class="tocContent_close"></div>
</div>
<!-- TOC CONTENT FIXED ICON -->
<div class="tocFixedIcon">
    <div></div>
</div>
<!-- TOC CONTENT FIXED -->
<div class="tocContent tocFixed">
    <div class="tocContent_title">
    <span class="tocContent_title_icon"></span>
    <span class="tocContent_title_text">Mục lục</span>
    </div>
    <div class="tocContent_list customScrollBar-y">
    {!! $listMenu !!}
    </div>
    <div class="tocContent_close"></div>
</div>