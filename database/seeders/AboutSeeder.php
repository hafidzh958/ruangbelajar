<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\AboutApproach;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // HERO ABOUT SECTION
        // =========================
        $heroData = [
            ['group' => 'about_hero', 'key' => 'about_hero_badge_text',        'value' => 'Tentang Kami'],
            ['group' => 'about_hero', 'key' => 'about_hero_title_line_1',      'value' => 'KAMI HADIR UNTUK'],
            ['group' => 'about_hero', 'key' => 'about_hero_title_highlight',   'value' => 'MASA DEPAN ANAK'],
            ['group' => 'about_hero', 'key' => 'about_hero_description',       'value' => 'Ruang Belajar lahir dari keyakinan bahwa setiap anak berhak mendapatkan pendidikan berkualitas yang menyenangkan dan membentuk karakter.'],
            ['group' => 'about_hero', 'key' => 'about_hero_background_image',  'value' => null],
        ];

        // =========================
        // STORY SECTION
        // =========================
        $storyData = [
            ['group' => 'about_story', 'key' => 'about_story_title',            'value' => 'Kisah Kami Berawal Dari'],
            ['group' => 'about_story', 'key' => 'about_story_highlighted_text', 'value' => 'Satu Misi'],
            ['group' => 'about_story', 'key' => 'about_story_description_1',   'value' => 'Ruang Belajar didirikan oleh sekelompok pendidik muda yang percaya bahwa belajar seharusnya menjadi pengalaman yang menyenangkan, bukan beban.'],
            ['group' => 'about_story', 'key' => 'about_story_quote_text',      'value' => '"Anak yang bahagia dalam belajar adalah anak yang siap untuk masa depan."'],
            ['group' => 'about_story', 'key' => 'about_story_description_2',   'value' => 'Berawal dari sebuah garasi kecil di Bogor pada 2020, kini Ruang Belajar telah membantu lebih dari 200 siswa mencapai prestasi terbaik mereka.'],
            ['group' => 'about_story', 'key' => 'about_story_image',           'value' => null],
        ];

        // =========================
        // VISION & MISSION SECTION
        // =========================
        $visionData = [
            ['group' => 'about_vision', 'key' => 'about_vision_title',            'value' => 'Visi Kami'],
            ['group' => 'about_vision', 'key' => 'about_vision_highlighted_text', 'value' => 'Generasi Unggul'],
            ['group' => 'about_vision', 'key' => 'about_vision_description',      'value' => 'Menjadi pusat belajar terdepan yang melahirkan generasi cerdas, berkarakter, dan siap menghadapi tantangan global.'],
            ['group' => 'about_vision', 'key' => 'about_mission_title',           'value' => 'Misi Kami'],
            ['group' => 'about_vision', 'key' => 'about_mission_highlighted_text','value' => 'Belajar Bermakna'],
            ['group' => 'about_vision', 'key' => 'about_mission_description',     'value' => 'Menyelenggarakan pendidikan berkualitas dengan metode inovatif, lingkungan belajar yang suportif, dan tenaga pengajar yang berdedikasi untuk setiap siswa.'],
        ];

        // =========================
        // STATISTICS SECTION
        // =========================
        $statsData = [
            ['group' => 'about_stats', 'key' => 'about_stats_total_siswa',       'value' => '200+'],
            ['group' => 'about_stats', 'key' => 'about_stats_total_tutor',       'value' => '10+'],
            ['group' => 'about_stats', 'key' => 'about_stats_tingkat_prestasi',  'value' => '95%'],
        ];

        // =========================
        // CTA SECTION
        // =========================
        $ctaData = [
            ['group' => 'about_cta', 'key' => 'about_cta_title',          'value' => 'Siap Mulai Kisah Sukses Baru?'],
            ['group' => 'about_cta', 'key' => 'about_cta_highlighted_text','value' => 'Kisah Sukses'],
            ['group' => 'about_cta', 'key' => 'about_cta_subtitle',       'value' => 'Bergabunglah dengan ratusan keluarga yang telah mempercayakan pendidikan anak mereka kepada Ruang Belajar.'],
            ['group' => 'about_cta', 'key' => 'about_cta_button_text',    'value' => 'Konsultasi Gratis'],
            ['group' => 'about_cta', 'key' => 'about_cta_button_link',    'value' => '/contact'],
        ];

        // Insert/update semua settings
        $allSettings = array_merge($heroData, $storyData, $visionData, $statsData, $ctaData);
        foreach ($allSettings as $item) {
            Setting::updateOrCreate(['key' => $item['key']], $item);
        }

        // =========================
        // PROBLEM vs SOLUTION
        // =========================
        $problems = [
            ['type' => 'problem', 'text' => 'Kelas terlalu besar, anak tidak diperhatikan', 'icon' => 'fas fa-times-circle', 'sort_order' => 1],
            ['type' => 'problem', 'text' => 'Metode belajar kaku dan membosankan',           'icon' => 'fas fa-times-circle', 'sort_order' => 2],
            ['type' => 'problem', 'text' => 'Tidak ada laporan perkembangan ke orang tua',  'icon' => 'fas fa-times-circle', 'sort_order' => 3],
            ['type' => 'problem', 'text' => 'Anak tidak termotivasi untuk belajar',          'icon' => 'fas fa-times-circle', 'sort_order' => 4],
        ];

        $solutions = [
            ['type' => 'solution', 'text' => 'Kelas kecil maks. 8 siswa, perhatian penuh', 'icon' => 'fas fa-check-circle', 'sort_order' => 1],
            ['type' => 'solution', 'text' => 'Metode game-based learning yang interaktif',  'icon' => 'fas fa-check-circle', 'sort_order' => 2],
            ['type' => 'solution', 'text' => 'Laporan perkembangan rutin setiap bulan',    'icon' => 'fas fa-check-circle', 'sort_order' => 3],
            ['type' => 'solution', 'text' => 'Program reward dan motivasi berkala',         'icon' => 'fas fa-check-circle', 'sort_order' => 4],
        ];

        foreach (array_merge($problems, $solutions) as $item) {
            AboutApproach::updateOrCreate(
                ['type' => $item['type'], 'text' => $item['text']],
                $item
            );
        }

        // =========================
        // TESTIMONIAL (page=about)
        // =========================
        $testimonials = [
            ['nama_orangtua' => 'Ibu Ratna',  'status' => 'Wali Murid Kelas 4 SD', 'testimonial' => 'Pendekatan tutornya sangat sabar dan personal. Anak saya yang awalnya phobia matematika, kini jadi juara kelas!', 'rating' => 5, 'urutan' => 1, 'page' => 'about'],
            ['nama_orangtua' => 'Bapak Hendra','status' => 'Wali Murid TK A',      'testimonial' => 'Ruang Belajar benar-benar berbeda. Bukan sekadar les biasa, tapi membentuk karakter anak saya secara menyeluruh.', 'rating' => 5, 'urutan' => 2, 'page' => 'about'],
            ['nama_orangtua' => 'Ibu Maya',   'status' => 'Wali Murid Kelas 6 SD', 'testimonial' => 'Alhamdulillah anak saya lulus ujian dengan nilai memuaskan. Terima kasih Ruang Belajar!', 'rating' => 5, 'urutan' => 3, 'page' => 'about'],
        ];

        foreach ($testimonials as $item) {
            Testimonial::updateOrCreate(
                ['nama_orangtua' => $item['nama_orangtua'], 'page' => 'about'],
                $item + ['is_active' => true]
            );
        }

        $this->command->info('✅ Data awal Tentang Kami berhasil di-seed!');
    }
}
