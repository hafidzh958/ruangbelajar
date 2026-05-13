<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel program_highlights: menyimpan value/keunggulan utama tiap program.
 *
 * Satu Program → Banyak ProgramHighlight.
 * Berbeda dari features (checklist singkat), highlight berisi judul + deskripsi.
 * Contoh: Highlight = "Tutor Bersertifikat" + "Semua tutor kami tersertifikasi..."
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')
                  ->constrained('programs')
                  ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_highlights');
    }
};
