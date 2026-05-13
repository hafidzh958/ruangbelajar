<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel contact_cta_features: checklist benefit pada bagian WhatsApp CTA.
 * Contoh: "Bantu pilih program", "Info biaya", "Trial gratis"
 * Relasi One-to-Many: satu CTA punya banyak fitur.
 * (CTA induknya disimpan di tabel settings, tabel ini hanya untuk item listnya)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_cta_features', function (Blueprint $table) {
            $table->id();
            $table->string('feature_text');
            $table->string('icon')->nullable(); // Font Awesome class
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_cta_features');
    }
};
