<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('sitemap/product') }}</loc>
        <lastmod>{{ $products->updated_at->toAtomString() }}</lastmod>
    </sitemap>

    <sitemap>
        <loc>{{ url('sitemap/category') }}</loc>
        <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
    </sitemap>



</sitemapindex>
