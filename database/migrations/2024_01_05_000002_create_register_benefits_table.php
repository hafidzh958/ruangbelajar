<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel register_benefits: checklist keuntungan di halaman pendaftaran.
 * Relasi: belongs to register_hero_settings (satu hero → banyak benefit).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('register_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('register_hero_id')
                  ->constrained('register_hero_settings')
                  ->onDelete('cascade');    // Hapus hero → hapus semua benefit
            $table->string('title');                // Judul singkat benefit
            $table->text('description')->nullable(); // Deskripsi opsional
            $table->string('icon')->nullable();      // Nama icon (Font Awesome / Heroicons)
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('register_benefits');
    }
};
