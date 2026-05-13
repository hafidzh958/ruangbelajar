<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menambahkan kolom program_id (nullable FK) ke tabel testimonials.
 *
 * Nullable karena testimoni bisa bersifat umum (tidak terikat program tertentu).
 * Jika diisi, berarti testimoni tersebut berkaitan dengan program spesifik.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->foreignId('program_id')
                  ->nullable()
                  ->constrained('programs')
                  ->onDelete('set null')  // Jika program dihapus, program_id di-set null (bukan hapus testimoni)
                  ->after('rating');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};
