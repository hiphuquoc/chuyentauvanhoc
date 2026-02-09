@php
    $listData = $data ?? $list ?? [];
    $items = [];
    if (!empty($listData) && (is_array($listData) || is_object($listData))) {
        $pos = 1;
        foreach ($listData as $item) {
            $url = $item->pages->seo_alias_full ?? $item->seo_alias_full ?? null;
            if ($url) {
                $items[] = [
                    '@type' => 'ListItem',
                    'position' => $pos,
                    'url' => config('app.url') . '/' . $url
                ];
                ++$pos;
            }
        }
    }
@endphp
@if(!empty($items))
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "ItemList",
    "itemListElement": @json($items)
}
</script>
@endif
