<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah kolom is_active & sort_order ke tabel keunggulans.
 * Kolom urutan (lama) tetap ada untuk backward-compat, sort_order adalah alias baru.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('keunggulans', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('urutan');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('keunggulans', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'sort_order']);
        });
    }
};
