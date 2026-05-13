<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactFaq;
use Illuminate\Http\Request;

/**
 * ContactFaqController: CRUD FAQ halaman Kontak.
 */
class ContactFaqController extends Controller
{
    public function index()
    {
        $faqs = ContactFaq::orderBy('sort_order')->get();
        return view('admin.contact.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.contact.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status'     => 'required|in:active,draft',
        ]);

        ContactFaq::create([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'sort_order' => $request->sort_order ?? 0,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.contact.faq.index')
            ->with('success', '✅ FAQ berhasil ditambahkan!');
    }

    public function edit(ContactFaq $faq)
    {
        return view('admin.contact.faq.edit', compact('faq'));
    }

    public function update(Request $request, ContactFaq $faq)
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'status'     => 'required|in:active,draft',
        ]);

        $faq->update([
            'question'   => $request->question,
            'answer'     => $request->answer,
            'sort_order' => $request->sort_order ?? $faq->sort_order,
            'status'     => $request->status,
        ]);

        return redirect()->route('admin.contact.faq.index')
            ->with('success', '✅ FAQ berhasil diperbarui!');
    }

    public function destroy(ContactFaq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.contact.faq.index')
            ->with('success', '🗑️ FAQ berhasil dihapus!');
    }
}
