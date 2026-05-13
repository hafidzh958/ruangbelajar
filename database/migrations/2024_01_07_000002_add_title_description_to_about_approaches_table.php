<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah kolom title & description ke about_approaches.
 * Kolom text (lama) tetap ada untuk backward-compat.
 * Pendekatan belajar (approach) membutuhkan title + description terpisah.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_approaches', function (Blueprint $table) {
            $table->string('title')->nullable()->after('type');
            $table->text('description')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('about_approaches', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
        });
    }
};
