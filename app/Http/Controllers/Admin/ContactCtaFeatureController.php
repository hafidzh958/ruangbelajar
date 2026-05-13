<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactCtaFeature;
use Illuminate\Http\Request;

/**
 * ContactCtaFeatureController: CRUD checklist benefit WhatsApp CTA.
 */
class ContactCtaFeatureController extends Controller
{
    public function index()
    {
        $features = ContactCtaFeature::orderBy('sort_order')->get();
        return view('admin.contact.cta-features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.contact.cta-features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:100',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        ContactCtaFeature::create([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->sort_order ?? 0,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.contact.cta-features.index')
            ->with('success', '✅ Fitur CTA berhasil ditambahkan!');
    }

    public function edit(ContactCtaFeature $ctaFeature)
    {
        return view('admin.contact.cta-features.edit', compact('ctaFeature'));
    }

    public function update(Request $request, ContactCtaFeature $ctaFeature)
    {
        $request->validate([
            'feature_text' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:100',
            'sort_order'   => 'nullable|integer|min:0',
        ]);

        $ctaFeature->update([
            'feature_text' => $request->feature_text,
            'icon'         => $request->icon,
            'sort_order'   => $request->sort_order ?? $ctaFeature->sort_order,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.contact.cta-features.index')
            ->with('success', '✅ Fitur CTA berhasil diperbarui!');
    }

    public function destroy(ContactCtaFeature $ctaFeature)
    {
        $ctaFeature->delete();
        return redirect()->route('admin.contact.cta-features.index')
            ->with('success', '🗑️ Fitur CTA berhasil dihapus!');
    }
}
