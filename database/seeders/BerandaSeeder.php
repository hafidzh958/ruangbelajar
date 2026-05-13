<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Keunggulan;
use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class BerandaSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // HERO SECTION
        // =====================
        $heroData = [
            ['group' => 'hero', 'key' => 'hero_badge_text',    'value' => 'Pendaftaran Periode 2024'],
            ['group' => 'hero', 'key' => 'hero_title_line_1',  'value' => 'BUKAN SEKADAR'],
            ['group' => 'hero', 'key' => 'hero_title_highlight','value' => 'BELAJAR,'],
            ['group' => 'hero', 'key' => 'hero_title_line_2',  'value' => 'TAPI BERKEMBANG'],
            ['group' => 'hero', 'key' => 'hero_description',   'value' => 'Program bimbingan belajar berkualitas untuk anak-anak usia TK hingga SD dengan metode yang menyenangkan dan hasil yang terbukti.'],
            ['group' => 'hero', 'key' => 'hero_button_1_text', 'value' => 'Daftar Sekarang'],
            ['group' => 'hero', 'key' => 'hero_button_1_link', 'value' => '/register'],
            ['group' => 'hero', 'key' => 'hero_button_2_text', 'value' => 'Lihat Program'],
            ['group' => 'hero', 'key' => 'hero_button_2_link', 'value' => '/program'],
            ['group' => 'hero', 'key' => 'hero_image',         'value' => null],
        ];

        // =====================
        // STATISTIK SECTION
        // =====================
        $statistikData = [
            ['group' => 'statistik', 'key' => 'statistik_jumlah_siswa',      'value' => '200+'],
            ['group' => 'statistik', 'key' => 'statistik_jumlah_tutor',      'value' => '10+'],
            ['group' => 'statistik', 'key' => 'statistik_peningkatan_hasil', 'value' => '95%'],
        ];

        // =====================
        // SOLUTION SECTION
        // =====================
        $solutionData = [
            ['group' => 'solution', 'key' => 'solution_title',       'value' => 'Solusi Belajar yang Tepat'],
            ['group' => 'solution', 'key' => 'solution_subtitle',    'value' => 'Kenapa Ruang Belajar?'],
            ['group' => 'solution', 'key' => 'solution_description', 'value' => 'Kami hadir sebagai solusi bimbingan belajar yang tidak hanya fokus pada nilai, tapi juga pada karakter dan kepercayaan diri anak.'],
            ['group' => 'solution', 'key' => 'solution_image',       'value' => null],
            ['group' => 'solution', 'key' => 'solution_checklist_1', 'value' => 'Kelas kecil maksimal 8 siswa'],
            ['group' => 'solution', 'key' => 'solution_checklist_2', 'value' => 'Tutor berpengalaman & bersertifikat'],
            ['group' => 'solution', 'key' => 'solution_checklist_3', 'value' => 'Metode belajar yang menyenangkan'],
            ['group' => 'solution', 'key' => 'solution_checklist_4', 'value' => 'Laporan perkembangan rutin ke orang tua'],
        ];

        // =====================
        // CTA SECTION
        // =====================
        $ctaData = [
            ['group' => 'cta', 'key' => 'cta_title',       'value' => 'Siap Mulai Perjalanan Belajar?'],
            ['group' => 'cta', 'key' => 'cta_subtitle',    'value' => 'Daftarkan putra/putri Anda sekarang dan rasakan perbedaannya.'],
            ['group' => 'cta', 'key' => 'cta_button_text', 'value' => 'Konsultasi Gratis'],
            ['group' => 'cta', 'key' => 'cta_button_link', 'value' => '/contact'],
        ];

        // =====================
        // FOOTER SECTION
        // =====================
        $footerData = [
            ['group' => 'footer', 'key' => 'footer_alamat',    'value' => 'Tajur, Bogor Selatan, Kota Bogor, Jawa Barat'],
            ['group' => 'footer', 'key' => 'footer_whatsapp',  'value' => '0831-5711-2597'],
            ['group' => 'footer', 'key' => 'footer_instagram', 'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_facebook',  'value' => '#'],
            ['group' => 'footer', 'key' => 'footer_copyright', 'value' => '© 2024 Ruang Belajar. Seluruh Hak Cipta Dilindungi.'],
        ];

        // Merge semua data dan insert/update ke database
        $allSettings = array_merge($heroData, $statistikData, $solutionData, $ctaData, $footerData);
        foreach ($allSettings as $item) {
            Setting::updateOrCreate(['key' => $item['key']], $item);
        }

        // =====================
        // KEUNGGULAN (DATA AWAL)
        // =====================
        $keunggulans = [
            ['icon' => 'fas fa-users', 'title' => 'Kelas Kecil & Personal',    'description' => 'Maksimal 8 siswa per kelas agar setiap anak mendapat perhatian penuh dari tutor.', 'urutan' => 1],
            ['icon' => 'fas fa-star',  'title' => 'Tutor Berpengalaman',       'description' => 'Semua tutor kami telah terseleksi ketat dengan pengalaman mengajar minimal 2 tahun.', 'urutan' => 2],
            ['icon' => 'fas fa-heart', 'title' => 'Metode Menyenangkan',       'description' => 'Belajar tidak harus membosankan. Kami menggabungkan edukasi dengan permainan interaktif.', 'urutan' => 3],
            ['icon' => 'fas fa-chart-line', 'title' => 'Terbukti Meningkatkan Nilai', 'description' => '95% siswa kami mengalami peningkatan nilai signifikan dalam 3 bulan pertama.', 'urutan' => 4],
        ];
        foreach ($keunggulans as $item) {
            Keunggulan::updateOrCreate(['title' => $item['title']], $item);
        }

        // =====================
        // PROGRAM (DATA AWAL)
        // =====================
        $programs = [
            ['nama_program' => 'Pra-TK Special', 'kategori' => 'Pra-TK', 'deskripsi' => 'Program stimulasi tumbuh kembang optimal untuk si kecil usia 3-4 tahun.', 'icon' => 'fas fa-baby', 'urutan' => 1],
            ['nama_program' => 'TK Full-Fun',    'kategori' => 'TK',     'deskripsi' => 'Belajar sambil bermain dengan metode yang terstruktur dan menyenangkan untuk TK A & B.', 'icon' => 'fas fa-laugh', 'urutan' => 2],
            ['nama_program' => 'SD Achievement', 'kategori' => 'SD',     'deskripsi' => 'Penguatan akademik seluruh mata pelajaran untuk siswa SD kelas 1-6.', 'icon' => 'fas fa-book-open', 'urutan' => 3],
            ['nama_program' => 'Private Tutor',  'kategori' => 'Private','deskripsi' => 'Sesi belajar 1-on-1 eksklusif yang disesuaikan penuh dengan kebutuhan dan jadwal anak.', 'icon' => 'fas fa-user-graduate', 'urutan' => 4],
        ];
        foreach ($programs as $item) {
            Program::updateOrCreate(['nama_program' => $item['nama_program']], $item);
        }

        // =====================
        // TESTIMONI (DATA AWAL)
        // =====================
        $testimonials = [
            ['nama_orangtua' => 'Ibu Sari',  'status' => 'Wali Murid Kelas 2 SD', 'testimonial' => 'Sejak masuk Ruang Belajar, nilai rapor anak saya meningkat drastis. Yang lebih penting, ia sekarang SUKA belajar!', 'urutan' => 1],
            ['nama_orangtua' => 'Bapak Rudi', 'status' => 'Wali Murid TK B',      'testimonial' => 'Tutornya sabar dan kreatif. Anak saya yang tadinya susah fokus, sekarang bisa duduk belajar 1 jam penuh.', 'urutan' => 2],
            ['nama_orangtua' => 'Ibu Dewi',  'status' => 'Wali Murid Kelas 5 SD', 'testimonial' => 'Kelas kecilnya sangat membantu. Anak saya tidak takut lagi bertanya kalau tidak paham.', 'urutan' => 3],
        ];
        foreach ($testimonials as $item) {
            Testimonial::updateOrCreate(['nama_orangtua' => $item['nama_orangtua']], $item);
        }

        $this->command->info('✅ Data awal beranda berhasil di-seed!');
    }
}
