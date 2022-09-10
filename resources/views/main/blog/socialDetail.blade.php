@if(!empty($info))
    <div class="socialBoxBlog">
        <div class="socialBoxBlog_item">
            <div class="desDetailBlog maxLine_1">
                <span class="desDetailBlog_item">
                    <i class="fa-regular fa-clock"></i>
                    Cập nhật {{ date('H:i\, d/m/Y', strtotime($info->pages->updated_at)) }}
                </span>
                <span class="desDetailBlog_item">
                    <i class="fa-solid fa-user-pen"></i>
                    Cô Ngọc Anh
                </span>
            </div>
        </div>
        <div class="socialBoxBlog_item">
            <div class="socialShareBox">
                <a class="socialShareBox_item facebook" target="_blank" href="http://www.facebook.com/sharer.php?u={{ url($info->pages->seo_alias) }}"></a>
                <a class="socialShareBox_item twitter" target="_blank" href="https://twitter.com/share?url={{ url($info->pages->seo_alias) }}"></a>
                <a class="socialShareBox_item linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url={{ url($info->pages->seo_alias) }}"></a>
                <a class="socialShareBox_item instagram" target="_blank" href="https://www.instagram.com/?url={{ url($info->pages->seo_alias) }}"></a>
            </div>
        </div>
    </div>
@endif