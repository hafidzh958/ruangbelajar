<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterFormSetting extends Model
{
    protected $table = 'register_form_settings';

    protected $fillable = [
        'form_title',
        'form_highlight',
        'button_text',
        'success_message',
        'whatsapp_notice',
        'privacy_notice',
        'form_image',
    ];

    // ----------------
    // HELPERS
    // ----------------

    /**
     * Ambil satu-satunya record form setting (singleton pattern).
     * Jika belum ada, buat dengan default.
     */
    public static function firstOrCreate(): static
    {
        return static::first() ?? static::create([
            'button_text' => 'Daftar Sekarang',
        ]);
    }
}
