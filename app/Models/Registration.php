<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Registration extends Model
{
    protected $table = 'registrations';

    protected $fillable = [
        'student_name', 'age', 'class_name', 'school',
        'parent_name', 'whatsapp', 'email',
        'program_id', 'selected_program',
        'notes', 'status', 'source',
        'contacted_at', 'admin_notes',
    ];

    protected $casts = [
        'contacted_at' => 'datetime',
    ];

    public const STATUSES = [
        'pending'   => 'Menunggu',
        'contacted' => 'Sudah Dihubungi',
        'trial'     => 'Trial Kelas',
        'accepted'  => 'Diterima',
        'rejected'  => 'Tidak Dilanjutkan',
    ];

    public const STATUS_COLORS = [
        'pending'   => 'warning',
        'contacted' => 'info',
        'trial'     => 'primary',
        'accepted'  => 'success',
        'rejected'  => 'danger',
    ];

    /** Tailwind badge classes per status */
    public const STATUS_BADGES = [
        'pending'   => 'bg-yellow-100 text-yellow-700 border-yellow-200',
        'contacted' => 'bg-sky-100 text-sky-700 border-sky-200',
        'trial'     => 'bg-purple-100 text-purple-700 border-purple-200',
        'accepted'  => 'bg-green-100 text-green-700 border-green-200',
        'rejected'  => 'bg-red-100 text-red-700 border-red-200',
    ];

    // ---- Accessors ----

    /** Nama tampil: student_name */
    public function getDisplayNameAttribute(): string
    {
        return $this->student_name;
    }

    /** Nomor HP: whatsapp */
    public function getDisplayPhoneAttribute(): string
    {
        return $this->whatsapp;
    }

    /** Program tampil: relasi program → text fallback */
    public function getDisplayProgramAttribute(): string
    {
        return $this->program?->display_title ?? $this->selected_program ?? '–';
    }

    /** Label status */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /** Badge classes */
    public function getStatusBadgeAttribute(): string
    {
        return self::STATUS_BADGES[$this->status] ?? 'bg-gray-100 text-gray-600';
    }

    // ---- Relationships ----

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // ---- Scopes ----

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeSearch(Builder $query, string $keyword): Builder
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('student_name', 'like', "%{$keyword}%")
              ->orWhere('parent_name', 'like', "%{$keyword}%")
              ->orWhere('whatsapp', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }
}
