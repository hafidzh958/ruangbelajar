<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel site_settings: konfigurasi global site (nama, logo, tagline, dll).
 * Menggunakan pola key-value per group — sama seperti tabel settings yang sudah ada,
 * namun dipisah untuk konten "global" (header/footer) agar lebih bersih.
 *
 * Catatan: Jika project sudah menggunakan tabel `settings` untuk hal ini,
 * pertimbangkan untuk TIDAK membuat tabel ini dan cukup tambah group baru
 * di tabel settings (misal: group = 'site', 'header', 'footer').
 * Tabel ini dibuat terpisah agar lebih eksplisit dan mudah di-cache.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();   // 'general', 'header', 'footer', 'seo'
            $table->string('key')->unique();     // Misal: 'site_name', 'site_logo', 'footer_copyright'
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // 'text', 'image', 'textarea', 'boolean'
            $table->string('label')->nullable();     // Label untuk form admin (misal: "Nama Website")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
