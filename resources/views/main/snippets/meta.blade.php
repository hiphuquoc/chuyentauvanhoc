@if(!empty($info))
    <title>{{ $info->title  }}</title>
    <meta name="description" content="{{ $info->seo_description ?? $info->description }}" />
    <link rel="canonical" href="{{ !empty($info->seo_alias_full) ? url($info->seo_alias_full) : url($info->seo_alias) }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $info->seo_title ?? $info->title }}" />
    <meta property="og:description" content="{{ $info->seo_description ?? $info->description }}" />
    <meta property="og:url" content="{{ !empty($info->seo_alias_full) ? url($info->seo_alias_full) : url($info->seo_alias) }}" />
    <meta property="og:site_name" content="Chuyến tàu văn học" />
    <meta property="article:modified_time" content="{{ date('c', strtotime($info->updated_at)) }}" />
    <meta property="og:image" content="{{ url('public'.$info->image) }}" />
    <meta property="og:image:width" content="750" />
    <meta property="og:image:height" content="460" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ $info->seo_title ?? $info->title }}" />
    <meta name="twitter:domain" content="Chuyến tàu văn học" />
    <meta name="twitter:image:src" content="{{ url('public'.$info->image) }}" />
@endif