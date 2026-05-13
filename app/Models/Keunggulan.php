<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Keunggulan extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'urutan',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Hapus global scope lama agar query lebih fleksibel dari controller
    // Controller yang menentukan sorting & filter

    /** Scope: hanya yang aktif, diurutkan by sort_order */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
