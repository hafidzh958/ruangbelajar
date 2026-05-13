<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel register_form_settings: konfigurasi tampilan dan teks form pendaftaran.
 * Single-row table. Pisah dari hero agar tiap seksi bisa di-edit independen.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('register_form_settings', function (Blueprint $table) {
            $table->id();
            $table->string('form_title')->nullable();           // Judul section form
            $table->string('form_highlight')->nullable();       // Kata highlight pada judul form
            $table->string('button_text')->default('Daftar Sekarang');
            $table->text('success_message')->nullable();        // Pesan setelah submit berhasil
            $table->text('whatsapp_notice')->nullable();        // Catatan WA di bawah form
            $table->text('privacy_notice')->nullable();         // Kebijakan privasi singkat
            $table->string('form_image')->nullable();           // Gambar dekoratif di sisi form
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('register_form_settings');
    }
};
