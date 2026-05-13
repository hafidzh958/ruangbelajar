<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use App\Models\Keunggulan;
use App\Models\Program;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Data dinamis dari home_settings (singleton)
        $homeSetting  = HomeSetting::getInstance();

        // Hanya keunggulan aktif, diurutkan by sort_order
        $keunggulans  = Keunggulan::active()->get();

        // Program & testimoni tetap dari tabel masing-masing
        $programs     = Program::active()->get();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->limit(6)->get();

        return view('user.home', compact('homeSetting', 'keunggulans', 'programs', 'testimonials'));
    }
}
