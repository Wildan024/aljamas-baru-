<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seeder akun administrator awal.
     * Kredensial default: admin@aljamas.com / password
     * Wajib diubah segera setelah setup production.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@aljamas.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@aljamas.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
