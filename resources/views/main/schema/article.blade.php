@if(!empty($info))
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "@@id": "{{ url()->current() }}#website",
    "inLanguage": "vi",
    "headline": "{{ $info->pages->seo_title ?? $info->seo_title ?? '' }} Article",
    "datePublished": "{{ !empty($info->pages->created_at) ? date('c', strtotime($info->pages->created_at)) : (!empty($info->created_at) ? date('c', strtotime($info->created_at)) : '') }}",
    "dateModified": "{{ !empty($info->pages->updated_at) ? date('c', strtotime($info->pages->updated_at)) : (!empty($info->updated_at) ? date('c', strtotime($info->updated_at)) : '') }}",
    "name": "{{ $info->pages->seo_title ?? $info->seo_title }}",
    "description": "{{ $info->pages->seo_description ?? $info->seo_description }}",
    "url": "{{ url()->current() }}",
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": "{{ url()->current() }}"
    },
    "author": {
        "@@type": "Organization",
        "name": "{{ config('app.name') }}",
        "url": "{{ config('app.url') }}"
    },
    "image": {
        "@@type": "ImageObject",
        "url": "{{ !empty($info->pages->image) ? asset($info->pages->image) : (!empty($info->image) ? asset($info->image) : config('app.url')) }}",
        "width": "750",
        "height": "460"
    },
    "publisher": {
        "@@type": "Organization",
        "name": "{{ config('app.name') }}",
        "logo": {
            "@@type": "ImageObject",
            "url": "{{ env('APP_LOGO', config('app.url')) }}",
            "width": "500",
            "height": "500"
        }
    },
    "potentialAction": {
        "@@type": "ReadAction",
        "target": [
            {
                "@@type": "EntryPoint",
                "urlTemplate": "{{ config('app.url') }}"
            }
        ]
    }
}
</script>
@endif
