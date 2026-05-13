<?php

namespace Database\Seeders;

use App\Models\ContactCtaFeature;
use App\Models\ContactFaq;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // HERO SECTION
        // =========================
        $heroData = [
            ['group' => 'contact_hero', 'key' => 'contact_hero_badge_text',       'value' => 'Hubungi Kami'],
            ['group' => 'contact_hero', 'key' => 'contact_hero_title_line_1',     'value' => 'KAMI SIAP'],
            ['group' => 'contact_hero', 'key' => 'contact_hero_title_highlight',  'value' => 'MENDENGARKAN'],
            ['group' => 'contact_hero', 'key' => 'contact_hero_description',      'value' => 'Punya pertanyaan tentang program atau ingin konsultasi langsung? Tim kami siap membantu Anda menemukan solusi terbaik untuk anak Anda.'],
            ['group' => 'contact_hero', 'key' => 'contact_hero_background_image', 'value' => null],
        ];

        // =========================
        // WHATSAPP CTA SECTION
        // =========================
        $ctaData = [
            ['group' => 'contact_cta', 'key' => 'contact_cta_badge_text',       'value' => 'Konsultasi Gratis'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_title',            'value' => 'Konsultasi via WhatsApp'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_highlighted_text', 'value' => 'WhatsApp'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_description',      'value' => 'Langsung chat dengan tim kami. Respon cepat, ramah, dan siap membantu Anda kapan saja.'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_whatsapp_number',  'value' => '6283157112597'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_button_text',      'value' => 'Chat Sekarang di WhatsApp'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_button_link',      'value' => 'https://wa.me/6283157112597'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_status',           'value' => 'active'],
            ['group' => 'contact_cta', 'key' => 'contact_cta_image',            'value' => null],
        ];

        // =========================
        // OPERATIONAL INFO
        // =========================
        $operationalData = [
            ['group' => 'contact_operational', 'key' => 'contact_operational_title',     'value' => 'Jam Operasional'],
            ['group' => 'contact_operational', 'key' => 'contact_operational_days',      'value' => 'Senin – Sabtu'],
            ['group' => 'contact_operational', 'key' => 'contact_operational_open_time', 'value' => '08:00'],
            ['group' => 'contact_operational', 'key' => 'contact_operational_close_time','value' => '17:00'],
            ['group' => 'contact_operational', 'key' => 'contact_operational_timezone',  'value' => 'WIB'],
            ['group' => 'contact_operational', 'key' => 'contact_operational_icon',      'value' => 'fas fa-clock'],
        ];

        // =========================
        // LOCATION SECTION
        // =========================
        $locationData = [
            ['group' => 'contact_location', 'key' => 'contact_location_title',            'value' => 'Kunjungi'],
            ['group' => 'contact_location', 'key' => 'contact_location_highlighted_text', 'value' => 'Rumah Belajar Kami'],
            ['group' => 'contact_location', 'key' => 'contact_location_description',      'value' => 'Kami beralamat di lokasi yang mudah dijangkau. Kunjungi kami langsung untuk melihat fasilitas dan bertemu tim kami.'],
            ['group' => 'contact_location', 'key' => 'contact_location_address',          'value' => 'Jl. Tajur No. 12, Tajur'],
            ['group' => 'contact_location', 'key' => 'contact_location_city',             'value' => 'Bogor'],
            ['group' => 'contact_location', 'key' => 'contact_location_province',         'value' => 'Jawa Barat'],
            ['group' => 'contact_location', 'key' => 'contact_location_country',          'value' => 'Indonesia'],
            ['group' => 'contact_location', 'key' => 'contact_location_postal_code',      'value' => '16720'],
            ['group' => 'contact_location', 'key' => 'contact_location_email',            'value' => 'ruangbelajar@gmail.com'],
            ['group' => 'contact_location', 'key' => 'contact_location_phone',            'value' => '0831-5711-2597'],
            ['group' => 'contact_location', 'key' => 'contact_location_image',            'value' => null],
        ];

        // =========================
        // GOOGLE MAPS SECTION
        // Menyimpan embed URL DAN koordinat — frontend bisa pilih salah satu
        // =========================
        $mapsData = [
            ['group' => 'contact_maps', 'key' => 'contact_maps_embed_url',          'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.0...'], // Ganti dengan URL embed asli
            ['group' => 'contact_maps', 'key' => 'contact_maps_latitude',           'value' => '-6.6405'],      // Koordinat Tajur, Bogor
            ['group' => 'contact_maps', 'key' => 'contact_maps_longitude',          'value' => '106.8230'],
            ['group' => 'contact_maps', 'key' => 'contact_maps_zoom_level',         'value' => '15'],
            ['group' => 'contact_maps', 'key' => 'contact_maps_marker_title',       'value' => 'Ruang Belajar'],
            ['group' => 'contact_maps', 'key' => 'contact_maps_marker_description', 'value' => 'Bimbel Berkualitas di Bogor'],
        ];

        // Insert/update semua settings
        foreach (array_merge($heroData, $ctaData, $operationalData, $locationData, $mapsData) as $item) {
            Setting::updateOrCreate(['key' => $item['key']], $item);
        }

        // =========================
        // CTA FEATURES (Checklist)
        // =========================
        $ctaFeatures = [
            ['feature_text' => 'Bantu pilih program yang tepat untuk anak', 'icon' => 'fas fa-check-circle', 'sort_order' => 1],
            ['feature_text' => 'Info detail jadwal dan biaya',               'icon' => 'fas fa-check-circle', 'sort_order' => 2],
            ['feature_text' => 'Penjadwalan sesi trial gratis',              'icon' => 'fas fa-check-circle', 'sort_order' => 3],
            ['feature_text' => 'Konsultasi masalah belajar anak',            'icon' => 'fas fa-check-circle', 'sort_order' => 4],
        ];
        foreach ($ctaFeatures as $item) {
            ContactCtaFeature::updateOrCreate(['feature_text' => $item['feature_text']], $item);
        }

        // =========================
        // FAQ
        // =========================
        $faqs = [
            ['question' => 'Apakah ada sesi trial sebelum mendaftar?',                       'answer' => 'Ya! Kami menyediakan 1 sesi trial gratis untuk setiap calon siswa baru. Hubungi kami via WhatsApp untuk jadwal trial.',             'sort_order' => 1, 'status' => 'active'],
            ['question' => 'Berapa jumlah maksimal siswa per kelas?',                        'answer' => 'Kami membatasi maksimal 8 siswa per kelas untuk memastikan setiap anak mendapat perhatian yang cukup dari tutor.',                 'sort_order' => 2, 'status' => 'active'],
            ['question' => 'Apakah program bisa disesuaikan dengan kebutuhan anak saya?',   'answer' => 'Tentu! Kami melakukan asesmen awal untuk memahami kebutuhan setiap anak, lalu menyesuaikan materi dan pendekatan pembelajaran.', 'sort_order' => 3, 'status' => 'active'],
            ['question' => 'Bagaimana cara orang tua memantau perkembangan anak?',          'answer' => 'Kami mengirimkan laporan perkembangan bulanan kepada orang tua, termasuk hasil evaluasi, catatan tutor, dan rekomendasi.',         'sort_order' => 4, 'status' => 'active'],
            ['question' => 'Apakah ada program untuk anak yang sudah tertinggal pelajaran?','answer' => 'Ada! Program intensif kami dirancang khusus untuk membantu anak mengejar ketertinggalan dengan pendekatan personal dan sabar.',    'sort_order' => 5, 'status' => 'active'],
        ];
        foreach ($faqs as $item) {
            ContactFaq::updateOrCreate(['question' => $item['question']], $item);
        }

        // =========================
        // SOCIAL MEDIA
        // =========================
        $socials = [
            ['platform' => 'Instagram', 'username' => '@ruangbelajar.id',  'url' => 'https://instagram.com/ruangbelajar',  'icon' => 'fab fa-instagram',  'sort_order' => 1],
            ['platform' => 'Facebook',  'username' => 'Ruang Belajar',     'url' => 'https://facebook.com/ruangbelajar',   'icon' => 'fab fa-facebook-f', 'sort_order' => 2],
            ['platform' => 'WhatsApp',  'username' => '0831-5711-2597',    'url' => 'https://wa.me/6283157112597',          'icon' => 'fab fa-whatsapp',   'sort_order' => 3],
        ];
        foreach ($socials as $item) {
            SocialMedia::updateOrCreate(['platform' => $item['platform']], $item + ['is_active' => true]);
        }

        $this->command->info('✅ Data awal halaman Kontak berhasil di-seed!');
    }
}
