<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $fillable = [
        // Kolom lama (backward compat)
        'nama_program', 'slug', 'kategori', 'badge_text', 'umur_target',
        'short_description', 'deskripsi', 'icon', 'image',
        'button_text', 'button_link', 'is_featured', 'background_theme',
        'urutan', 'is_active', 'status',
        // Kolom baru (admin CMS)
        'title', 'subtitle', 'thumbnail', 'age_range', 'price', 'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    // ---- Accessors: baca kolom baru, fallback ke lama ----

    /** Nama tampil: title (baru) → nama_program (lama) */
    public function getDisplayTitleAttribute(): string
    {
        return $this->title ?: ($this->nama_program ?: '–');
    }

    /** Deskripsi tampil: short_description → deskripsi */
    public function getDisplayDescriptionAttribute(): string
    {
        return $this->short_description ?: ($this->deskripsi ?: '');
    }

    /** Gambar tampil: thumbnail → image */
    public function getDisplayImageAttribute(): ?string
    {
        return $this->thumbnail ?: $this->image;
    }

    /** Rentang usia tampil: age_range → umur_target */
    public function getDisplayAgeRangeAttribute(): ?string
    {
        return $this->age_range ?: $this->umur_target;
    }

    /** Urutan tampil: sort_order → urutan */
    public function getDisplaySortOrderAttribute(): int
    {
        return $this->sort_order ?: $this->urutan;
    }

    // ---- BOOT: Auto-generate slug ----
    protected static function booted(): void
    {
        static::creating(function (Program $program) {
            // Sync title ↔ nama_program
            if (empty($program->nama_program) && $program->title) {
                $program->nama_program = $program->title;
            }
            if (empty($program->title) && $program->nama_program) {
                $program->title = $program->nama_program;
            }
            if (empty($program->slug)) {
                $program->slug = Str::slug($program->title ?: $program->nama_program);
            }
            // Sync urutan ↔ sort_order
            if ($program->sort_order && !$program->urutan) {
                $program->urutan = $program->sort_order;
            }
        });

        static::updating(function (Program $program) {
            if ($program->isDirty('title') && $program->title) {
                $program->nama_program = $program->title;
                $program->slug = Str::slug($program->title);
            }
            if ($program->isDirty('sort_order')) {
                $program->urutan = $program->sort_order;
            }
        });
    }

    // ---- RELATIONSHIPS ----

    public function features(): HasMany
    {
        return $this->hasMany(ProgramFeature::class)->orderBy('sort_order');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(ProgramHighlight::class)->orderBy('sort_order');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    // ---- SCOPES ----

    /** Program aktif untuk frontend */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->orderByRaw('COALESCE(sort_order, urutan, 0) ASC');
    }

    /** Program featured */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }
}
