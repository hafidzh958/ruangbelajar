<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Program;
use Illuminate\Http\Response;

/**
 * SitemapController — Generate sitemap.xml dan robots.txt secara dinamis.
 */
class SitemapController extends Controller
{
    public function sitemap()
    {
        $baseUrl = Setting::get('canonical_url', config('app.url'));
        $baseUrl = rtrim($baseUrl, '/');

        $staticPages = [
            ['url' => $baseUrl.'/',            'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => $baseUrl.'/about',        'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => $baseUrl.'/program',      'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => $baseUrl.'/contact',      'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => $baseUrl.'/register',     'priority' => '0.9', 'changefreq' => 'monthly'],
        ];

        // Program dynamic pages (jika ada slug)
        $programs = Program::where('is_active', true)->whereNotNull('slug')->get(['slug', 'updated_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticPages as $page) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$page['url']}</loc>\n";
            $xml .= "    <priority>{$page['priority']}</priority>\n";
            $xml .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
            $xml .= "    <lastmod>" . now()->toDateString() . "</lastmod>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $robotsIndex  = Setting::get('robots_index', 'index');
        $robotsFollow = Setting::get('robots_follow', 'follow');
        $sitemapUrl   = rtrim(Setting::get('canonical_url', config('app.url')), '/') . '/sitemap.xml';

        if ($robotsIndex === 'noindex') {
            $content = "User-agent: *\nDisallow: /\n";
        } else {
            $content = "User-agent: *\n";
            $content .= "Allow: /\n";
            $content .= "Disallow: /admin/\n";
            $content .= "Disallow: /ruangbelajar/admin/\n";
            $content .= "Sitemap: {$sitemapUrl}\n";
        }

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
