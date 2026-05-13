<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * SeoSettingController — Kelola SEO global, per-halaman, dan script injection.
 * Semua data di tabel settings dengan group = 'seo_global' / 'seo_pages' / 'seo_scripts'.
 */
class SeoSettingController extends Controller
{
    // ---- Daftar halaman yang punya SEO per-halaman ----
    public const PAGES = ['home', 'about', 'program', 'contact', 'register'];

    public function index()
    {
        $global  = Setting::group('seo_global');
        $scripts = Setting::group('seo_scripts');
        $pages_data = [];
        foreach (self::PAGES as $page) {
            $pages_data[$page] = Setting::group("seo_page_{$page}");
        }

        return view('admin.settings.seo', compact('global', 'scripts', 'pages_data'));
    }

    // =================== UPDATE SEO GLOBAL ===================

    public function updateGlobal(Request $request)
    {
        $request->validate([
            'default_meta_title'       => 'nullable|string|max:70',
            'default_meta_description' => 'nullable|string|max:160',
            'default_meta_keywords'    => 'nullable|string|max:500',
            'canonical_url'            => 'nullable|url|max:500',
            'og_title'                 => 'nullable|string|max:100',
            'og_description'           => 'nullable|string|max:200',
            'og_image'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'twitter_card_type'        => 'nullable|in:summary,summary_large_image,app,player',
            'robots_index'             => 'nullable|in:index,noindex',
            'robots_follow'            => 'nullable|in:follow,nofollow',
        ]);

        $textKeys = [
            'default_meta_title', 'default_meta_description', 'default_meta_keywords',
            'canonical_url', 'og_title', 'og_description',
            'twitter_card_type', 'robots_index', 'robots_follow',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), 'seo_global');
            }
        }

        if ($request->hasFile('og_image')) {
            Setting::upload('og_image', $request->file('og_image'), 'images/seo', 'seo_global');
        }

        return redirect()->route('admin.settings.seo', '#global')
            ->with('success', '✅ SEO global berhasil disimpan!');
    }

    // =================== UPDATE SEO PER HALAMAN ===================

    public function updatePage(Request $request, string $page)
    {
        if (!in_array($page, self::PAGES)) {
            abort(404);
        }

        $request->validate([
            'meta_title'       => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords'    => 'nullable|string|max:500',
            'og_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $group = "seo_page_{$page}";

        foreach (['meta_title', 'meta_description', 'meta_keywords'] as $key) {
            Setting::set("{$page}_{$key}", $request->input($key), $group);
        }

        if ($request->hasFile('og_image')) {
            Setting::upload("{$page}_og_image", $request->file('og_image'), "images/seo/{$page}", $group);
        }

        return redirect()->route('admin.settings.seo', "#page-{$page}")
            ->with('success', "✅ SEO halaman " . ucfirst($page) . " berhasil disimpan!");
    }

    // =================== UPDATE SCRIPTS ===================

    public function updateScripts(Request $request)
    {
        $request->validate([
            'google_analytics'    => 'nullable|string',
            'facebook_pixel'      => 'nullable|string',
            'custom_head_script'  => 'nullable|string',
            'custom_body_script'  => 'nullable|string',
        ]);

        foreach (['google_analytics', 'facebook_pixel', 'custom_head_script', 'custom_body_script'] as $key) {
            Setting::set($key, $request->input($key, ''), 'seo_scripts');
        }

        return redirect()->route('admin.settings.seo', '#scripts')
            ->with('success', '✅ Script injection berhasil disimpan!');
    }
}
