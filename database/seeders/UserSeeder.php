<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate(); // kosongkan tabel
        User::create([
            'role'      => 'Super Admin',
            'username'  => 'admin',
            'name'      => 'Administrator',
            'password'  => Hash::make('password'),
        ]);
        User::create([
            'role'      => 'Owner',
            'username'  => 'Rian',
            'name'      => 'Rian',
            'password'  => Hash::make('password'),
        ]);
        User::create([
            'role'      => 'Admin 1',
            'username'  => 'Novi',
            'name'      => 'Novi',
            'password'  => Hash::make('password'),
        ]);
        User::create([
            'role'      => 'Admin 2',
            'username'  => 'Siska',
            'name'      => 'Siska',
            'password'  => Hash::make('password'),
        ]);
        User::create([
            'role'      => 'Supervisor',
            'username'  => 'Rudi',
            'name'      => 'Rudi',
            'password'  => Hash::make('password'),
        ]);
        User::create([
            'role'      => 'Kepala Proyek',
            'username'  => 'kproyek',
            'name'      => 'Pa Ujang',
            'password'  => Hash::make('password'),
        ]);
    }
}
