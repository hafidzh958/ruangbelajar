<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $table = 'footer_settings';

    protected $fillable = [
        'brand_name', 'logo', 'description', 'footer_description',
        'email', 'phone', 'address', 'copyright_text',
        'footer_cta_title', 'footer_cta_subtitle',
        'footer_cta_button_text', 'footer_cta_button_url',
    ];

    /**
     * Singleton pattern — selalu pakai record pertama.
     */
    public static function getInstance(): static
    {
        return static::firstOrNew([]);
    }
}
