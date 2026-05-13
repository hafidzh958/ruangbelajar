<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambah kolom CMS ke footer_settings dan contact_settings.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom ke footer_settings
        Schema::table('footer_settings', function (Blueprint $table) {
            $table->text('footer_description')->nullable()->after('description');
            $table->string('footer_cta_title')->nullable()->after('copyright_text');
            $table->string('footer_cta_subtitle')->nullable()->after('footer_cta_title');
            $table->string('footer_cta_button_text')->nullable()->after('footer_cta_subtitle');
            $table->string('footer_cta_button_url')->nullable()->after('footer_cta_button_text');
        });

        // Tambah kolom is_active ke contact_faq jika belum ada
        if (!Schema::hasColumn('contact_faqs', 'is_active')) {
            Schema::table('contact_faqs', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            });
        }

        // Tambah kolom ke contact_cta_features jika kurang
        if (Schema::hasTable('contact_cta_features')) {
            if (!Schema::hasColumn('contact_cta_features', 'subtitle')) {
                Schema::table('contact_cta_features', function (Blueprint $table) {
                    $table->string('subtitle')->nullable()->after('feature_text');
                    $table->string('button_text')->nullable()->after('subtitle');
                    $table->string('button_url')->nullable()->after('button_text');
                    $table->string('image')->nullable()->after('button_url');
                });
            }
        }
    }

    public function down(): void
    {
        Schema::table('footer_settings', function (Blueprint $table) {
            $table->dropColumn([
                'footer_description', 'footer_cta_title', 'footer_cta_subtitle',
                'footer_cta_button_text', 'footer_cta_button_url',
            ]);
        });
    }
};
