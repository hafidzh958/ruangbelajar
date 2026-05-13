@extends('admin.layouts.app')
@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program Baru')
@section('breadcrumb', 'Program › Tambah')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
            <h2 class="font-semibold text-gray-800">Informasi Program</h2>
        </div>
        <form method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data" id="program-form">
            @csrf
            @include('admin.program._form', ['program' => null])
        </form>
    </div>
</div>
@endsection
