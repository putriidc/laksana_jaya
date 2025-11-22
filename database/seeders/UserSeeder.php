<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'role'      => 'admin',
            'username'  => 'admin',
            'name'      => 'Administrator',
            'email'     => 'admin@example.com', // boleh null kalau tidak dipakai
            'password'  => Hash::make('password'),
        ]);
    }
}
