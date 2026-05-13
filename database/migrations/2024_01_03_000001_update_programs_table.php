<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambahkan kolom-kolom baru ke tabel programs yang sudah ada.
 *
 * Tabel programs sebelumnya hanya punya field dasar.
 * Migration ini memperkaya tabel agar bisa menampung seluruh data
 * halaman Program yang dikelola admin.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // Slug untuk URL-friendly (misal: /program/sd-achievement)
            $table->string('slug')->nullable()->unique()->after('nama_program');
            // Badge yang tampil di card (misal: "Program Unggulan", "Paling Diminati")
            $table->string('badge_text')->nullable()->after('slug');
            // Target usia (misal: "Usia 3-4 Tahun", "Kelas 1-6 SD")
            $table->string('umur_target')->nullable()->after('kategori');
            // Deskripsi singkat untuk card (berbeda dari deskripsi panjang)
            $table->string('short_description', 500)->nullable()->after('umur_target');
            // Teks & link tombol CTA per program
            $table->string('button_text')->nullable()->after('deskripsi');
            $table->string('button_link')->nullable()->after('button_text');
            // Tandai sebagai program unggulan (ditampilkan lebih menonjol)
            $table->boolean('is_featured')->default(false)->after('is_active');
            // Warna tema card (misal: 'blue', 'yellow', 'green')
            $table->string('background_theme')->nullable()->after('is_featured');
            // Status lebih detail daripada is_active (boolean)
            $table->enum('status', ['active', 'draft', 'inactive'])->default('active')->after('background_theme');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'badge_text', 'umur_target', 'short_description',
                'button_text', 'button_link', 'is_featured', 'background_theme', 'status'
            ]);
        });
    }
};
