<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutSettingRequest;
use App\Http\Requests\Admin\AboutApproachRequest;
use App\Models\AboutSetting;
use App\Models\AboutApproach;
use Illuminate\Support\Facades\Storage;

/**
 * TentangController: Single-page CMS halaman Tentang Kami.
 *
 * - index()           → tampil halaman (hero + visi/misi + pendekatan)
 * - updateSetting()   → update hero + visi + misi
 * - storeApproach()   → tambah pendekatan belajar
 * - editApproach()    → form edit pendekatan
 * - updateApproach()  → simpan edit pendekatan
 * - destroyApproach() → hapus pendekatan
 * - toggleApproach()  → aktif/nonaktif pendekatan
 */
class TentangController extends Controller
{
    // ---- MAIN PAGE ----

    public function index()
    {
        $setting   = AboutSetting::getInstance();
        $approaches = AboutApproach::where('type', 'approach')
            ->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.tentang.index', compact('setting', 'approaches'));
    }

    // ---- HERO + VISI + MISI ----

    public function updateSetting(AboutSettingRequest $request)
    {
        $setting = AboutSetting::getInstance();

        $data = $request->only([
            'badge_text', 'title', 'highlighted_title', 'description',
            'vision_title', 'vision_description',
            'mission_title', 'mission_description',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image && Storage::disk('public')->exists($setting->hero_image)) {
                Storage::disk('public')->delete($setting->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')
                ->store('images/tentang', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.tentang.index')
            ->with('success', '✅ Konten Tentang Kami berhasil diperbarui!');
    }

    // ---- PENDEKATAN BELAJAR CRUD ----

    public function storeApproach(AboutApproachRequest $request)
    {
        $maxOrder = AboutApproach::where('type', 'approach')->max('sort_order') ?? 0;

        AboutApproach::create([
            'type'        => 'approach',
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'text'        => $request->title, // backward compat
            'sort_order'  => $request->input('sort_order', $maxOrder + 1),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#pendekatan')
            ->with('success', '✅ Pendekatan belajar berhasil ditambahkan!');
    }

    public function editApproach(AboutApproach $approach)
    {
        return view('admin.tentang.approach-edit', compact('approach'));
    }

    public function updateApproach(AboutApproachRequest $request, AboutApproach $approach)
    {
        $approach->update([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'text'        => $request->title,
            'sort_order'  => $request->input('sort_order', $approach->sort_order),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.tentang.index', '#pendekatan')
            ->with('success', '✅ Pendekatan belajar berhasil diperbarui!');
    }

    public function destroyApproach(AboutApproach $approach)
    {
        $approach->delete();

        return redirect()->back()
            ->with('success', '🗑️ Pendekatan belajar berhasil dihapus!');
    }

    public function toggleApproach(AboutApproach $approach)
    {
        $approach->update(['is_active' => !$approach->is_active]);
        $status = $approach->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "✅ \"{$approach->title}\" berhasil {$status}!");
    }
}
