<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tims')->insert([
            ['id_tim' => 1, 'nama_tim' => 'Tim Survei Rumah Tangga'],
            ['id_tim' => 2, 'nama_tim' => 'Tim Pengolahan, TI, Manajemen Lapangan dan Mitra'],
            ['id_tim' => 3, 'nama_tim' => 'Tim Neraca Analisis Statistik'],
            ['id_tim' => 4, 'nama_tim' => 'Tim Sensus'],
            ['id_tim' => 5, 'nama_tim' => 'Tim Diseminasi dan Statistik Sektoral'],
            ['id_tim' => 6, 'nama_tim' => 'Tim Distribusi dan Perusahaan'],
            ['id_tim' => 7, 'nama_tim' => 'Tim Statistik Pertanian, Industri dan PEK'],
        ]);
    }
}
