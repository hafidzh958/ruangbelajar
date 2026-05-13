<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSettingRequest;
use App\Http\Requests\Admin\KeunggulanRequest;
use App\Models\HomeSetting;
use App\Models\Keunggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * BerandaController: Mengelola halaman CMS Beranda dari admin panel.
 * - index()         → tampil halaman lengkap (hero + statistik + keunggulan)
 * - updateHero()    → update hero section + statistik
 * - storeKeunggulan()   → tambah keunggulan baru
 * - updateKeunggulan()  → edit keunggulan
 * - destroyKeunggulan() → hapus keunggulan
 * - toggleKeunggulan()  → aktif/nonaktif (AJAX-friendly)
 */
class BerandaController extends Controller
{
    // ==========================================
    // MAIN PAGE
    // ==========================================

    public function index()
    {
        $setting      = HomeSetting::getInstance();
        $keunggulans  = Keunggulan::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.beranda.index', compact('setting', 'keunggulans'));
    }

    // ==========================================
    // HERO + STATISTIK
    // ==========================================

    public function updateHero(HomeSettingRequest $request)
    {
        $setting = HomeSetting::getInstance();

        $data = $request->only([
            'badge_text', 'title', 'highlighted_title', 'description',
            'button_text', 'button_link',
            'total_students', 'total_programs', 'total_tutors',
        ]);

        // Handle upload gambar hero
        if ($request->hasFile('hero_image')) {
            // Hapus gambar lama dari storage
            if ($setting->hero_image && Storage::disk('public')->exists($setting->hero_image)) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')
                ->store('images/beranda', 'public');
        }

        $setting->update($data);

        return redirect()
            ->route('admin.beranda.index')
            ->with('success', '✅ Hero & Statistik berhasil diperbarui!');
    }

    // ==========================================
    // KEUNGGULAN CRUD
    // ==========================================

    public function storeKeunggulan(KeunggulanRequest $request)
    {
        // Auto sort_order: ambil nilai tertinggi + 1
        $maxOrder = Keunggulan::max('sort_order') ?? 0;

        Keunggulan::create([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $maxOrder + 1),
            'urutan'      => $request->input('sort_order', $maxOrder + 1),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '✅ Keunggulan berhasil ditambahkan!');
    }

    public function editKeunggulan(Keunggulan $keunggulan)
    {
        return view('admin.beranda.keunggulan-edit', compact('keunggulan'));
    }

    public function updateKeunggulan(KeunggulanRequest $request, Keunggulan $keunggulan)
    {
        $keunggulan->update([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $keunggulan->sort_order),
            'urutan'      => $request->input('sort_order', $keunggulan->sort_order),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '✅ Keunggulan berhasil diperbarui!');
    }

    public function destroyKeunggulan(Keunggulan $keunggulan)
    {
        $keunggulan->delete();

        return redirect()
            ->route('admin.beranda.index', '#keunggulan')
            ->with('success', '🗑️ Keunggulan berhasil dihapus!');
    }

    public function toggleKeunggulan(Keunggulan $keunggulan)
    {
        $keunggulan->update(['is_active' => !$keunggulan->is_active]);

        $status = $keunggulan->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "✅ Keunggulan \"{$keunggulan->title}\" berhasil {$status}!");
    }
}
