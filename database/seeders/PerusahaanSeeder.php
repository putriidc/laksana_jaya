<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perusahaan;

class PerusahaanSeeder extends Seeder
{
    public function run()
    {
        Perusahaan::create([
            'kode_perusahaan' => 'PR-0001',
            'nama_perusahaan' => 'CV. ARN GUMILANG',
            'created_by' => 'system',
        ]);

        Perusahaan::create([
            'kode_perusahaan' => 'PR-0002',
            'nama_perusahaan' => 'CV. ARN PURNAMA CONSULTAN',
            'created_by' => 'system',
        ]);
        Perusahaan::create([
            'kode_perusahaan' => 'PR-0003',
            'nama_perusahaan' => 'CV. Bakti Perdana',
            'created_by' => 'system',
        ]);
    }
}

