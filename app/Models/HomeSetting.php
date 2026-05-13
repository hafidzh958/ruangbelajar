<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $table = 'home_settings';

    protected $fillable = [
        'badge_text',
        'title',
        'highlighted_title',
        'description',
        'button_text',
        'button_link',
        'hero_image',
        'total_students',
        'total_programs',
        'total_tutors',
    ];

    protected $casts = [
        'total_students' => 'integer',
        'total_programs' => 'integer',
        'total_tutors'   => 'integer',
    ];

    /**
     * Ambil satu-satunya record (singleton).
     * Jika belum ada, buat record default kosong.
     */
    public static function getInstance(): static
    {
        return static::first() ?? static::create([
            'badge_text'        => 'Unlock Your Future Potential',
            'title'             => 'Bukan Sekadar Belajar,',
            'highlighted_title' => 'Tapi Juara!',
            'description'       => 'Platform bimbingan belajar dengan pendekatan personal dan kurikulum adaptif.',
            'button_text'       => 'Daftar Program',
            'button_link'       => '/register',
            'total_students'    => 100,
            'total_programs'    => 5,
            'total_tutors'      => 15,
        ]);
    }
}
