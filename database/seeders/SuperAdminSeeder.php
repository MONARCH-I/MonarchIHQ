<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'monarch@monarchi.com.gh'],
            [
                'name' => 'Monarch Super Admin',
                'password' => Hash::make('HuNyansa7819!'),
                'is_super_admin' => true,
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
