@php
    $breadcrumb = $breadcrumb ?? [];
    $baseUrl = config('app.url');
    $xhtml = '{
        "@type": "ListItem",
        "position": 1,
        "name": "Trang chủ",
        "item": "' . $baseUrl . '"
    }';
    $i = 2;
    if (!empty($breadcrumb) && (is_array($breadcrumb) || is_object($breadcrumb))) {
        foreach ($breadcrumb as $item) {
            $title = $item->seo_title ?? '';
            $slug = $item->seo_alias ?? '';
            $xhtml .= ', {
                "@type": "ListItem",
                "position": ' . $i . ',
                "name": "' . addslashes($title) . '",
                "item": "' . $baseUrl . '/' . $slug . '"
            }';
            ++$i;
        }
    }
@endphp
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {!! $xhtml !!}
    ]
}
</script>
