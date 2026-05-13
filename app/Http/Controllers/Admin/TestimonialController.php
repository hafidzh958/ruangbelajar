<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * TestimonialController: CRUD testimoni.
 * Mendukung filter berdasarkan 'page' (beranda / about).
 */
class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan query ?page_filter=about atau default semua
        $pageFilter = $request->query('page_filter', 'all');

        $query = Testimonial::orderBy('urutan');

        if ($pageFilter !== 'all') {
            $query->where('page', $pageFilter);
        }

        $testimonials = $query->get();

        return view('admin.testimonial.index', compact('testimonials', 'pageFilter'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'status'        => 'nullable|string|max:255',
            'testimonial'   => 'required|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'        => 'nullable|integer|min:0',
            'rating'        => 'nullable|integer|min:1|max:5',
            'page'          => 'required|in:beranda,about',
        ]);

        $data = $request->only(['nama_orangtua', 'status', 'testimonial', 'urutan', 'rating', 'page']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonial.index')->with('success', '✅ Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'status'        => 'nullable|string|max:255',
            'testimonial'   => 'required|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'urutan'        => 'nullable|integer|min:0',
            'rating'        => 'nullable|integer|min:1|max:5',
            'page'          => 'required|in:beranda,about',
        ]);

        $data = $request->only(['nama_orangtua', 'status', 'testimonial', 'urutan', 'rating', 'page']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('foto')) {
            if ($testimonial->foto && Storage::disk('public')->exists($testimonial->foto)) {
                Storage::disk('public')->delete($testimonial->foto);
            }
            $data['foto'] = $request->file('foto')->store('images/testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonial.index')->with('success', '✅ Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->foto && Storage::disk('public')->exists($testimonial->foto)) {
            Storage::disk('public')->delete($testimonial->foto);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonial.index')->with('success', '🗑️ Testimoni berhasil dihapus!');
    }
}
