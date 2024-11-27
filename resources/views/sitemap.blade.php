<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap-image/1.1"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.w3.org/2001/XMLSchema-instance http://www.sitemaps.org/schemas/sitemap-image/1.1/sitemap-image.xsd">

    @foreach ($urls as $url)
        <url>
            <loc>{{ $url['loc'] }}</loc>
            <lastmod>{{ $url['lastmod'] }}</lastmod>
        </url>
    @endforeach
</urlset>
