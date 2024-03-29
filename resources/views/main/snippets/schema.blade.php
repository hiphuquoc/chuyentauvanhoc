<!-- Shema Webpage -->
@if(!empty($info)&&in_array('article', $listType))
    <script type="application/ld+json">{
        "@context": "https://schema.org",
        "@type":"Article",
        "@id":"{{ env('APP_URL') }}",
        "inLanguage":"vi",
        "headline":"{{ env('APP_URL') }} Article",
        "datePublished":"{{ !empty($info->pages->created_at) ? date('c', strtotime($info->pages->created_at)) : date('c', strtotime($info->created_at)) }}",
        "dateModified":"{{ !empty($info->pages->updated_at) ? date('c', strtotime($info->pages->updated_at)) : date('c', strtotime($info->updated_at)) }}",
        "name":"{{ $info->pages->seo_title ?? $info->seo_title }}",
        "description":"{{ $info->pages->seo_description ?? $info->seo_description }}",
        "url": "{{ url()->current() }}",
        "mainEntityOfPage":{
            "@type":"WebPage",
            "@id":"{{ url()->current() }}"
        },
        "author":{
            "@type":"Person",
            "name":"{{ env('APP_URL') }}"
        },
        "image":{
            "@type": "ImageObject",
            "url":"{{ !empty($info->pages->image) ? public_path($info->pages->image) : public_path($info->image) }}",
            "width":"750",
            "height":"460"
        },
        "publisher":{
            "@type":"Organization",
            "name":"{{ env('APP_URL') }}",
            "logo":{
                "@type": "ImageObject",
                "url":"{{ env('APP_LOGO') }}",
                "width":"500",
                "height":"500"
            }
        },
        "potentialAction":{
            "@type":"ReadAction",
            "target":[
                {"@type":"EntryPoint",
                "urlTemplate":"{{ env('APP_URL') }}"
                
            }]
        }
    }</script>
@endif
<!-- Shema Creativeworkseries -->
@if(!empty($info)&&in_array('creativeworkseries', $listType))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "CreativeWorkSeries",
            "name": "{{ $info->pages->seo_title ?? $info->seo_title }}",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{{ $info->pages->rating_aggregate_star ?? $info->rating_aggregate_star }}",
                "bestRating": "5",
                "ratingCount": "{{ $info->pages->rating_aggregate_count ?? $info->rating_aggregate_count }}"
            }
        }
    </script>
@endif
<!-- Shema Breadcrumb -->
@if(!empty($breadcrumb)&&in_array('breadcrumb', $listType))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Trang chủ",
                    "item": "{{ env('APP_URL') }}"
                },
                @foreach($breadcrumb as $item)
                    @if($loop->index != 0)
                        ,
                    @endif
                    {
                        "@type": "ListItem",
                        "position": {{ $loop->index + 1 }},
                        "name": "{{ $item->seo_title }}",
                        "item": "{{ env('APP_URL') }}/{{ $item->seo_alias }}"
                    }
                @endforeach
            ]
        }
    </script>
@endif
<!-- Schema Listitem -->
@if(!empty($list)&&in_array('listitem', $listType))
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ItemList",
            "itemListElement": [
                @foreach($list as $item)
                    @if($loop->index != 0)
                        ,
                    @endif
                    {
                        "@type": "ListItem",
                        "position": {{ $loop->index }},
                        "url": "{{ env('APP_URL') }}/{{ $item->pages->seo_alias_full ?? $item->seo_alias_full }}"
                    }
                @endforeach
            ]
        }
    </script>
@endif