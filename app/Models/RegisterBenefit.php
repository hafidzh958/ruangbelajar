<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisterBenefit extends Model
{
    protected $table = 'register_benefits';

    protected $fillable = [
        'register_hero_id',
        'title',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ----------------
    // RELATIONSHIPS
    // ----------------

    /** Benefit milik satu hero setting */
    public function heroSetting(): BelongsTo
    {
        return $this->belongsTo(RegisterHeroSetting::class, 'register_hero_id');
    }

    // ----------------
    // SCOPES
    // ----------------

    /** Hanya benefit yang aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
