@if(!empty($info))
<script type="application/ld+json">
{
    "@@context": "https://schema.org/",
    "@@type": "CreativeWorkSeries",
    "name": "{{ $info->pages->seo_title ?? $info->seo_title }}",
    "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ $info->pages->rating_aggregate_star ?? $info->rating_aggregate_star ?? '5' }}",
        "bestRating": "5",
        "ratingCount": "{{ $info->pages->rating_aggregate_count ?? $info->rating_aggregate_count ?? '0' }}"
    }
}
</script>
@endif
