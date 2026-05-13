<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ContactCtaFeature;
use App\Models\ContactFaq;
use App\Models\Setting;
use App\Models\SocialMedia;

class ContactController extends Controller
{
    public function index()
    {
        // Ambil settings dari grup contact (legacy + baru)
        $settings = Setting::whereIn('group', [
            'contact_hero', 'contact_cta', 'contact_operational',
            'contact_location', 'contact_maps', 'contact_info',
        ])->pluck('value', 'key');

        $ctaFeatures = ContactCtaFeature::active()->get();
        $faqs        = ContactFaq::active()->get();
        $socials     = SocialMedia::active()->get();

        return view('user.contact', compact('settings', 'ctaFeatures', 'faqs', 'socials'));
    }
}
