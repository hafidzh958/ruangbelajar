<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ContactFaq;
use App\Models\ContactCtaFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * KontakAdminController
 * CMS single-page untuk kelola info kontak, jam operasional, maps, FAQ, dan CTA fitur.
 */
class KontakAdminController extends Controller
{
    public function index()
    {
        // Ambil semua setting kontak
        $settings = Setting::whereIn('group', [
            'contact_hero', 'contact_cta', 'contact_operational',
            'contact_location', 'contact_maps', 'contact_info',
        ])->pluck('value', 'key');

        $faqs        = ContactFaq::orderBy('sort_order')->get();
        $ctaFeatures = ContactCtaFeature::orderBy('sort_order')->get();

        return view('admin.kontak.index', compact('settings', 'faqs', 'ctaFeatures'));
    }

    // ---- Update Info Kontak ----

    public function updateInfo(Request $request)
    {
        $request->validate([
            'contact_nama_lembaga'      => 'nullable|string|max:255',
            'contact_alamat'            => 'nullable|string',
            'contact_whatsapp'          => 'nullable|string|max:20',
            'contact_email'             => 'nullable|email|max:255',
            'contact_jam_operasional'   => 'nullable|string|max:255',
            'contact_maps_embed_url'    => 'nullable|string',
            'contact_maps_latitude'     => 'nullable|numeric',
            'contact_maps_longitude'    => 'nullable|numeric',
        ]);

        $keys = [
            'contact_nama_lembaga', 'contact_alamat', 'contact_whatsapp',
            'contact_email', 'contact_jam_operasional',
            'contact_maps_embed_url', 'contact_maps_latitude', 'contact_maps_longitude',
            // Legacy keys
            'contact_location_address', 'contact_location_email', 'contact_location_phone',
            'contact_cta_whatsapp_number', 'contact_operational_days',
            'contact_operational_open_time', 'contact_operational_close_time',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key), 'group' => $this->resolveGroup($key)]
                );
            }
        }

        return redirect()->route('admin.kontak.index')
            ->with('success', '✅ Informasi kontak berhasil diperbarui!');
    }

    // ---- FAQ CRUD ----

    public function storeFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        $maxOrder = ContactFaq::max('sort_order') ?? 0;

        ContactFaq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'sort_order' => $maxOrder + 1,
            'is_active'  => true,
            'status'     => 'active',
        ]);

        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '✅ FAQ berhasil ditambahkan!');
    }

    public function updateFaq(Request $request, ContactFaq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer'   => 'required|string',
        ]);

        $faq->update([
            'question' => $request->question,
            'answer'   => $request->answer,
        ]);

        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '✅ FAQ berhasil diperbarui!');
    }

    public function destroyFaq(ContactFaq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.kontak.index', '#faq')
            ->with('success', '🗑️ FAQ berhasil dihapus!');
    }

    public function toggleFaq(ContactFaq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active, 'status' => $faq->is_active ? 'inactive' : 'active']);
        return redirect()->back()->with('success', '✅ Status FAQ diubah!');
    }

    private function resolveGroup(string $key): string
    {
        if (str_starts_with($key, 'contact_cta'))          return 'contact_cta';
        if (str_starts_with($key, 'contact_operational'))  return 'contact_operational';
        if (str_starts_with($key, 'contact_location'))     return 'contact_location';
        if (str_starts_with($key, 'contact_maps'))         return 'contact_maps';
        if (str_starts_with($key, 'contact_hero'))         return 'contact_hero';
        return 'contact_info';
    }
}
