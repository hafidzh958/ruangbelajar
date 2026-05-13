<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel testimonials: menyimpan ulasan dari wali murid/siswa (multiple CRUD).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('nama_orangtua');
            $table->string('status')->nullable();  // Misal: 'Wali Murid Kelas 3 SD'
            $table->text('testimonial');
            $table->string('foto')->nullable();    // Path foto di storage
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
