<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramHighlight extends Model
{
    protected $fillable = ['program_id', 'title', 'description', 'icon', 'sort_order'];

    /** Relasi ke program induknya */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
