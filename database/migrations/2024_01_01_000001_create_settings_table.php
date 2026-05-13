<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel settings: menyimpan konten statis beranda (hero, statistik, solution, cta, footer).
 * Menggunakan pola key-value agar scalable — bisa tambah field baru tanpa ubah struktur tabel.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();  // Pengelompokan: 'hero', 'statistik', 'solution', 'cta', 'footer'
            $table->string('key')->unique();   // Kunci unik misal: 'hero_badge_text', 'footer_alamat'
            $table->text('value')->nullable(); // Nullable: gambar bisa belum diupload, teks bisa kosong
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
