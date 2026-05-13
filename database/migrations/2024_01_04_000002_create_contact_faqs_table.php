<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel contact_faqs: pertanyaan yang sering diajukan (FAQ).
 * Admin bisa tambah, edit, hapus, dan atur urutan FAQ secara bebas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->enum('status', ['active', 'draft'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_faqs');
    }
};
