<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function index()
    {
        // withoutGlobalScopes() agar tampil semua (termasuk non-urutan) untuk admin
        $keunggulans = Keunggulan::withoutGlobalScopes()->orderBy('urutan')->get();
        return view('admin.keunggulan.index', compact('keunggulans'));
    }

    public function create()
    {
        return view('admin.keunggulan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'urutan'      => 'nullable|integer|min:0',
        ]);

        Keunggulan::create($request->only(['title', 'description', 'icon', 'urutan']));

        return redirect()->route('admin.keunggulan.index')->with('success', '✅ Keunggulan berhasil ditambahkan!');
    }

    public function edit(Keunggulan $keunggulan)
    {
        return view('admin.keunggulan.edit', compact('keunggulan'));
    }

    public function update(Request $request, Keunggulan $keunggulan)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'urutan'      => 'nullable|integer|min:0',
        ]);

        $keunggulan->update($request->only(['title', 'description', 'icon', 'urutan']));

        return redirect()->route('admin.keunggulan.index')->with('success', '✅ Keunggulan berhasil diperbarui!');
    }

    public function destroy(Keunggulan $keunggulan)
    {
        $keunggulan->delete();
        return redirect()->route('admin.keunggulan.index')->with('success', '🗑️ Keunggulan berhasil dihapus!');
    }
}
