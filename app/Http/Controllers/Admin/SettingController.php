<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * SettingController mengelola seluruh konten statis beranda:
 * Hero, Statistik, Solution, CTA, Footer — semua dalam 1 controller.
 */
class SettingController extends Controller
{
    /**
     * Tampilkan halaman edit settings beranda (Hero, Statistik, Solution, CTA, Footer)
     */
    public function index()
    {
        // Ambil semua settings sebagai array asosiatif [key => value] untuk memudahkan form
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Proses update massal seluruh settings beranda
     */
    public function update(Request $request)
    {
        $request->validate([
            'hero_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'solution_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        // Definisi seluruh key yang boleh diupdate (whitelist untuk keamanan)
        $textKeys = [
            // Hero
            'hero_badge_text', 'hero_title_line_1', 'hero_title_highlight',
            'hero_title_line_2', 'hero_description',
            'hero_button_1_text', 'hero_button_1_link',
            'hero_button_2_text', 'hero_button_2_link',
            // Statistik
            'statistik_jumlah_siswa', 'statistik_jumlah_tutor', 'statistik_peningkatan_hasil',
            // Solution
            'solution_title', 'solution_subtitle', 'solution_description',
            'solution_checklist_1', 'solution_checklist_2', 'solution_checklist_3', 'solution_checklist_4',
            // CTA
            'cta_title', 'cta_subtitle', 'cta_button_text', 'cta_button_link',
            // Footer
            'footer_alamat', 'footer_whatsapp', 'footer_instagram', 'footer_facebook', 'footer_copyright',
        ];

        // Simpan semua field teks
        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $this->getGroup($key)]
                );
            }
        }

        // Handle upload gambar Hero
        if ($request->hasFile('hero_image')) {
            $this->deleteOldImage('hero_image'); // Hapus gambar lama
            $path = $request->file('hero_image')->store('images/hero', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $path, 'group' => 'hero']);
        }

        // Handle upload gambar Solution
        if ($request->hasFile('solution_image')) {
            $this->deleteOldImage('solution_image'); // Hapus gambar lama
            $path = $request->file('solution_image')->store('images/solution', 'public');
            Setting::updateOrCreate(['key' => 'solution_image'], ['value' => $path, 'group' => 'solution']);
        }

        return redirect()->route('admin.settings.index')->with('success', '✅ Konten beranda berhasil diperbarui!');
    }

    /**
     * Helper: tentukan group berdasarkan prefix key
     */
    private function getGroup(string $key): string
    {
        $prefix = explode('_', $key)[0];
        return in_array($prefix, ['hero', 'statistik', 'solution', 'cta', 'footer']) ? $prefix : 'general';
    }

    /**
     * Helper: hapus file gambar lama dari storage
     */
    private function deleteOldImage(string $key): void
    {
        $old = Setting::where('key', $key)->value('value');
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
    }
}
