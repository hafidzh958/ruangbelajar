<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel registrations: data siswa yang mendaftar melalui halaman pendaftaran.
 * Ini adalah tabel UTAMA — inti dari fitur register.
 * Relasi: belongs to programs (dropdown program dari tabel programs yang sudah ada).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            // ---- Data Siswa ----
            $table->string('student_name');                     // Nama lengkap siswa
            $table->unsignedTinyInteger('age')->nullable();     // Usia siswa
            $table->string('class_name')->nullable();           // Kelas saat ini (misal: "Kelas 3 SD")

            // ---- Data Orang Tua ----
            $table->string('parent_name');                      // Nama wali/orang tua
            $table->string('whatsapp', 20);                     // No. WA (format: 628xxx)

            // ---- Program yang Dipilih ----
            $table->foreignId('program_id')
                  ->nullable()                                  // Nullable: jika program dihapus, data tetap ada
                  ->constrained('programs')
                  ->onDelete('set null');

            // ---- Informasi Tambahan ----
            $table->text('notes')->nullable();                  // Catatan tambahan dari pendaftar

            // ---- Status Pipeline ----
            $table->enum('status', [
                'pending',    // Baru masuk, belum diproses
                'contacted',  // Sudah dihubungi admin via WA
                'trial',      // Sedang / sudah trial kelas
                'accepted',   // Resmi diterima
                'rejected',   // Tidak dilanjutkan
            ])->default('pending');

            // ---- Meta ----
            $table->string('source')->nullable();               // Sumber pendaftar (misal: web, instagram)
            $table->timestamp('contacted_at')->nullable();      // Waktu admin menghubungi
            $table->text('admin_notes')->nullable();            // Catatan internal admin (tidak tampil ke user)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
