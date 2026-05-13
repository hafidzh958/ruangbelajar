<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel about_settings: menyimpan konten halaman Tentang Kami.
 * Single-row table — hero, visi, misi dalam satu record.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            // ---- Hero ----
            $table->string('badge_text')->nullable();
            $table->string('title')->nullable();
            $table->string('highlighted_title')->nullable();
            $table->text('description')->nullable();
            $table->string('hero_image')->nullable();
            // ---- Visi ----
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            // ---- Misi ----
            $table->string('mission_title')->nullable();
            $table->text('mission_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_settings');
    }
};
