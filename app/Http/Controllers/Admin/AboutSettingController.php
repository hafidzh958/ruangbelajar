<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * AboutSettingController: mengelola semua konten statis halaman Tentang Kami.
 * (Hero About, Story, Vision/Mission, Statistics, CTA)
 * Semua data disimpan di tabel 'settings' dengan prefix group 'about_*'.
 */
class AboutSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', [
            'about_hero', 'about_story', 'about_vision',
            'about_stats', 'about_cta'
        ])->pluck('value', 'key');

        return view('admin.about.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_hero_background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'about_story_image'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        // Whitelist semua key yang boleh diupdate (keamanan)
        $textKeys = [
            // Hero About
            'about_hero_badge_text', 'about_hero_title_line_1',
            'about_hero_title_highlight', 'about_hero_description',
            // Story
            'about_story_title', 'about_story_highlighted_text',
            'about_story_description_1', 'about_story_quote_text', 'about_story_description_2',
            // Vision
            'about_vision_title', 'about_vision_highlighted_text', 'about_vision_description',
            // Mission
            'about_mission_title', 'about_mission_highlighted_text', 'about_mission_description',
            // Statistics
            'about_stats_total_siswa', 'about_stats_total_tutor', 'about_stats_tingkat_prestasi',
            // CTA About
            'about_cta_title', 'about_cta_highlighted_text', 'about_cta_subtitle',
            'about_cta_button_text', 'about_cta_button_link',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $this->resolveGroup($key)]
                );
            }
        }

        // Upload Hero Background Image
        if ($request->hasFile('about_hero_background_image')) {
            $this->replaceImage('about_hero_background_image', 'images/about/hero');
        }

        // Upload Story Image
        if ($request->hasFile('about_story_image')) {
            $this->replaceImage('about_story_image', 'images/about/story', $request);
        }

        return redirect()->route('admin.about.settings.index')
            ->with('success', '✅ Konten Tentang Kami berhasil diperbarui!');
    }

    /** Tentukan group berdasarkan prefix key */
    private function resolveGroup(string $key): string
    {
        if (str_starts_with($key, 'about_hero'))    return 'about_hero';
        if (str_starts_with($key, 'about_story'))   return 'about_story';
        if (str_starts_with($key, 'about_vision'))  return 'about_vision';
        if (str_starts_with($key, 'about_mission')) return 'about_vision'; // disatukan dalam group yang sama
        if (str_starts_with($key, 'about_stats'))   return 'about_stats';
        if (str_starts_with($key, 'about_cta'))     return 'about_cta';
        return 'about_general';
    }

    /** Hapus gambar lama lalu simpan gambar baru ke storage */
    private function replaceImage(string $key, string $folder, ?Request $request = null): void
    {
        $req = $request ?? request();
        $old = Setting::where('key', $key)->value('value');
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $path = $req->file($key)->store($folder, 'public');
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $path, 'group' => $this->resolveGroup($key)]
        );
    }
}
