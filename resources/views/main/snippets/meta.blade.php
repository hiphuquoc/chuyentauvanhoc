@if(!empty($info))
    <title>{{ $info->pages->title ?? $info->title  }}</title>
    <meta name="description" content="{{ $info->pages->seo_description ?? $info->description }}" />
    <link rel="canonical" href="{{ !empty($info->pages->seo_alias_full) ? url($info->pages->seo_alias_full) : url($info->seo_alias_full) }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $info->pages->seo_title ?? $info->seo_title }}" />
    <meta property="og:description" content="{{ $info->pages->seo_description ?? $info->description }}" />
    <meta property="og:url" content="{{ !empty($info->pages->seo_alias_full) ? url($info->pages->seo_alias_full) : url($info->seo_alias_full) }}" />
    <meta property="og:site_name" content="Chuyến tàu văn học" />
    <meta property="article:modified_time" content="{{ !empty($info->pages->updated_at) ? date('c', strtotime($info->pages->updated_at)) : date('c', strtotime($info->updated_at)) }}" />
    <meta property="og:image" content="{{ !empty($info->pages->image) ? url('public'.$info->pages->image) : url('public'.$info->image) }}" />
    <meta property="og:image:width" content="750" />
    <meta property="og:image:height" content="460" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $info->pages->seo_title ?? $info->seo_title }}" />
    <meta name="twitter:domain" content="Chuyến tàu văn học" />
    <meta name="twitter:image:src" content="{{ !empty($info->pages->image) ? url('public'.$info->pages->image) : url('public'.$info->image) }}" />
@endif

