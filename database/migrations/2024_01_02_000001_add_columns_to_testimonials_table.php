<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambahkan kolom 'page' dan 'rating' ke tabel testimonials yang sudah ada.
 *
 * Kolom 'page': membedakan testimoni untuk halaman 'beranda' vs 'about'.
 * Kolom 'rating': nilai bintang 1–5 (opsional, null = tidak pakai rating).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Kolom untuk filter per-halaman. Default 'beranda' agar data lama tetap valid.
            $table->string('page')->default('beranda')->after('is_active');
            // Kolom rating bintang, nullable agar beranda (yang tidak pakai rating) tidak terpengaruh
            $table->unsignedTinyInteger('rating')->nullable()->after('page');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['page', 'rating']);
        });
    }
};
