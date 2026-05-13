<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * AdminSeeder: Buat akun admin default untuk pertama kali.
 * Jalankan: php artisan db:seed --class=AdminSeeder
 *
 * ⚠️ Ganti password di bawah sebelum deploy ke production!
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ruangbelajar.id'],
            [
                'name'     => 'Admin Ruang Belajar',
                'email'    => 'admin@ruangbelajar.id',
                'password' => Hash::make('admin123'),  // ⚠️ Ganti di production!
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat!');
        $this->command->info('   Email    : admin@ruangbelajar.id');
        $this->command->info('   Password : admin123');
        $this->command->warn('   ⚠️  Jangan lupa ganti password setelah login pertama kali!');
    }
}
