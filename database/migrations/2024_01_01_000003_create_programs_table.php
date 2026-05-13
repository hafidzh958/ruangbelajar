<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel programs: menyimpan daftar program bimbingan belajar (multiple CRUD).
 * Catatan: tabel ini BERBEDA dari tabel program yang sudah ada (jika ada).
 * Pastikan nama tabel tidak konflik.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('kategori')->nullable();    // Misal: 'SD', 'SMP', 'TK'
            $table->text('deskripsi');
            $table->string('icon')->nullable();        // Nama icon Font Awesome
            $table->string('image')->nullable();       // Path gambar di storage
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true); // Toggle tampil/sembunyi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
