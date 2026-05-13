<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel program_features: menyimpan checklist/fitur tiap program (relasi One-to-Many).
 *
 * Satu Program → Banyak ProgramFeature.
 * Admin bisa tambah/hapus checklist per program secara bebas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_features', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel programs
            $table->foreignId('program_id')
                  ->constrained('programs')
                  ->onDelete('cascade'); // Hapus otomatis jika program dihapus
            $table->string('feature_text');            // Teks fitur, misal: "Kelas kecil maks. 8 siswa"
            $table->string('icon')->nullable();        // Nama icon Font Awesome
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_features');
    }
};
