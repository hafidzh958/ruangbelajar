<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah kolom tambahan ke registrations untuk CMS admin lengkap.
 * Kolom lama (student_name, whatsapp, dll) tetap ada.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('email')->nullable()->after('whatsapp');
            $table->string('school')->nullable()->after('class_name');  // asal sekolah
            $table->string('selected_program')->nullable()->after('school'); // nama program (text fallback)
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['email', 'school', 'selected_program']);
        });
    }
};
