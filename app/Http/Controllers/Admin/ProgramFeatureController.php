<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramFeature;
use Illuminate\Http\Request;

/**
 * ProgramFeatureController: CRUD fitur/checklist per program.
 *
 * Rute: /admin/program/{program}/features
 * Diakses dari halaman edit program.
 */
class ProgramFeatureController extends Controller
{
    /**
     * Tampilkan daftar fitur program tertentu.
     * Menerima Program sebagai route model binding (nested resource).
     */
    public function index(Program $program)
    {
        $program  = Program::withoutGlobalScopes()->with('features')->findOrFail($program->id);
        $features = $program->features;

        return view('admin.program.features.index', compact('program', 'features'));
    }

    public function create(Program $program)
    {
        $program = Program::withoutGlobalScopes()->findOrFail($program->id);
        return view('admin.program.features.create', compact('program'));
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:100',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $program->features()->create([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.program.features.index', $program->id)
            ->with('success', '✅ Fitur berhasil ditambahkan!');
    }

    public function edit(Program $program, ProgramFeature $feature)
    {
        $program = Program::withoutGlobalScopes()->findOrFail($program->id);
        return view('admin.program.features.edit', compact('program', 'feature'));
    }

    public function update(Request $request, Program $program, ProgramFeature $feature)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:100',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $feature->update([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->sort_order ?? $feature->sort_order,
        ]);

        return redirect()->route('admin.program.features.index', $program->id)
            ->with('success', '✅ Fitur berhasil diperbarui!');
    }

    public function destroy(Program $program, ProgramFeature $feature)
    {
        $feature->delete();

        return redirect()->route('admin.program.features.index', $program->id)
            ->with('success', '🗑️ Fitur berhasil dihapus!');
    }
}
