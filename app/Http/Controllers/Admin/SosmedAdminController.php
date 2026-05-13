<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

/**
 * SosmedAdminController
 * CRUD Social Media links (Instagram, TikTok, YouTube, dll.)
 */
class SosmedAdminController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('sort_order')->get();
        $platforms   = array_keys(SocialMedia::PLATFORMS);

        return view('admin.sosmed.index', compact('socialMedia', 'platforms'));
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

        $maxOrder = SocialMedia::max('sort_order') ?? 0;

        // Auto-icon dari platform jika tidak diisi
        $icon = $request->icon ?: (SocialMedia::PLATFORMS[$request->platform]['icon'] ?? 'fas fa-link');

        SocialMedia::create([
            'platform'   => $request->platform,
            'username'   => $request->username,
            'url'        => $request->url,
            'icon'       => $icon,
            'sort_order' => $request->input('sort_order', $maxOrder + 1),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.sosmed.index')
            ->with('success', '✅ Sosial media berhasil ditambahkan!');
    }

    public function update(Request $request, SocialMedia $sosmed)
    {
        $request->validate([
            'platform'   => 'required|string|max:100',
            'username'   => 'nullable|string|max:100',
            'url'        => 'required|url|max:500',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $icon = $request->icon ?: (SocialMedia::PLATFORMS[$request->platform]['icon'] ?? 'fas fa-link');

        $sosmed->update([
            'platform'   => $request->platform,
            'username'   => $request->username,
            'url'        => $request->url,
            'icon'       => $icon,
            'sort_order' => $request->input('sort_order', $sosmed->sort_order),
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.sosmed.index')
            ->with('success', '✅ Sosial media berhasil diperbarui!');
    }

    public function destroy(SocialMedia $sosmed)
    {
        $sosmed->delete();
        return redirect()->route('admin.sosmed.index')
            ->with('success', '🗑️ Sosial media berhasil dihapus!');
    }

    public function toggle(SocialMedia $sosmed)
    {
        $sosmed->update(['is_active' => !$sosmed->is_active]);
        $status = $sosmed->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "✅ {$sosmed->platform} berhasil {$status}!");
    }
}
