<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NavigationMenu extends Model
{
    protected $table = 'navigation_menus';

    protected $fillable = [
        'parent_id',
        'label',
        'url',
        'icon',
        'target',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ----------------
    // RELATIONSHIPS
    // ----------------

    /** Menu ini punya banyak sub-menu (children) */
    public function children(): HasMany
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order');
    }

    /** Menu ini milik parent menu */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    // ----------------
    // SCOPES
    // ----------------

    /** Hanya menu level atas (top-level) */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')
                     ->where('is_active', true)
                     ->orderBy('sort_order');
    }
}
