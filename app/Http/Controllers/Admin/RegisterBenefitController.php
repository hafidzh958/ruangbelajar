<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterBenefit;
use App\Models\RegisterHeroSetting;
use Illuminate\Http\Request;

/**
 * RegisterBenefitController: CRUD benefit/checklist halaman pendaftaran.
 * Nested resource di bawah hero setting.
 */
class RegisterBenefitController extends Controller
{
    public function index()
    {
        $benefits = RegisterBenefit::orderBy('sort_order')->get();
        return view('admin.register.benefits.index', compact('benefits'));
    }

    public function create()
    {
        return view('admin.register.benefits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        // Pastikan hero setting ada (auto-create jika belum)
        $hero = RegisterHeroSetting::first() ?? RegisterHeroSetting::create([]);

        RegisterBenefit::create([
            'register_hero_id' => $hero->id,
            'title'            => $request->title,
            'description'      => $request->description,
            'icon'             => $request->icon,
            'sort_order'       => $request->input('sort_order', 0),
            'is_active'        => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.register.benefits.index')
            ->with('success', '✅ Benefit berhasil ditambahkan!');
    }

    public function edit(RegisterBenefit $benefit)
    {
        return view('admin.register.benefits.edit', compact('benefit'));
    }

    public function update(Request $request, RegisterBenefit $benefit)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $benefit->update([
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sort_order'  => $request->input('sort_order', $benefit->sort_order),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.register.benefits.index')
            ->with('success', '✅ Benefit berhasil diperbarui!');
    }

    public function destroy(RegisterBenefit $benefit)
    {
        $benefit->delete();

        return redirect()->route('admin.register.benefits.index')
            ->with('success', '🗑️ Benefit berhasil dihapus!');
    }
}
