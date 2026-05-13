<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterHeroSetting;
use App\Models\RegisterBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * RegisterHeroSettingController: Mengelola hero section halaman pendaftaran.
 * Pola singleton (update saja, tidak create/delete untuk data utama).
 */
class RegisterHeroSettingController extends Controller
{
    public function index()
    {
        $hero     = RegisterHeroSetting::with('benefits')->first()
                    ?? new RegisterHeroSetting();
        $benefits = $hero->exists ? $hero->benefits : collect();

        return view('admin.register.hero', compact('hero', 'benefits'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'badge_text'      => 'nullable|string|max:100',
            'title_line_1'    => 'nullable|string|max:255',
            'title_highlight' => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'hero_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $hero = RegisterHeroSetting::first() ?? new RegisterHeroSetting();

        $data = $request->only(['badge_text', 'title_line_1', 'title_highlight', 'description']);

        if ($request->hasFile('hero_image')) {
            // Hapus gambar lama jika ada
            if ($hero->hero_image && Storage::disk('public')->exists($hero->hero_image)) {
                Storage::disk('public')->delete($hero->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('images/register', 'public');
        }

        $hero->fill($data)->save();

        return redirect()->route('admin.register.hero.index')
            ->with('success', '✅ Hero section berhasil diperbarui!');
    }
}
