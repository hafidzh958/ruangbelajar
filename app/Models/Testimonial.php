<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'nama_orangtua', 'status', 'testimonial',
        'foto', 'urutan', 'is_active', 'page', 'rating', 'program_id',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'rating'     => 'integer',
        'program_id' => 'integer',
    ];

    // ----------------
    // RELATIONSHIPS
    // ----------------

    /** Testimoni bisa terkait dengan program tertentu (opsional/nullable) */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // ----------------
    // LOCAL SCOPES
    // ----------------

    /** Tampilkan hanya testimoni untuk halaman beranda */
    public function scopeBeranda($query)
    {
        return $query->where('page', 'beranda')->where('is_active', true)->orderBy('urutan');
    }

    /** Tampilkan hanya testimoni untuk halaman tentang kami */
    public function scopeAbout($query)
    {
        return $query->where('page', 'about')->where('is_active', true)->orderBy('urutan');
    }

    /** Tampilkan testimoni untuk halaman program (bisa filter per program_id) */
    public function scopeForProgram($query, ?int $programId = null)
    {
        $q = $query->where('page', 'program')->where('is_active', true);
        if ($programId) {
            $q->where('program_id', $programId);
        }
        return $q->orderBy('urutan');
    }
}
