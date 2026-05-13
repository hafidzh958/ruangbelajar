@extends('admin.layouts.app')
@section('title', 'Tentang Kami')
@section('page-title', 'CMS Tentang Kami')
@section('breadcrumb', 'Kelola konten halaman Tentang Kami')

@section('content')
<div class="space-y-8">

{{-- SECTION 1: HERO + VISI MISI --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="hero">
    <div class="flex items-center gap-3 px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
        <div class="w-8 h-8 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/></svg>
        </div>
        <div>
            <h2 class="font-semibold text-gray-800 text-sm">Hero Section & Visi Misi</h2>
            <p class="text-xs text-gray-400">Teks utama halaman, visi, dan misi</p>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.tentang.setting.update') }}" enctype="multipart/form-data" id="setting-form">
        @csrf @method('PUT')
        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Badge Text</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $setting->badge_text) }}" placeholder="Legacy & Vision"
                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Utama <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $setting->title) }}" placeholder="Membangun Masa Depan"
                           class="w-full px-3.5 py-2.5 border @error('title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul Highlight <span class="text-red-400">*</span></label>
                    <input type="text" name="highlighted_title" value="{{ old('highlighted_title', $setting->highlighted_title) }}" placeholder="Bersama Kami."
                           class="w-full px-3.5 py-2.5 border @error('highlighted_title') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                    @error('highlighted_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi Hero <span class="text-red-400">*</span></label>
                    <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 border @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none">{{ old('description', $setting->description) }}</textarea>
                    @error('description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar Hero / About</label>
                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-4 text-center hover:border-brand-400 transition" id="about-drop-zone">
                    <div id="about-preview-wrap" class="{{ $setting->hero_image ? '' : 'hidden' }} mb-4">
                        <img id="about-preview-img" src="{{ $setting->hero_image ? asset('storage/'.$setting->hero_image) : '' }}" alt="Preview" class="mx-auto max-h-48 rounded-xl object-cover shadow">
                        <p class="text-xs text-gray-400 mt-2">Gambar saat ini</p>
                    </div>
                    <div id="about-placeholder" class="{{ $setting->hero_image ? 'hidden' : '' }}">
                        <svg class="w-10 h-10 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm text-gray-400">Klik atau drag & drop gambar</p>
                    </div>
                    <input type="file" name="hero_image" id="hero_image" accept="image/*" class="hidden"
                           onchange="previewImage(this,'about-preview-img','about-preview-wrap','about-placeholder')">
                    <button type="button" onclick="document.getElementById('hero_image').click()"
                            class="mt-3 px-4 py-2 text-xs font-medium text-brand-600 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                        {{ $setting->hero_image ? 'Ganti Gambar' : 'Pilih Gambar' }}
                    </button>
                    <p class="text-xs text-gray-400 mt-2">JPG, PNG, WebP — maks. 2MB</p>
                    @error('hero_image')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- VISI MISI --}}
        <div class="px-6 pb-4">
            <div class="border-t border-gray-100 pt-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="text-lg">🎯</span> Visi & Misi
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-blue-50 rounded-2xl p-5 space-y-3">
                        <p class="text-sm font-bold text-blue-700 flex items-center gap-2">👁 Visi</p>
                        <div>
                            <label class="block text-xs font-semibold text-blue-600 mb-1.5">Judul Visi <span class="text-red-400">*</span></label>
                            <input type="text" name="vision_title" value="{{ old('vision_title', $setting->vision_title) }}" placeholder="Menjadi Rumah Inovasi."
                                   class="w-full px-3 py-2.5 bg-white border border-blue-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 transition">
                            @error('vision_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-blue-600 mb-1.5">Deskripsi Visi <span class="text-red-400">*</span></label>
                            <textarea name="vision_description" rows="4" class="w-full px-3 py-2.5 bg-white border border-blue-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 transition resize-none">{{ old('vision_description', $setting->vision_description) }}</textarea>
                            @error('vision_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="bg-yellow-50 rounded-2xl p-5 space-y-3">
                        <p class="text-sm font-bold text-yellow-700 flex items-center gap-2">🎯 Misi</p>
                        <div>
                            <label class="block text-xs font-semibold text-yellow-700 mb-1.5">Judul Misi <span class="text-red-400">*</span></label>
                            <input type="text" name="mission_title" value="{{ old('mission_title', $setting->mission_title) }}" placeholder="Membangun Nilai Nyata."
                                   class="w-full px-3 py-2.5 bg-white border border-yellow-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-yellow-200 transition">
                            @error('mission_title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-yellow-700 mb-1.5">Deskripsi Misi <span class="text-red-400">*</span></label>
                            <textarea name="mission_description" rows="4" class="w-full px-3 py-2.5 bg-white border border-yellow-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-yellow-200 transition resize-none">{{ old('mission_description', $setting->mission_description) }}</textarea>
                            @error('mission_description')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 pb-5 flex justify-end gap-3">
            <a href="{{ route('about') }}" target="_blank" class="px-4 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
            <button type="submit" id="setting-submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-xl transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Semua
            </button>
        </div>
    </form>
</div>

{{-- SECTION 3: PENDEKATAN BELAJAR --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden" id="pendekatan">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-lg flex items-center justify-center text-sm">🧠</div>
            <div>
                <h2 class="font-semibold text-gray-800 text-sm">Pendekatan Belajar</h2>
                <p class="text-xs text-gray-400">{{ $approaches->count() }} item · {{ $approaches->where('is_active', true)->count() }} aktif</p>
            </div>
        </div>
        <button onclick="toggleModal('modal-approach')" class="flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pendekatan
        </button>
    </div>
    <div class="overflow-x-auto">
        @if($approaches->isEmpty())
            <div class="py-16 text-center text-gray-400">
                <div class="text-4xl mb-3">🧠</div>
                <p class="text-sm font-medium">Belum ada pendekatan belajar</p>
                <p class="text-xs mt-1">Klik "Tambah Pendekatan" untuk memulai.</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Icon</th>
                        <th class="px-6 py-3 text-left">Judul & Deskripsi</th>
                        <th class="px-6 py-3 text-center">Urutan</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($approaches as $i => $item)
                    <tr class="hover:bg-gray-50 transition {{ $item->is_active ? '' : 'opacity-50' }}">
                        <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="w-9 h-9 {{ $item->icon ? 'bg-indigo-50 text-indigo-600' : 'bg-gray-100 text-gray-400' }} rounded-xl flex items-center justify-center">
                                @if($item->icon)<i class="{{ $item->icon }}"></i>@else<span class="text-xs">–</span>@endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $item->description }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-7 h-7 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold">{{ $item->sort_order }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form method="POST" action="{{ route('admin.tentang.approach.toggle', $item) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $item->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }} transition">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.tentang.approach.edit', $item) }}" class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.tentang.approach.destroy', $item) }}" onsubmit="return confirm('Hapus ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modal-approach" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-approach')"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Tambah Pendekatan Belajar</h3>
            <button onclick="toggleModal('modal-approach')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('admin.tentang.approach.store') }}" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Icon Font Awesome</label>
                    <input type="text" name="icon" placeholder="fas fa-brain" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Urutan</label>
                    <input type="number" name="sort_order" min="0" value="{{ $approaches->count() + 1 }}" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Judul <span class="text-red-400">*</span></label>
                <input type="text" name="title" required class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition resize-none"></textarea>
            </div>
            <div class="flex items-center gap-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="ap-active" value="1" checked class="w-4 h-4 text-brand-600 border-gray-300 rounded">
                <label for="ap-active" class="text-sm text-gray-600">Aktifkan langsung</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="toggleModal('modal-approach')" class="flex-1 py-2.5 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 text-sm text-white bg-brand-600 hover:bg-brand-700 font-semibold rounded-xl transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleModal(id) { const m=document.getElementById(id); m.classList.toggle('hidden'); m.classList.toggle('flex'); }
function previewImage(input,imgId,wrapId,phId) {
    if(input.files&&input.files[0]){const r=new FileReader();r.onload=e=>{document.getElementById(imgId).src=e.target.result;document.getElementById(wrapId).classList.remove('hidden');document.getElementById(phId).classList.add('hidden');};r.readAsDataURL(input.files[0]);}
}
document.getElementById('setting-form').addEventListener('submit',function(){
    const btn=document.getElementById('setting-submit');btn.disabled=true;
    btn.innerHTML=`<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan...`;
});
const dz=document.getElementById('about-drop-zone');
if(dz){dz.addEventListener('dragover',e=>{e.preventDefault();dz.classList.add('border-brand-400','bg-brand-50');});dz.addEventListener('dragleave',()=>dz.classList.remove('border-brand-400','bg-brand-50'));dz.addEventListener('drop',e=>{e.preventDefault();dz.classList.remove('border-brand-400','bg-brand-50');const f=e.dataTransfer.files[0];if(f&&f.type.startsWith('image/')){const dt=new DataTransfer();dt.items.add(f);document.getElementById('hero_image').files=dt.files;previewImage(document.getElementById('hero_image'),'about-preview-img','about-preview-wrap','about-placeholder');}});}
</script>
@endpush
