<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * ProgramController: CRUD program bimbingan belajar (halaman Program).
 * Menggantikan versi lama yang hanya memiliki field dasar.
 */
class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withoutGlobalScopes()
            ->orderBy('urutan')
            ->get();

        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program'       => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:programs,slug',
            'kategori'           => 'nullable|string|max:100',
            'badge_text'         => 'nullable|string|max:100',
            'umur_target'        => 'nullable|string|max:100',
            'short_description'  => 'nullable|string|max:500',
            'deskripsi'          => 'required|string',
            'button_text'        => 'nullable|string|max:100',
            'button_link'        => 'nullable|string|max:255',
            'icon'               => 'nullable|string|max:100',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'background_theme'   => 'nullable|string|max:50',
            'urutan'             => 'nullable|integer|min:0',
            'is_featured'        => 'boolean',
            'status'             => 'required|in:active,draft,inactive',
        ]);

        $data                = $request->only([
            'nama_program', 'slug', 'kategori', 'badge_text', 'umur_target',
            'short_description', 'deskripsi', 'button_text', 'button_link',
            'icon', 'background_theme', 'urutan', 'status',
        ]);
        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        // Jika slug kosong, auto-generate dari nama_program
        $data['slug']        = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->nama_program);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/programs', 'public');
        }

        Program::create($data);

        return redirect()->route('admin.program.index')
            ->with('success', '✅ Program berhasil ditambahkan!');
    }

    public function edit(Program $program)
    {
        $program = Program::withoutGlobalScopes()
            ->with(['features', 'highlights'])
            ->findOrFail($program->id);

        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'nama_program'      => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:programs,slug,' . $program->id,
            'kategori'          => 'nullable|string|max:100',
            'badge_text'        => 'nullable|string|max:100',
            'umur_target'       => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'deskripsi'         => 'required|string',
            'button_text'       => 'nullable|string|max:100',
            'button_link'       => 'nullable|string|max:255',
            'icon'              => 'nullable|string|max:100',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'background_theme'  => 'nullable|string|max:50',
            'urutan'            => 'nullable|integer|min:0',
            'status'            => 'required|in:active,draft,inactive',
        ]);

        $data                = $request->only([
            'nama_program', 'slug', 'kategori', 'badge_text', 'umur_target',
            'short_description', 'deskripsi', 'button_text', 'button_link',
            'icon', 'background_theme', 'urutan', 'status',
        ]);
        $data['is_active']   = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['slug']        = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->nama_program);

        if ($request->hasFile('image')) {
            if ($program->image && Storage::disk('public')->exists($program->image)) {
                Storage::disk('public')->delete($program->image);
            }
            $data['image'] = $request->file('image')->store('images/programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.program.index')
            ->with('success', '✅ Program berhasil diperbarui!');
    }

    public function destroy(Program $program)
    {
        if ($program->image && Storage::disk('public')->exists($program->image)) {
            Storage::disk('public')->delete($program->image);
        }
        // Cascade delete otomatis menghapus features & highlights (karena onDelete('cascade'))
        $program->delete();

        return redirect()->route('admin.program.index')
            ->with('success', '🗑️ Program berhasil dihapus!');
    }
}
