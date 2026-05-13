<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutApproach;
use Illuminate\Http\Request;

/**
 * AboutApproachController: CRUD item Problem vs Solution halaman Tentang Kami.
 *
 * Tiap item memiliki 'type' = 'problem' atau 'solution'.
 * Admin bisa atur teks, icon, dan urutan masing-masing item secara bebas.
 */
class AboutApproachController extends Controller
{
    public function index()
    {
        $problems  = AboutApproach::where('type', 'problem')->orderBy('sort_order')->get();
        $solutions = AboutApproach::where('type', 'solution')->orderBy('sort_order')->get();

        return view('admin.about.approach.index', compact('problems', 'solutions'));
    }

    public function create()
    {
        return view('admin.about.approach.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'       => 'required|in:problem,solution',
            'text'       => 'required|string|max:500',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        AboutApproach::create([
            'type'       => $request->type,
            'text'       => $request->text,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.about.approach.index')
            ->with('success', '✅ Item berhasil ditambahkan!');
    }

    public function edit(AboutApproach $approach)
    {
        return view('admin.about.approach.edit', compact('approach'));
    }

    public function update(Request $request, AboutApproach $approach)
    {
        $request->validate([
            'type'       => 'required|in:problem,solution',
            'text'       => 'required|string|max:500',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $approach->update([
            'type'       => $request->type,
            'text'       => $request->text,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? $approach->sort_order,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.about.approach.index')
            ->with('success', '✅ Item berhasil diperbarui!');
    }

    public function destroy(AboutApproach $approach)
    {
        $approach->delete();

        return redirect()->route('admin.about.approach.index')
            ->with('success', '🗑️ Item berhasil dihapus!');
    }
}
