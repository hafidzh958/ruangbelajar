<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AboutApproach extends Model
{
    protected $fillable = [
        'type',
        'icon',
        'title',
        'description',
        'text',       // kolom lama, tetap ada
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** Scope: hanya pendekatan belajar aktif (type bukan problem/solution) */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    /** Scope: hanya item bertipe 'problem' */
    public function scopeProblems(Builder $query): Builder
    {
        return $query->where('type', 'problem')->where('is_active', true)->orderBy('sort_order');
    }

    /** Scope: hanya item bertipe 'solution' */
    public function scopeSolutions(Builder $query): Builder
    {
        return $query->where('type', 'solution')->where('is_active', true)->orderBy('sort_order');
    }

    /** Scope: hanya pendekatan belajar (approach) */
    public function scopeApproaches(Builder $query): Builder
    {
        return $query->where('type', 'approach')->where('is_active', true)->orderBy('sort_order');
    }
}
