@extends('admin.layouts.app')
@section('title', 'SEO Settings')
@section('page-title', 'SEO Settings')
@section('breadcrumb', 'Kelola meta tag, Open Graph, script injection, dan robots')

@section('content')
@php
$pages = \App\Http\Controllers\Admin\SeoSettingController::PAGES;
$activeTab = request('tab', 'global');
@endphp

{{-- ===== TAB NAV ===== --}}
<div class="flex items-center gap-1 bg-white rounded-2xl border border-gray-100 shadow-sm p-1.5 mb-5 overflow-x-auto">
    @php
    $tabs = [
        'global'  => ['label'=>'SEO Global',   'icon'=>'🌐'],
        'pages'   => ['label'=>'Per Halaman',  'icon'=>'📄'],
        'scripts' => ['label'=>'Script Inject','icon'=>'💻'],
        'tools'   => ['label'=>'Tools',        'icon'=>'🔧'],
    ];
    @endphp
    @foreach($tabs as $key => $tab)
    <a href="?tab={{ $key }}"
       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition whitespace-nowrap
              {{ $activeTab===$key ? 'bg-brand-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
        <span>{{ $tab['icon'] }}</span> {{ $tab['label'] }}
    </a>
    @endforeach
</div>

{{-- ===== TAB: SEO GLOBAL ===== --}}
@if($activeTab === 'global')
<form method="POST" action="{{ route('admin.settings.seo.global') }}" enctype="multipart/form-data">
    @csrf
    <div class="space-y-5 max-w-3xl">

    {{-- Meta Dasar --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">📝</div>
            <h2 class="font-semibold text-gray-800">Meta Tag Default</h2>
        </div>
        <div class="p-6 space-y-4">
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-gray-600">Meta Title Default</label>
                    <span id="title-count" class="text-[10px] text-gray-400">0/70</span>
                </div>
                <input type="text" name="default_meta_title" id="meta-title-input"
                       value="{{ old('default_meta_title', $global['default_meta_title'] ?? '') }}"
                       maxlength="70" placeholder="Ruang Belajar | Bimbel Terbaik di Bogor"
                       oninput="countChars(this,'title-count')"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                <p class="text-[10px] text-gray-400 mt-1">Ideal: 50–60 karakter. Tampil di tab browser & hasil Google.</p>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-gray-600">Meta Description Default</label>
                    <span id="desc-count" class="text-[10px] text-gray-400">0/160</span>
                </div>
                <textarea name="default_meta_description" id="meta-desc-input" rows="3"
                          maxlength="160" oninput="countChars(this,'desc-count')"
                          placeholder="Bimbingan belajar terbaik dengan metode playful dan kelas super kecil..."
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('default_meta_description', $global['default_meta_description'] ?? '') }}</textarea>
                <p class="text-[10px] text-gray-400 mt-1">Ideal: 120–160 karakter. Tampil di bawah judul di Google.</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Meta Keywords</label>
                <input type="text" name="default_meta_keywords"
                       value="{{ old('default_meta_keywords', $global['default_meta_keywords'] ?? '') }}"
                       placeholder="bimbel bogor, les privat bogor, ruang belajar"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                <p class="text-[10px] text-gray-400 mt-1">Pisahkan dengan koma. (pengaruh kecil ke Google, lebih penting untuk Bing)</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Canonical URL</label>
                <input type="url" name="canonical_url"
                       value="{{ old('canonical_url', $global['canonical_url'] ?? config('app.url')) }}"
                       placeholder="https://www.ruangbelajar.com"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
        </div>
    </div>

    {{-- Open Graph --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-pink-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">📱</div>
            <h2 class="font-semibold text-gray-800">Open Graph / Social Preview</h2>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">OG Title</label>
                    <input type="text" name="og_title"
                           value="{{ old('og_title', $global['og_title'] ?? '') }}"
                           placeholder="Judul saat di-share di sosmed"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Twitter Card Type</label>
                    <select name="twitter_card_type"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <option value="summary" {{ ($global['twitter_card_type']??'summary')==='summary'?'selected':'' }}>summary</option>
                        <option value="summary_large_image" {{ ($global['twitter_card_type']??'')==='summary_large_image'?'selected':'' }}>summary_large_image</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">OG Description</label>
                <textarea name="og_description" rows="2"
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('og_description', $global['og_description'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">OG Image (1200×630px)</label>
                @if($global['og_image'] ?? null)
                <img src="{{ asset('storage/'.$global['og_image']) }}" class="h-20 rounded-xl mb-2 object-cover border border-gray-200">
                @endif
                <input type="file" name="og_image" accept="image/*" class="text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-pink-50 file:text-pink-600 hover:file:bg-pink-100 transition">
                <p class="text-[10px] text-gray-400 mt-1">Ukuran ideal: 1200×630px. Tampil saat link di-share di Facebook/Twitter.</p>
            </div>
        </div>
    </div>

    {{-- Robots --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-yellow-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-sm">🤖</div>
            <h2 class="font-semibold text-gray-800">Indexing & Robots</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Robots Index</label>
                    <select name="robots_index"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <option value="index" {{ ($global['robots_index']??'index')==='index'?'selected':'' }}>✅ index (izinkan Google mengindex)</option>
                        <option value="noindex" {{ ($global['robots_index']??'')==='noindex'?'selected':'' }}>🚫 noindex (sembunyikan dari Google)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Robots Follow</label>
                    <select name="robots_follow"
                            class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                        <option value="follow" {{ ($global['robots_follow']??'follow')==='follow'?'selected':'' }}>✅ follow (ikuti link di halaman)</option>
                        <option value="nofollow" {{ ($global['robots_follow']??'')==='nofollow'?'selected':'' }}>🚫 nofollow (jangan ikuti link)</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-700">
                ⚠️ Mengubah ke <strong>noindex</strong> akan menyembunyikan seluruh website dari Google. Gunakan hati-hati!
            </div>
        </div>
    </div>

    <div class="sticky bottom-4 z-10">
        <div class="bg-white/90 backdrop-blur rounded-2xl border border-gray-100 shadow-lg px-6 py-4 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan SEO Global
            </button>
        </div>
    </div>
    </div>
</form>

{{-- ===== TAB: SEO PER HALAMAN ===== --}}
@elseif($activeTab === 'pages')
<div class="space-y-5 max-w-3xl">
    @foreach($pages as $page)
    @php $pageData = $pages_data[$page] ?? []; @endphp
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white flex items-center gap-3" id="page-{{ $page }}">
            <div class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center text-xs font-bold uppercase">{{ substr($page,0,2) }}</div>
            <h2 class="font-semibold text-gray-800 capitalize">Halaman {{ ucfirst($page) }}</h2>
            <span class="ml-auto text-[10px] bg-gray-100 text-gray-500 px-2 py-1 rounded-full">/{{ $page === 'home' ? '' : $page }}</span>
        </div>
        <form method="POST" action="{{ route('admin.settings.seo.page', $page) }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-semibold text-gray-600">Meta Title</label>
                        <span class="text-[10px] text-gray-400 char-count">0/70</span>
                    </div>
                    <input type="text" name="meta_title" maxlength="70"
                           value="{{ old("meta_title", $pages_data[$page]["{$page}_meta_title"] ?? '') }}"
                           placeholder="Judul halaman {{ $page }}..."
                           oninput="countCharsEl(this)"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Meta Keywords</label>
                    <input type="text" name="meta_keywords"
                           value="{{ old("meta_keywords", $pages_data[$page]["{$page}_meta_keywords"] ?? '') }}"
                           placeholder="keyword1, keyword2"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-gray-600">Meta Description</label>
                    <span class="text-[10px] text-gray-400 char-count">0/160</span>
                </div>
                <textarea name="meta_description" rows="2" maxlength="160"
                          oninput="countCharsEl(this)"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old("meta_description", $pages_data[$page]["{$page}_meta_description"] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">OG Image (opsional)</label>
                @if($pages_data[$page]["{$page}_og_image"] ?? null)
                <img src="{{ asset('storage/'.$pages_data[$page]["{$page}_og_image"]) }}" class="h-16 rounded-xl mb-2 object-cover border border-gray-200">
                @endif
                <input type="file" name="og_image" accept="image/*" class="text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan {{ ucfirst($page) }}
                </button>
            </div>
        </form>
    </div>
    @endforeach
</div>

{{-- ===== TAB: SCRIPT INJECTION ===== --}}
@elseif($activeTab === 'scripts')
<form method="POST" action="{{ route('admin.settings.seo.scripts') }}" class="max-w-3xl">
    @csrf
    <div class="space-y-5">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-white flex items-center gap-3">
            <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-sm">💻</div>
            <div>
                <h2 class="font-semibold text-gray-800">Script Injection</h2>
                <p class="text-xs text-gray-400">Script akan otomatis di-inject di semua halaman</p>
            </div>
        </div>
        <div class="p-6 space-y-5">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Google Analytics / GA4 ID
                    <span class="text-gray-400 font-normal ml-1">(contoh: G-XXXXXXXXXX)</span>
                </label>
                <input type="text" name="google_analytics"
                       value="{{ old('google_analytics', $scripts['google_analytics'] ?? '') }}"
                       placeholder="G-XXXXXXXXXX atau UA-XXXXXXXX"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition font-mono">
                <p class="text-[10px] text-gray-400 mt-1">Hanya isi ID-nya saja. Script gtag akan di-generate otomatis.</p>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Facebook Pixel ID
                    <span class="text-gray-400 font-normal ml-1">(contoh: 123456789)</span>
                </label>
                <input type="text" name="facebook_pixel"
                       value="{{ old('facebook_pixel', $scripts['facebook_pixel'] ?? '') }}"
                       placeholder="1234567890"
                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition font-mono">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Custom &lt;head&gt; Script
                    <span class="text-gray-400 font-normal ml-1">(dimasukkan sebelum &lt;/head&gt;)</span>
                </label>
                <textarea name="custom_head_script" rows="5"
                          placeholder="<!-- Script kustom di dalam <head> -->"
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none font-mono text-xs">{{ old('custom_head_script', $scripts['custom_head_script'] ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Custom &lt;body&gt; Script
                    <span class="text-gray-400 font-normal ml-1">(dimasukkan sebelum &lt;/body&gt;)</span>
                </label>
                <textarea name="custom_body_script" rows="5"
                          placeholder="<!-- Script kustom di awal <body> -->"
                          class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none font-mono text-xs">{{ old('custom_body_script', $scripts['custom_body_script'] ?? '') }}</textarea>
            </div>

            <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 text-xs text-orange-700">
                ⚠️ <strong>Hati-hati!</strong> Script yang salah dapat merusak tampilan atau performa website. Uji terlebih dahulu di lingkungan development.
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Scripts
        </button>
    </div>
    </div>
</form>

{{-- ===== TAB: TOOLS ===== --}}
@elseif($activeTab === 'tools')
<div class="max-w-3xl space-y-5">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <span class="w-7 h-7 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center text-xs">🔧</span>
            Tools SEO
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('sitemap') }}" target="_blank"
               class="flex items-center gap-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-2xl transition border border-blue-100 group">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center text-lg">🗺️</div>
                <div>
                    <p class="font-semibold text-blue-800 text-sm">Sitemap XML</p>
                    <p class="text-xs text-blue-600">/sitemap.xml</p>
                </div>
                <svg class="w-4 h-4 text-blue-400 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
            <a href="{{ route('robots') }}" target="_blank"
               class="flex items-center gap-3 p-4 bg-gray-50 hover:bg-gray-100 rounded-2xl transition border border-gray-100 group">
                <div class="w-10 h-10 bg-gray-700 text-white rounded-xl flex items-center justify-center text-lg">🤖</div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Robots TXT</p>
                    <p class="text-xs text-gray-500">/robots.txt</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
    </div>

    {{-- SEO Preview --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-800 mb-4 text-sm">Preview Google SERP</h3>
        @php
            $previewTitle = $global['default_meta_title'] ?? config('app.name');
            $previewDesc  = $global['default_meta_description'] ?? '';
            $previewUrl   = rtrim($global['canonical_url'] ?? config('app.url'), '/');
        @endphp
        <div class="border border-gray-200 rounded-2xl p-5 bg-gray-50">
            <p class="text-xs text-green-700 font-medium mb-1">{{ $previewUrl }}</p>
            <p class="text-[17px] text-blue-700 font-medium hover:underline cursor-pointer leading-tight mb-1">{{ $previewTitle ?: 'Judul belum diisi' }}</p>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $previewDesc ?: 'Deskripsi belum diisi.' }}</p>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
function countChars(el, counterId) {
    const counter = document.getElementById(counterId);
    if (counter) counter.textContent = el.value.length + '/' + el.maxLength;
}
function countCharsEl(el) {
    const parent = el.closest('.space-y-4, .grid');
    const counter = el.parentElement?.querySelector('.char-count') || el.closest('div')?.previousElementSibling?.querySelector('.char-count');
    if (counter) counter.textContent = el.value.length + '/' + el.maxLength;
}

// Init counters
document.getElementById('meta-title-input')?.dispatchEvent(new Event('input'));
document.getElementById('meta-desc-input')?.dispatchEvent(new Event('input'));
document.querySelectorAll('[oninput="countCharsEl(this)"]').forEach(el => el.dispatchEvent(new Event('input')));
</script>
@endpush
