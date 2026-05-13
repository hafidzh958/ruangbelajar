<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSetting;
use App\Models\Keunggulan;

class HomeSettingSeeder extends Seeder
{
    public function run(): void
    {
        HomeSetting::create([
            'badge_text'        => 'Unlock Your Future Potential',
            'title'             => 'Bukan Sekadar Belajar,',
            'highlighted_title' => 'Tapi Juara!',
            'description'       => 'Platform bimbingan belajar dengan pendekatan personal dan kurikulum adaptif yang memastikan anak Anda berkembang pesat.',
            'button_text'       => 'Daftar Program',
            'button_link'       => '/register',
            'total_students'    => 100,
            'total_programs'    => 5,
            'total_tutors'      => 15,
        ]);

        $keunggulans = [
            ['icon' => 'fas fa-fingerprint', 'title' => 'Personal',    'description' => 'Setiap siswa memiliki porsi perhatian eksklusif dari tutor kami.',                          'sort_order' => 1],
            ['icon' => 'fas fa-cubes',       'title' => 'Logika',      'description' => 'Kami melatih cara berpikir kritis, bukan sekadar teknik menghafal paksa.',                  'sort_order' => 2],
            ['icon' => 'fas fa-heartbeat',   'title' => 'Empati',      'description' => 'Membangun hubungan kedekatan emosional antara tutor dan anak.',                             'sort_order' => 3],
            ['icon' => 'fas fa-medal',       'title' => 'Juara',       'description' => 'Membuktikan prestasi nyata dalam grafik perkembangan belajar yang terukur.',               'sort_order' => 4],
        ];

        foreach ($keunggulans as $data) {
            Keunggulan::create(array_merge($data, ['is_active' => true, 'urutan' => $data['sort_order']]));
        }

        $this->command->info('✅ HomeSettingSeeder berhasil!');
    }
}
