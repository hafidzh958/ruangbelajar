<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel navigation_menus: item menu navigasi yang bisa dikelola dari admin.
 * Mendukung nested menu (parent_id) untuk dropdown.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('navigation_menus')
                  ->onDelete('cascade');    // Hapus parent → hapus child menu
            $table->string('label');                        // Teks yang tampil di menu
            $table->string('url');                          // URL tujuan (relative atau absolute)
            $table->string('icon')->nullable();             // Icon opsional
            $table->string('target')->default('_self');     // '_self' atau '_blank'
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
