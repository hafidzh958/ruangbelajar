<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ProgramHighlight;
use Illuminate\Http\Request;

/**
 * ProgramHighlightController: CRUD highlight/value utama per program.
 * Pola sama dengan ProgramFeatureController (nested resource).
 */
class ProgramHighlightController extends Controller
{
    public function index(Program $program)
    {
        $program    = Program::withoutGlobalScopes()->with('highlights')->findOrFail($program->id);
        $highlights = $program->highlights;

        return view('admin.program.highlights.index', compact('program', 'highlights'));
    }

    public function create(Program $program)
    {
        $program = Program::withoutGlobalScopes()->findOrFail($program->id);
        return view('admin.program.highlights.create', compact('program'));
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $program->highlights()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.program.highlights.index', $program->id)
            ->with('success', '✅ Highlight berhasil ditambahkan!');
    }

    public function edit(Program $program, ProgramHighlight $highlight)
    {
        $program = Program::withoutGlobalScopes()->findOrFail($program->id);
        return view('admin.program.highlights.edit', compact('program', 'highlight'));
    }

    public function update(Request $request, Program $program, ProgramHighlight $highlight)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $highlight->update([
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sort_order'  => $request->sort_order ?? $highlight->sort_order,
        ]);

        return redirect()->route('admin.program.highlights.index', $program->id)
            ->with('success', '✅ Highlight berhasil diperbarui!');
    }

    public function destroy(Program $program, ProgramHighlight $highlight)
    {
        $highlight->delete();

        return redirect()->route('admin.program.highlights.index', $program->id)
            ->with('success', '🗑️ Highlight berhasil dihapus!');
    }
}
