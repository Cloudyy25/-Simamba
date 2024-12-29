<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            ['id_jabatan' => 1, 'nama_jabatan' => 'Pimpinan'],
            ['id_jabatan' => 2, 'nama_jabatan' => 'Penanggung Jawab'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Anggota'],
        ]);
    }
}
