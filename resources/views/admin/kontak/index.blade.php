@extends('admin.layouts.app')
@section('title', 'Kontak & FAQ')
@section('page-title', 'Kelola Kontak')
@section('breadcrumb', 'Informasi kontak, jam operasional, Google Maps, dan FAQ')

@section('content')
<div class="space-y-6">

{{-- ===== INFO KONTAK ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white flex items-center gap-3">
        <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">📞</div>
        <h2 class="font-semibold text-gray-800">Informasi Kontak & Lokasi</h2>
    </div>
    <form method="POST" action="{{ route('admin.kontak.update-info') }}" class="p-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Lembaga</label>
                <input type="text" name="contact_nama_lembaga"
                       value="{{ old('contact_nama_lembaga', $settings['contact_nama_lembaga'] ?? 'Ruang Belajar') }}"
                       placeholder="Ruang Belajar"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nomor WhatsApp</label>
                <div class="flex gap-2">
                    <input type="text" name="contact_whatsapp"
                           value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? $settings['contact_cta_whatsapp_number'] ?? '') }}"
                           placeholder="6283157112597"
                           class="flex-1 px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$settings['contact_whatsapp'] ?? $settings['contact_cta_whatsapp_number'] ?? '') }}" target="_blank"
                       class="px-3 py-2.5 bg-green-50 hover:bg-green-100 text-green-600 rounded-xl transition text-sm font-semibold whitespace-nowrap flex items-center gap-1">
                        <i class="fab fa-whatsapp"></i> Test
                    </a>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email</label>
                <input type="email" name="contact_email"
                       value="{{ old('contact_email', $settings['contact_email'] ?? $settings['contact_location_email'] ?? '') }}"
                       placeholder="halo@ruangbelajar.com"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jam Operasional</label>
                <input type="text" name="contact_jam_operasional"
                       value="{{ old('contact_jam_operasional', $settings['contact_jam_operasional'] ?? 'Senin–Sabtu, 08:00–18:00 WIB') }}"
                       placeholder="Senin-Sabtu, 08:00 - 18:00 WIB"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Alamat Lengkap</label>
                <textarea name="contact_alamat" rows="2"
                          placeholder="Tajur, Bogor Selatan, Kota Bogor, Jawa Barat"
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('contact_alamat', $settings['contact_alamat'] ?? $settings['contact_location_address'] ?? '') }}</textarea>
            </div>

            {{-- Google Maps --}}
            <div class="md:col-span-2 border-t border-gray-100 pt-4">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">📍 Google Maps</p>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Embed URL
                    <span class="text-gray-400 font-normal ml-1">(salin dari Google Maps → Share → Embed)</span>
                </label>
                <div class="flex gap-2">
                    <input type="text" name="contact_maps_embed_url" id="maps-embed-input"
                           value="{{ old('contact_maps_embed_url', $settings['contact_maps_embed_url'] ?? '') }}"
                           placeholder="https://www.google.com/maps/embed?pb=..."
                           class="flex-1 px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    <button type="button" onclick="previewMaps()"
                            class="px-3 py-2 bg-brand-50 hover:bg-brand-100 text-brand-600 rounded-xl text-xs font-semibold transition whitespace-nowrap">
                        Preview
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Latitude</label>
                <input type="text" name="contact_maps_latitude"
                       value="{{ old('contact_maps_latitude', $settings['contact_maps_latitude'] ?? '-6.622') }}"
                       placeholder="-6.622285"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Longitude</label>
                <input type="text" name="contact_maps_longitude"
                       value="{{ old('contact_maps_longitude', $settings['contact_maps_longitude'] ?? '106.815') }}"
                       placeholder="106.815330"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>

            {{-- Maps Preview --}}
            <div class="md:col-span-2" id="maps-preview-wrap" style="{{ ($settings['contact_maps_embed_url'] ?? '') ? '' : 'display:none' }}">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Preview Peta</label>
                <div class="rounded-2xl overflow-hidden border border-gray-200 h-48">
                    <iframe id="maps-iframe"
                            src="{{ $settings['contact_maps_embed_url'] ?? '' }}"
                            width="100%" height="100%" style="border:0" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Info Kontak
            </button>
        </div>
    </form>
</div>

{{-- ===== FAQ ===== --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="faq">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-sm">❓</div>
            <div>
                <h2 class="font-semibold text-gray-800">FAQ / Pertanyaan Umum</h2>
                <p class="text-xs text-gray-400">{{ $faqs->count() }} FAQ terdaftar</p>
            </div>
        </div>
        <button onclick="toggleModal('modal-faq')"
                class="flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah FAQ
        </button>
    </div>
    @if($faqs->isEmpty())
        <div class="py-12 text-center text-gray-400 text-sm">Belum ada FAQ. Klik "Tambah FAQ" untuk mulai.</div>
    @else
        <div class="divide-y divide-gray-50">
            @foreach($faqs as $faq)
            <div class="px-6 py-4 hover:bg-gray-50 transition flex items-start gap-4">
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 text-sm">{{ $faq->question }}</p>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $faq->answer }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <form method="POST" action="{{ route('admin.kontak.faq.toggle', $faq) }}">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $faq->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }} transition">
                            {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                    <button onclick="openEditFaq({{ $faq->id }}, '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}')"
                            class="p-1.5 text-brand-600 hover:bg-brand-50 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <form method="POST" action="{{ route('admin.kontak.faq.destroy', $faq) }}" onsubmit="return confirm('Hapus FAQ ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

</div>

{{-- Modal FAQ --}}
<div id="modal-faq" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-faq')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 id="modal-faq-title" class="font-semibold text-gray-800">Tambah FAQ</h3>
            <button onclick="toggleModal('modal-faq')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="faq-form" method="POST" action="{{ route('admin.kontak.faq.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="faq-method" value="POST">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Pertanyaan <span class="text-red-400">*</span></label>
                <input type="text" name="question" id="faq-question" required
                       placeholder="Apakah ada sesi trial gratis?"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Jawaban <span class="text-red-400">*</span></label>
                <textarea name="answer" id="faq-answer" rows="4" required
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-faq')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-purple-600 hover:bg-purple-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleModal(id) { const m=document.getElementById(id); m.classList.toggle('hidden'); m.classList.toggle('flex'); }

function openEditFaq(id, question, answer) {
    document.getElementById('faq-form').action = `/admin/kontak/faq/${id}`;
    document.getElementById('faq-method').value = 'PUT';
    document.getElementById('faq-question').value = question;
    document.getElementById('faq-answer').value = answer;
    document.getElementById('modal-faq-title').textContent = 'Edit FAQ';
    toggleModal('modal-faq');
}

function previewMaps() {
    const url = document.getElementById('maps-embed-input').value.trim();
    if (!url) return;
    document.getElementById('maps-iframe').src = url;
    document.getElementById('maps-preview-wrap').style.display = '';
}
</script>
@endpush
