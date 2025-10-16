<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = 'rivian1207';

        // Contoh data 10 user
        $users = [
            ['name' => 'User One', 'email' => 'user1@example.com'],
            ['name' => 'User Two', 'email' => 'user2@example.com'],
            ['name' => 'User Three', 'email' => 'user3@example.com'],
            ['name' => 'User Four', 'email' => 'user4@example.com'],
            ['name' => 'User Five', 'email' => 'user5@example.com'],
            ['name' => 'User Six', 'email' => 'user6@example.com'],
            ['name' => 'User Seven', 'email' => 'user7@example.com'],
            ['name' => 'User Eight', 'email' => 'user8@example.com'],
            ['name' => 'User Nine', 'email' => 'user9@example.com'],
            ['name' => 'User Ten', 'email' => 'user10@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($password),
            ]);
        }
    }
}
