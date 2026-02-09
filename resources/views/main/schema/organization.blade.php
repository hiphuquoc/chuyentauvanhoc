<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "{{ env('APP_NAME', config('app.name')) }}",
    "url": "{{ config('app.url') }}",
    "logo": {
        "@@type": "ImageObject",
        "url": "{{ env('APP_LOGO', config('app.url')) }}",
        "width": "500",
        "height": "500"
    }
}
</script>
