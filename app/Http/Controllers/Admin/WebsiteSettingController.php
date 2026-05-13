<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * WebsiteSettingController — Kelola identitas website global.
 * Data disimpan di tabel settings dengan group = 'website'.
 */
class WebsiteSettingController extends Controller
{
    private const GROUP = 'website';

    private const TEXT_KEYS = [
        'website_name', 'website_tagline', 'default_email',
        'default_whatsapp', 'default_address', 'default_footer_text',
    ];

    public function index()
    {
        $settings = Setting::group(self::GROUP);
        // Merge dengan grup lain yang mungkin sudah ada
        $settings += Setting::groups(['seo_global', 'seo_scripts', 'website']);

        return view('admin.settings.website', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website_name'       => 'nullable|string|max:100',
            'website_tagline'    => 'nullable|string|max:200',
            'default_email'      => 'nullable|email|max:255',
            'default_whatsapp'   => 'nullable|string|max:20',
            'default_address'    => 'nullable|string',
            'default_footer_text'=> 'nullable|string|max:500',
            'logo'               => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon'            => 'nullable|mimes:ico,png,svg|max:512',
        ]);

        foreach (self::TEXT_KEYS as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key), self::GROUP);
            }
        }

        if ($request->hasFile('logo')) {
            Setting::upload('logo', $request->file('logo'), 'images/website', self::GROUP);
        }

        if ($request->hasFile('favicon')) {
            Setting::upload('favicon', $request->file('favicon'), 'images/website', self::GROUP);
        }

        return redirect()->route('admin.settings.website')
            ->with('success', '✅ Website settings berhasil disimpan!');
    }
}
