<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Setting;
use App\Models\Testimonial;

class ProgramController extends Controller
{
    public function index()
    {
        // Konten statis (Hero, CTA Konsultasi)
        $settings = Setting::whereIn('group', ['program_hero', 'program_cta'])
            ->pluck('value', 'key');

        // Semua program aktif beserta relasi fitur & highlight
        $programs = Program::active()
            ->with(['features', 'highlights'])
            ->get();

        // Testimoni khusus halaman program (umum, tidak spesifik ke satu program)
        $testimonials = Testimonial::forProgram()->get();

        return view('user.program', compact('settings', 'programs', 'testimonials'));
    }
}
