<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@email.com',
                'password' => 'admin123',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => 'admin123',
                'role' => 'User',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'email_verified_at' => now(),
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
