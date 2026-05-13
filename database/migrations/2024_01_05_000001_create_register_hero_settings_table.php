<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel register_hero_settings: menyimpan konten hero section halaman pendaftaran.
 * Single-row table (hanya 1 baris aktif). Pola konsisten dengan about/contact settings.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('register_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();       // Badge kecil di atas judul
            $table->string('title_line_1')->nullable();     // Baris 1 judul hero
            $table->string('title_highlight')->nullable();  // Kata yang di-highlight (warna berbeda)
            $table->text('description')->nullable();        // Paragraf deskripsi
            $table->string('hero_image')->nullable();       // Path gambar hero (storage)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('register_hero_settings');
    }
};
