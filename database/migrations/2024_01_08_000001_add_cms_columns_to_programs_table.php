<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambahkan alias kolom untuk program CMS admin.
 * Kolom lama (nama_program, image, urutan) tetap ada untuk backward-compat.
 * Kolom baru (title, subtitle, thumbnail, age_range, price, sort_order) ditambahkan
 * agar form admin lebih intuitif dan sesuai spec.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            // Alias kolom yang lebih intuitif
            $table->string('title')->nullable()->after('nama_program');
            $table->string('subtitle')->nullable()->after('title');
            $table->string('thumbnail')->nullable()->after('image');   // alias image
            $table->string('age_range')->nullable()->after('umur_target'); // alias umur_target
            $table->decimal('price', 10, 0)->nullable()->after('age_range'); // harga (opsional)
            $table->unsignedSmallInteger('sort_order')->default(0)->after('urutan'); // alias urutan
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['title', 'subtitle', 'thumbnail', 'age_range', 'price', 'sort_order']);
        });
    }
};
