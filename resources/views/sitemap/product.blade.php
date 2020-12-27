<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($products as $product)
        <url>
            <loc>{{url("/")}}{{ product_link((int)$product->id)  }}</loc>
            <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1.0</priority>
        </url>
    @endforeach
</urlset>
