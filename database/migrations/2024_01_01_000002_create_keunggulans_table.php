<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel keunggulans: menyimpan cards keunggulan/values (multiple CRUD).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keunggulans', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();        // Nama icon Font Awesome misal: 'fas fa-star'
            $table->string('title');
            $table->text('description');
            $table->unsignedSmallInteger('urutan')->default(0); // Urutan tampil di halaman
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keunggulans');
    }
};
