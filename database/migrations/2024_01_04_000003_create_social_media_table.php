<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel social_media: link media sosial yang dikelola admin.
 * Digunakan di footer dan halaman kontak.
 * Dipisah ke tabel sendiri agar scalable (bisa tambah platform baru kapan saja).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('platform');              // Misal: 'Instagram', 'Facebook', 'WhatsApp'
            $table->string('username')->nullable();  // Misal: '@ruangbelajar.id'
            $table->string('url');                   // URL lengkap link platform
            $table->string('icon')->nullable();      // Font Awesome class: 'fab fa-instagram'
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_media');
    }
};
