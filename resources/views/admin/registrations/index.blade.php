@extends('admin.layouts.app')
@section('title', 'Data Pendaftar')
@section('page-title', 'Data Pendaftar')
@section('breadcrumb', 'Kelola semua data calon siswa')

@section('content')
<div class="space-y-5">

{{-- ======= STAT CARDS ======= --}}
@php
$statCards = [
    ['label'=>'Total Pendaftar','val'=>$stats['total'],    'color'=>'blue',   'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
    ['label'=>'Menunggu',       'val'=>$stats['pending'],  'color'=>'yellow', 'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['label'=>'Dihubungi',      'val'=>$stats['contacted'],'color'=>'sky',    'icon'=>'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
    ['label'=>'Trial Kelas',    'val'=>$stats['trial'],    'color'=>'purple', 'icon'=>'M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
    ['label'=>'Diterima',       'val'=>$stats['accepted'], 'color'=>'green',  'icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
    ['label'=>'Tidak Lanjut',   'val'=>$stats['rejected'], 'color'=>'red',    'icon'=>'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
];
$cmap = [
    'blue'   =>['bg'=>'bg-blue-50',  'ib'=>'bg-blue-100',  'ic'=>'text-blue-600',  'vt'=>'text-blue-700'],
    'yellow' =>['bg'=>'bg-yellow-50','ib'=>'bg-yellow-100','ic'=>'text-yellow-600','vt'=>'text-yellow-700'],
    'sky'    =>['bg'=>'bg-sky-50',   'ib'=>'bg-sky-100',   'ic'=>'text-sky-600',   'vt'=>'text-sky-700'],
    'purple' =>['bg'=>'bg-purple-50','ib'=>'bg-purple-100','ic'=>'text-purple-600','vt'=>'text-purple-700'],
    'green'  =>['bg'=>'bg-green-50', 'ib'=>'bg-green-100', 'ic'=>'text-green-600', 'vt'=>'text-green-700'],
    'red'    =>['bg'=>'bg-red-50',   'ib'=>'bg-red-100',   'ic'=>'text-red-600',   'vt'=>'text-red-700'],
];
@endphp
<div class="grid grid-cols-3 lg:grid-cols-6 gap-3">
    @foreach($statCards as $sc)
    @php $c=$cmap[$sc['color']]; @endphp
    <a href="{{ route('admin.registrations.index', ['status'=>$sc['label']==='Total Pendaftar'?'':strtolower(str_replace(' ','_',$sc['label']))]) }}"
       class="{{ $c['bg'] }} rounded-2xl p-4 border border-white shadow-sm hover:shadow-md transition block">
        <div class="{{ $c['ib'] }} w-8 h-8 rounded-xl flex items-center justify-center mb-2">
            <svg class="w-4 h-4 {{ $c['ic'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sc['icon'] }}"/></svg>
        </div>
        <p class="text-xl font-bold {{ $c['vt'] }}">{{ $sc['val'] }}</p>
        <p class="text-xs text-gray-500 mt-0.5 leading-tight">{{ $sc['label'] }}</p>
    </a>
    @endforeach
</div>

{{-- ======= FILTER BAR ======= --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
    <form method="GET" action="{{ route('admin.registrations.index') }}" id="filter-form">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama / WA / email..."
                   class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition">
            <select name="status" class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                <option value="">Semua Status</option>
                @foreach($statuses as $val => $label)
                <option value="{{ $val }}" {{ request('status')==$val?'selected':'' }}>{{ $label }}</option>
                @endforeach
            </select>
            <select name="program_id" class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
                <option value="">Semua Program</option>
                @foreach($programs as $prog)
                <option value="{{ $prog->id }}" {{ request('program_id')==$prog->id?'selected':'' }}>{{ $prog->display_title }}</option>
                @endforeach
            </select>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                   class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                   class="px-3.5 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-brand-500 transition">
        </div>
        <div class="flex items-center justify-between mt-3">
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Filter
                </button>
                <a href="{{ route('admin.registrations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-semibold rounded-xl transition">Reset</a>
            </div>
            <a href="{{ route('admin.registrations.export-csv', request()->query()) }}"
               class="flex items-center gap-1.5 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-xl transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Export CSV
            </a>
        </div>
    </form>
</div>

{{-- ======= BULK ACTION BAR ======= --}}
<form method="POST" action="{{ route('admin.registrations.bulk') }}" id="bulk-form">
    @csrf
    <div id="bulk-bar" class="hidden bg-brand-50 border border-brand-200 rounded-2xl px-5 py-3 flex items-center justify-between">
        <p class="text-sm text-brand-700 font-semibold"><span id="selected-count">0</span> item dipilih</p>
        <div class="flex items-center gap-2">
            <select name="action" class="px-3 py-1.5 border border-brand-300 rounded-lg text-xs focus:outline-none">
                <option value="">Pilih Aksi</option>
                <option value="pending">→ Pending</option>
                <option value="contacted">→ Dihubungi</option>
                <option value="trial">→ Trial</option>
                <option value="accepted">→ Diterima</option>
                <option value="rejected">→ Tidak Lanjut</option>
                <option value="delete">🗑️ Hapus</option>
            </select>
            <button type="submit" onclick="return confirm('Terapkan aksi ke semua item terpilih?')"
                    class="px-4 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-lg transition">
                Terapkan
            </button>
            <button type="button" onclick="clearSelection()" class="px-3 py-1.5 text-xs text-gray-500 hover:text-gray-700">Batal</button>
        </div>
    </div>

{{-- ======= TABLE ======= --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    @if($registrations->isEmpty())
        <div class="py-20 text-center text-gray-400">
            <div class="text-5xl mb-4">📋</div>
            <p class="font-semibold text-gray-500">Belum ada data pendaftar</p>
            <p class="text-sm mt-1">Data akan muncul setelah ada yang mengisi form pendaftaran.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center">
                            <input type="checkbox" id="check-all" class="w-4 h-4 rounded text-brand-600 border-gray-300">
                        </th>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Siswa / Wali</th>
                        <th class="px-4 py-3 text-left">Program</th>
                        <th class="px-4 py-3 text-left">Kontak</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($registrations as $i => $reg)
                    @php $badge = \App\Models\Registration::STATUS_BADGES[$reg->status] ?? 'bg-gray-100 text-gray-600'; @endphp
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $reg->id }}" class="row-check w-4 h-4 rounded text-brand-600 border-gray-300">
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $registrations->firstItem() + $i }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center text-brand-700 text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($reg->student_name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $reg->student_name }}</p>
                                    <p class="text-xs text-gray-400">Wali: {{ $reg->parent_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-700 text-xs font-medium">{{ $reg->display_program }}</p>
                            @if($reg->age || $reg->class_name)
                                <p class="text-xs text-gray-400">{{ $reg->age ? $reg->age.' th' : '' }}{{ $reg->age && $reg->class_name ? ' · ' : '' }}{{ $reg->class_name }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="https://wa.me/{{ preg_replace('/\D/','',$reg->whatsapp) }}" target="_blank"
                               class="text-xs text-green-600 hover:text-green-700 font-medium flex items-center gap-1">
                                <i class="fab fa-whatsapp"></i> {{ $reg->whatsapp }}
                            </a>
                            @if($reg->email)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $reg->email }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('admin.registrations.update-status', $reg) }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                        class="text-xs font-semibold px-2.5 py-1 rounded-full border {{ $badge }} focus:outline-none cursor-pointer">
                                    @foreach($statuses as $val => $label)
                                    <option value="{{ $val }}" {{ $reg->status==$val?'selected':'' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <p class="text-xs text-gray-500">{{ $reg->created_at->format('d M Y') }}</p>
                            <p class="text-[10px] text-gray-400">{{ $reg->created_at->format('H:i') }}</p>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.registrations.show', $reg) }}"
                                   class="p-1.5 text-brand-600 hover:bg-brand-50 rounded-lg transition" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.registrations.destroy', $reg) }}"
                                      onsubmit="return confirm('Hapus pendaftar ini?')">
                                    @csrf @method('DELETE')
                                    <button class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($registrations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $registrations->links() }}
        </div>
        @endif
    @endif
</div>
</form>

</div>
@endsection

@push('scripts')
<script>
// Check-all
const checkAll = document.getElementById('check-all');
const bulkBar  = document.getElementById('bulk-bar');
const countEl  = document.getElementById('selected-count');

function updateBulkBar() {
    const checked = document.querySelectorAll('.row-check:checked').length;
    countEl.textContent = checked;
    if (checked > 0) { bulkBar.classList.remove('hidden'); bulkBar.classList.add('flex'); }
    else             { bulkBar.classList.add('hidden');    bulkBar.classList.remove('flex'); }
}

function clearSelection() {
    document.querySelectorAll('.row-check, #check-all').forEach(c => c.checked = false);
    updateBulkBar();
}

checkAll?.addEventListener('change', function() {
    document.querySelectorAll('.row-check').forEach(c => c.checked = this.checked);
    updateBulkBar();
});
document.querySelectorAll('.row-check').forEach(c => c.addEventListener('change', updateBulkBar));

// Auto-submit filter on select change
document.querySelectorAll('#filter-form select').forEach(s => {
    s.addEventListener('change', () => document.getElementById('filter-form').submit());
});
</script>
@endpush
