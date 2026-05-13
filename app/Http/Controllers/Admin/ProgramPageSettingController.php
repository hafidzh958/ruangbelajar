<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * ProgramPageSettingController: mengelola konten statis halaman Program.
 * (Hero Section & Consultation CTA Section)
 */
class ProgramPageSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('group', ['program_hero', 'program_cta'])
            ->pluck('value', 'key');

        return view('admin.program.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'program_hero_background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'program_cta_background_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $textKeys = [
            // Hero
            'program_hero_badge_text', 'program_hero_title_line_1',
            'program_hero_title_highlight', 'program_hero_description',
            // Consultation CTA
            'program_cta_badge_text', 'program_cta_title',
            'program_cta_highlighted_text', 'program_cta_description',
            'program_cta_button_text', 'program_cta_button_link',
        ];

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => str_starts_with($key, 'program_hero') ? 'program_hero' : 'program_cta']
                );
            }
        }

        // Handle upload Hero Background
        if ($request->hasFile('program_hero_background_image')) {
            $old = Setting::where('key', 'program_hero_background_image')->value('value');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('program_hero_background_image')->store('images/program/hero', 'public');
            Setting::updateOrCreate(['key' => 'program_hero_background_image'], ['value' => $path, 'group' => 'program_hero']);
        }

        // Handle upload CTA Background
        if ($request->hasFile('program_cta_background_image')) {
            $old = Setting::where('key', 'program_cta_background_image')->value('value');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('program_cta_background_image')->store('images/program/cta', 'public');
            Setting::updateOrCreate(['key' => 'program_cta_background_image'], ['value' => $path, 'group' => 'program_cta']);
        }

        return redirect()->route('admin.program.settings.index')
            ->with('success', '✅ Pengaturan halaman Program berhasil diperbarui!');
    }
}
