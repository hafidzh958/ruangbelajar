<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel about_approaches: menyimpan item Problem vs Solution section (dynamic CRUD).
 *
 * Kolom 'type': membedakan antara 'problem' (masalah umum) dan 'solution' (solusi kami).
 * Admin bisa tambah, ubah, hapus, dan atur urutan masing-masing item secara bebas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_approaches', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['problem', 'solution']); // 'problem' atau 'solution'
            $table->string('text');                         // Teks item
            $table->string('icon')->nullable();             // Icon Font Awesome, misal: 'fas fa-times'
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_approaches');
    }
};
