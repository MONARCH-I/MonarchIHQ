<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engines.
     */
    public function index(): Response
    {
        $baseUrl = config('app.url', url('/'));

        $staticPages = [
            [
                'url' => $baseUrl,
                'lastmod' => now()->startOfDay()->toIso8601String(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'url' => $baseUrl.'/services',
                'lastmod' => now()->startOfWeek()->toIso8601String(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
            [
                'url' => $baseUrl.'/about',
                'lastmod' => now()->startOfMonth()->toIso8601String(),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'url' => $baseUrl.'/store',
                'lastmod' => now()->startOfDay()->toIso8601String(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'url' => $baseUrl.'/projects',
                'lastmod' => now()->startOfWeek()->toIso8601String(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'url' => $baseUrl.'/blog',
                'lastmod' => now()->startOfDay()->toIso8601String(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ],
            [
                'url' => $baseUrl.'/careers',
                'lastmod' => now()->startOfWeek()->toIso8601String(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ],
            [
                'url' => $baseUrl.'/contact',
                'lastmod' => now()->startOfMonth()->toIso8601String(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
        ];

        // Fetch active products for individual product indexing
        $products = [];
        try {
            $products = Product::where('is_active', true)
                ->select(['id', 'name', 'slug', 'image_path', 'updated_at'])
                ->get()
                ->map(function ($product) use ($baseUrl) {
                    return [
                        'url' => $baseUrl.'/store/'.$product->slug,
                        'lastmod' => $product->updated_at ? $product->updated_at->toIso8601String() : now()->toIso8601String(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                        'image' => $product->image_path ? asset('storage/'.$product->image_path) : null,
                        'title' => $product->name,
                    ];
                })
                ->toArray();
        } catch (\Throwable $e) {
            // Graceful fallback if database connection is cold
            $products = [];
        }

        $allUrls = array_merge($staticPages, $products);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ';
        $xml .= 'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

        foreach ($allUrls as $item) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.htmlspecialchars($item['url'], ENT_XML1, 'UTF-8')."</loc>\n";
            $xml .= '    <lastmod>'.$item['lastmod']."</lastmod>\n";
            $xml .= '    <changefreq>'.$item['changefreq']."</changefreq>\n";
            $xml .= '    <priority>'.$item['priority']."</priority>\n";

            if (! empty($item['image'])) {
                $xml .= "    <image:image>\n";
                $xml .= '      <image:loc>'.htmlspecialchars($item['image'], ENT_XML1, 'UTF-8')."</image:loc>\n";
                if (! empty($item['title'])) {
                    $xml .= '      <image:title>'.htmlspecialchars($item['title'], ENT_XML1, 'UTF-8')."</image:title>\n";
                }
                $xml .= "    </image:image>\n";
            }

            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
