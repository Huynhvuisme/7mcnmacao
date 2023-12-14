<script type="application/ld+json"> {
        "@context": "https://schema.org/",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ getUrlPost($oneItem, 0) }}"
        },
        "headline": "{{ strip_quotes($oneItem->meta_title) }}",
        "image": "{{ url($oneItem->thumbnail) }}",
        "datePublished": "{{ date('c', strtotime($oneItem->displayed_time)) }}",
        "dateModified": "{{ date('c', strtotime($oneItem->updated_time)) }}",
        "author": {
            "@type": "Person",
            "name": "Trịnh Tuấn"
        },
        "publisher": {
            "@type": "Organization",
            "name": "7mcn88.com",
            "logo": {
              "@type": "ImageObject",
              "url": "https://7mcn88.com/web/images/logo.svg?3"
            }
        },
        "description": "{{ $seo_data['meta_description'] ?? '' }}"
    }
</script>
