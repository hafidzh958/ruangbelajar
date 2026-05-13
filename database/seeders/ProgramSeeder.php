<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\ProgramFeature;
use App\Models\ProgramHighlight;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title'             => 'Bimbel Pra-TK',
                'nama_program'      => 'Bimbel Pra-TK',
                'badge_text'        => 'Program Unggulan',
                'subtitle'          => 'Eksplorasi Dunia Si Kecil',
                'age_range'         => 'Usia 2–4 Tahun',
                'umur_target'       => 'Usia 2–4 Tahun',
                'short_description' => 'Bantu si kecil mengeksplorasi dunia dengan cara menyenangkan, melatih motorik, dan membangun kepercayaan diri sejak dini.',
                'deskripsi'         => 'Bantu si kecil mengeksplorasi dunia dengan cara menyenangkan, melatih motorik, dan membangun kepercayaan diri sejak dini.',
                'icon'              => 'fas fa-shapes',
                'button_text'       => 'Tanya Program Ini',
                'button_link'       => 'https://wa.me/6283157112597',
                'is_featured'       => false,
                'is_active'         => true,
                'status'            => 'active',
                'sort_order'        => 1,
                'urutan'            => 1,
                'features'          => ['Kelas Kecil', 'Fokus Personal', 'Metode Menyenangkan', 'Laporan Psikologi'],
                'highlight'         => ['title' => 'Program disesuaikan dengan kebutuhan anak', 'description' => 'Setiap sesi dirancang sesuai perkembangan unik si kecil.'],
            ],
            [
                'title'             => 'Bimbel TK Juara',
                'nama_program'      => 'Bimbel TK Juara',
                'badge_text'        => 'Paling Diminati',
                'subtitle'          => 'Siap Masuk SD Impian',
                'age_range'         => 'SD / TK / PAUD',
                'umur_target'       => 'SD / TK / PAUD',
                'short_description' => 'Persiapan matang membaca, menulis, dan berhitung (Calistung) yang tidak membosankan untuk bekal masuk SD impian.',
                'deskripsi'         => 'Persiapan matang membaca, menulis, dan berhitung (Calistung) yang tidak membosankan untuk bekal masuk SD impian melalui metode visual kreatif.',
                'icon'              => 'fas fa-pencil-alt',
                'button_text'       => 'Konsultasi Gratis',
                'button_link'       => 'https://wa.me/6283157112597',
                'is_featured'       => true,
                'is_active'         => true,
                'status'            => 'active',
                'sort_order'        => 2,
                'urutan'            => 2,
                'features'          => ['Kelas Kecil', 'Fokus Personal', 'Metode Menyenangkan', 'Laporan Progress'],
                'highlight'         => ['title' => 'Kurikulum Fleksibel & Teruji', 'description' => 'Materi disesuaikan dengan kurikulum SD terkini dan terbukti menghasilkan prestasi.'],
            ],
            [
                'title'             => 'Bimbel Jenjang SD',
                'nama_program'      => 'Bimbel Jenjang SD',
                'badge_text'        => 'Program Unggulan',
                'subtitle'          => 'Pendampingan Akademik SD',
                'age_range'         => 'Jenjang SD',
                'umur_target'       => 'Jenjang SD',
                'short_description' => 'Pendampingan penuh tugas sekolah dan persiapan ujian dengan metode pemahaman konsep yang mendalam.',
                'deskripsi'         => 'Pendampingan penuh tugas sekolah dan persiapan ujian dengan metode pemahaman konsep yang mendalam (bukan hafalan).',
                'icon'              => 'fas fa-book-reader',
                'button_text'       => 'Tanya Program Ini',
                'button_link'       => 'https://wa.me/6283157112597',
                'is_featured'       => false,
                'is_active'         => true,
                'status'            => 'active',
                'sort_order'        => 3,
                'urutan'            => 3,
                'features'          => ['Kelas Kecil', 'Fokus Personal', 'Metode Menyenangkan', 'Strategi Ujian'],
                'highlight'         => ['title' => 'Program disesuaikan dengan kebutuhan anak', 'description' => 'Materi dan tempo belajar disesuaikan dengan kecepatan belajar masing-masing siswa.'],
            ],
        ];

        foreach ($programs as $data) {
            $features  = $data['features'];
            $highlight = $data['highlight'];
            unset($data['features'], $data['highlight']);

            $program = Program::create($data);

            foreach ($features as $i => $text) {
                ProgramFeature::create([
                    'program_id'   => $program->id,
                    'feature_text' => $text,
                    'icon'         => 'fas fa-check-circle',
                    'sort_order'   => $i + 1,
                ]);
            }

            ProgramHighlight::create([
                'program_id'  => $program->id,
                'title'       => $highlight['title'],
                'description' => $highlight['description'],
                'sort_order'  => 1,
            ]);
        }

        $this->command->info('✅ ProgramSeeder berhasil! 3 program dibuat.');
    }
}
