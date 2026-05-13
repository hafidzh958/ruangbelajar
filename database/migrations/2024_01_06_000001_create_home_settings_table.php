<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel home_settings: menyimpan konten hero section & statistik halaman beranda.
 * Single-row table — hanya 1 baris yang terus di-update.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            // ---- Hero ----
            $table->string('badge_text')->nullable();
            $table->string('title')->nullable();
            $table->string('highlighted_title')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('hero_image')->nullable();     // path di storage/app/public
            // ---- Statistik ----
            $table->unsignedInteger('total_students')->default(0);
            $table->unsignedInteger('total_programs')->default(0);
            $table->unsignedInteger('total_tutors')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
