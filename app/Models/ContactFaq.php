<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactFaq extends Model
{
    protected $fillable = ['question', 'answer', 'sort_order', 'status', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->where('status', 'active')->orWhere('is_active', true);
        })->orderBy('sort_order');
    }
}
