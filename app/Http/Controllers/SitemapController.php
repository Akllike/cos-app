<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $urls = [
            ['loc' => url('/'), 'lastmod' => now()->toAtomString()],
            ['loc' => url('/catalog/hairs'), 'lastmod' => now()->toAtomString()],
            ['loc' => url('/catalog/faces'), 'lastmod' => now()->toAtomString()],
            ['loc' => url('/catalog/bodies'), 'lastmod' => now()->toAtomString()],
            ['loc' => url('/about'), 'lastmod' => now()->toAtomString()],
            ['loc' => url('/delivery'), 'lastmod' => now()->toAtomString()],
        ];

        $sitemapXml = view('sitemap', compact('urls'));

        return response($sitemapXml)->header('Content-Type', 'application/xml');
    }
}
