<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

/**
 * SocialMediaController: CRUD platform media sosial.
 * Digunakan di footer dan halaman kontak.
 */
class SocialMediaController extends Controller
{
    public function index()
    {
        $socials = SocialMedia::orderBy('sort_order')->get();
        return view('admin.contact.social-media.index', compact('socials'));
    }

    public function create()
    {
        return view('admin.contact.social-media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform'   => 'required|string|max:100',
            'username'   => 'nullable|string|max:100',
            'url'        => 'required|url|max:500',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        SocialMedia::create([
            'platform'   => $request->platform,
            'username'   => $request->username,
            'url'        => $request->url,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.contact.social-media.index')
            ->with('success', '✅ Media sosial berhasil ditambahkan!');
    }

    public function edit(SocialMedia $socialMedium)
    {
        return view('admin.contact.social-media.edit', compact('socialMedium'));
    }

    public function update(Request $request, SocialMedia $socialMedium)
    {
        $request->validate([
            'platform'   => 'required|string|max:100',
            'username'   => 'nullable|string|max:100',
            'url'        => 'required|url|max:500',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $socialMedium->update([
            'platform'   => $request->platform,
            'username'   => $request->username,
            'url'        => $request->url,
            'icon'       => $request->icon,
            'sort_order' => $request->sort_order ?? $socialMedium->sort_order,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.contact.social-media.index')
            ->with('success', '✅ Media sosial berhasil diperbarui!');
    }

    public function destroy(SocialMedia $socialMedium)
    {
        $socialMedium->delete();
        return redirect()->route('admin.contact.social-media.index')
            ->with('success', '🗑️ Media sosial berhasil dihapus!');
    }
}
