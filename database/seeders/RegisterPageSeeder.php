<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegisterHeroSetting;
use App\Models\RegisterBenefit;
use App\Models\RegisterFormSetting;
use App\Models\Registration;
use App\Models\NavigationMenu;
use App\Models\FooterSetting;
use App\Models\Program;

class RegisterPageSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================================
        // 1. HERO SETTING
        // ============================================================
        $hero = RegisterHeroSetting::create([
            'badge_text'      => '🎓 Pendaftaran Terbuka',
            'title_line_1'    => 'Mulai Perjalanan Belajar',
            'title_highlight' => 'Yang Menyenangkan',
            'description'     => 'Daftarkan putra-putri Anda sekarang dan rasakan pengalaman belajar '
                               . 'yang berbeda. Kelas kecil, metode playful, dan pendampingan penuh.',
            'hero_image'      => null, // Isi setelah upload gambar
        ]);

        // ============================================================
        // 2. BENEFITS (Checklist)
        // ============================================================
        $benefits = [
            ['title' => 'Kelas Super Kecil',     'description' => 'Maksimal 5 siswa per kelas agar fokus terjaga.',        'icon' => 'fa-users',          'sort_order' => 1],
            ['title' => 'Metode Playful',         'description' => 'Belajar dengan cara yang menyenangkan dan interaktif.', 'icon' => 'fa-gamepad',        'sort_order' => 2],
            ['title' => 'Konsultasi Gratis',      'description' => 'Konsultasi program dengan tim kami tanpa biaya.',       'icon' => 'fa-comments',       'sort_order' => 3],
            ['title' => 'Guru Berpengalaman',     'description' => 'Tenaga pengajar terlatih dan berpengalaman.',           'icon' => 'fa-chalkboard-teacher', 'sort_order' => 4],
            ['title' => 'Jadwal Fleksibel',       'description' => 'Pilih jadwal yang sesuai kesibukan keluarga.',          'icon' => 'fa-calendar-alt',   'sort_order' => 5],
            ['title' => 'Progress Report Berkala','description' => 'Laporan perkembangan siswa dikirim rutin ke orang tua.','icon' => 'fa-chart-line',     'sort_order' => 6],
        ];

        foreach ($benefits as $benefit) {
            RegisterBenefit::create(array_merge($benefit, [
                'register_hero_id' => $hero->id,
                'is_active'        => true,
            ]));
        }

        // ============================================================
        // 3. FORM SETTINGS
        // ============================================================
        RegisterFormSetting::create([
            'form_title'      => 'Daftar Sekarang,',
            'form_highlight'  => 'Gratis Konsultasi!',
            'button_text'     => '🚀 Kirim Pendaftaran',
            'success_message' => 'Terima kasih! Pendaftaran Anda sudah kami terima. '
                               . 'Tim Ruang Belajar akan menghubungi Anda via WhatsApp dalam 1×24 jam.',
            'whatsapp_notice' => 'Setelah mendaftar, kami akan menghubungi Anda via WhatsApp untuk konfirmasi jadwal trial gratis.',
            'privacy_notice'  => 'Data Anda aman dan tidak akan dibagikan kepada pihak ketiga.',
            'form_image'      => null,
        ]);

        // ============================================================
        // 4. DUMMY DATA PENDAFTAR
        // ============================================================
        $program = Program::first(); // Ambil program pertama yang sudah ada

        $dummyRegistrations = [
            [
                'student_name' => 'Aisyah Putri',
                'age'          => 8,
                'class_name'   => 'Kelas 2 SD',
                'parent_name'  => 'Budi Santoso',
                'whatsapp'     => '628111222333',
                'notes'        => 'Anak saya lemah di Matematika.',
                'status'       => 'pending',
            ],
            [
                'student_name' => 'Rafi Ahmad',
                'age'          => 11,
                'class_name'   => 'Kelas 5 SD',
                'parent_name'  => 'Siti Aminah',
                'whatsapp'     => '628222333444',
                'notes'        => 'Ingin persiapan ujian akhir.',
                'status'       => 'contacted',
                'contacted_at' => now()->subDays(2),
            ],
            [
                'student_name' => 'Nadia Zahara',
                'age'          => 13,
                'class_name'   => 'Kelas 7 SMP',
                'parent_name'  => 'Hendra Wijaya',
                'whatsapp'     => '628333444555',
                'notes'        => null,
                'status'       => 'trial',
            ],
            [
                'student_name' => 'Dimas Prasetyo',
                'age'          => 9,
                'class_name'   => 'Kelas 3 SD',
                'parent_name'  => 'Rina Lestari',
                'whatsapp'     => '628444555666',
                'notes'        => 'Sudah trial, orang tua tertarik lanjut.',
                'status'       => 'accepted',
            ],
        ];

        foreach ($dummyRegistrations as $reg) {
            Registration::create(array_merge($reg, [
                'program_id' => $program?->id,
                'source'     => 'web',
            ]));
        }

        // ============================================================
        // 5. NAVIGATION MENUS
        // ============================================================
        $menus = [
            ['label' => 'Beranda',    'url' => '/',         'sort_order' => 1],
            ['label' => 'Tentang',    'url' => '/about',    'sort_order' => 2],
            ['label' => 'Program',    'url' => '/program',  'sort_order' => 3],
            ['label' => 'Kontak',     'url' => '/contact',  'sort_order' => 4],
            ['label' => 'Daftar',     'url' => '/register', 'sort_order' => 5],
        ];

        foreach ($menus as $menu) {
            NavigationMenu::create(array_merge($menu, ['is_active' => true]));
        }

        // ============================================================
        // 6. FOOTER SETTINGS
        // ============================================================
        FooterSetting::create([
            'brand_name'      => 'Ruang Belajar',
            'logo'            => null,
            'description'     => 'Lembaga bimbingan belajar dengan kelas kecil, metode menyenangkan, dan pendampingan personal untuk anak SD & SMP.',
            'email'           => 'halo@ruangbelajar.id',
            'phone'           => '628111000999',
            'address'         => 'Jl. Pendidikan No. 1, Kota Anda',
            'copyright_text'  => '© ' . date('Y') . ' Ruang Belajar. All rights reserved.',
        ]);

        $this->command->info('✅ RegisterPageSeeder berhasil dijalankan!');
    }
}
