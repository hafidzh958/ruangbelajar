@extends('admin.layouts.app')
@section('title', 'Website Settings')
@section('page-title', 'Website Settings')
@section('breadcrumb', 'Identitas global website')

@section('content')
<div class="max-w-3xl">
<form method="POST" action="{{ route('admin.settings.website.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="space-y-5">

    {{-- ===== IDENTITAS ===== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-brand-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-brand-100 text-brand-600 rounded-lg flex items-center justify-center text-sm">🌐</div>
            <h2 class="font-semibold text-gray-800">Identitas Website</h2>
        </div>
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Website <span class="text-red-400">*</span></label>
                    <input type="text" name="website_name"
                           value="{{ old('website_name', $settings['website_name'] ?? 'Ruang Belajar') }}"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Tagline</label>
                    <input type="text" name="website_tagline"
                           value="{{ old('website_tagline', $settings['website_tagline'] ?? 'Platform Edukasi Masa Kini') }}"
                           placeholder="Platform Edukasi Masa Kini"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email Default</label>
                    <input type="email" name="default_email"
                           value="{{ old('default_email', $settings['default_email'] ?? '') }}"
                           placeholder="halo@ruangbelajar.com"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">WhatsApp Default</label>
                    <input type="text" name="default_whatsapp"
                           value="{{ old('default_whatsapp', $settings['default_whatsapp'] ?? '') }}"
                           placeholder="6283157112597"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Alamat Default</label>
                <textarea name="default_address" rows="2"
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('default_address', $settings['default_address'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Footer Text</label>
                <input type="text" name="default_footer_text"
                       value="{{ old('default_footer_text', $settings['default_footer_text'] ?? '') }}"
                       placeholder="© 2025 Ruang Belajar. All rights reserved."
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
        </div>
    </div>

    {{-- ===== LOGO & FAVICON ===== --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center text-sm">🎨</div>
            <h2 class="font-semibold text-gray-800">Logo & Favicon</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo --}}
                <div class="border border-dashed border-gray-200 rounded-2xl p-5 text-center space-y-3">
                    <p class="text-xs font-semibold text-gray-600">Logo Website</p>
                    @if($settings['logo'] ?? null)
                    <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" class="h-12 mx-auto object-contain">
                    @else
                    <div class="w-12 h-12 bg-brand-100 text-brand-600 rounded-xl flex items-center justify-center text-xl font-black mx-auto">RB</div>
                    @endif
                    <input type="file" name="logo" accept="image/*" id="logo-input" class="hidden" onchange="previewImg(this,'logo-preview')">
                    <label for="logo-input" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-xs font-semibold text-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pilih Logo
                    </label>
                    <img id="logo-preview" src="" alt="" class="hidden h-12 mx-auto object-contain rounded-lg">
                    <p class="text-[10px] text-gray-400">JPG, PNG, SVG, WebP. Max 2MB.</p>
                </div>

                {{-- Favicon --}}
                <div class="border border-dashed border-gray-200 rounded-2xl p-5 text-center space-y-3">
                    <p class="text-xs font-semibold text-gray-600">Favicon</p>
                    @if($settings['favicon'] ?? null)
                    <img src="{{ asset('storage/'.$settings['favicon']) }}" alt="Favicon" class="w-8 h-8 mx-auto object-contain">
                    @else
                    <div class="w-8 h-8 bg-brand-600 text-white rounded-lg flex items-center justify-center text-xs font-black mx-auto">RB</div>
                    @endif
                    <input type="file" name="favicon" accept=".ico,.png,.svg" id="favicon-input" class="hidden" onchange="previewImg(this,'favicon-preview')">
                    <label for="favicon-input" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-xs font-semibold text-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pilih Favicon
                    </label>
                    <img id="favicon-preview" src="" alt="" class="hidden w-8 h-8 mx-auto object-contain">
                    <p class="text-[10px] text-gray-400">ICO, PNG, SVG. Max 512KB.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Save Button --}}
    <div class="sticky bottom-4 z-10">
        <div class="bg-white/90 backdrop-blur rounded-2xl border border-gray-100 shadow-lg px-6 py-4 flex items-center justify-between">
            <p class="text-xs text-gray-400">Perubahan akan langsung berlaku di seluruh halaman website.</p>
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Website Settings
            </button>
        </div>
    </div>

    </div>
</form>
</div>
@endsection

@push('scripts')
<script>
function previewImg(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
