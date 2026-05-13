<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel footer_settings: konten footer (alamat, email, copyright, deskripsi).
 * Single-row table. Social links ada di tabel social_media yang sudah ada.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->nullable();           // Nama brand di footer
            $table->string('logo')->nullable();                 // Logo footer (opsional berbeda dari header)
            $table->text('description')->nullable();            // Deskripsi singkat lembaga
            $table->string('email')->nullable();
            $table->string('phone')->nullable();                // No. telepon/WA
            $table->text('address')->nullable();                // Alamat lengkap
            $table->string('copyright_text')->nullable();       // Misal: "© 2025 Ruang Belajar"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
