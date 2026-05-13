<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutApproach;
use App\Models\AboutSetting;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        // Data dinamis dari about_settings (singleton)
        $aboutSetting = AboutSetting::getInstance();

        // Pendekatan belajar aktif (type='approach')
        $approaches = AboutApproach::where('type', 'approach')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Problem vs Solution (backward compat, tetap tersedia)
        $problems  = AboutApproach::problems()->get();
        $solutions = AboutApproach::solutions()->get();

        $testimonials = Testimonial::orderBy('created_at', 'desc')->limit(3)->get();

        return view('user.about', compact(
            'aboutSetting', 'approaches', 'problems', 'solutions', 'testimonials'
        ));
    }
}
