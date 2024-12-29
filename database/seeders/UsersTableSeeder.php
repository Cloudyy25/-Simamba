<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert beberapa data ke tabel users
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'username' => 'pimpinan',
                'email' => 'pimpinan@gmail.com',
                'password' => Hash::make('pimpinan'),
                'id_jabatan' => 1, // Contoh ID jabatan
                'id_tim' => null,
            ],
            [
                'id_user' => 2,
                'username' => 'penanggungjawab1',
                'email' => 'penanggungjawab1@gmail.com',
                'password' => Hash::make('penanggungjawab1'),
                'id_jabatan' => 2,
                'id_tim' => 1,
            ],
            [
                'id_user' => 3,
                'username' => 'penanggungjawab2',
                'email' => 'penanggungjawab2@gmail.com',
                'password' => Hash::make('penanggungjawab2'),
                'id_jabatan' => 2,
                'id_tim' => 2,
            ],
            [
                'id_user' => 4,
                'username' => 'penanggungjawab3',
                'email' => 'penanggungjawab3@gmail.com',
                'password' => Hash::make('penanggungjawab3'),
                'id_jabatan' => 2,
                'id_tim' => 3,
            ],
            [
                'id_user' => 5,
                'username' => 'penanggungjawab4',
                'email' => 'penanggungjawab4@gmail.com',
                'password' => Hash::make('penanggungjawab4'),
                'id_jabatan' => 2,
                'id_tim' => 4,
            ],
            [
                'id_user' => 6,
                'username' => 'penanggungjawab5',
                'email' => 'penanggungjawab5@gmail.com',
                'password' => Hash::make('penanggungjawab5'),
                'id_jabatan' => 2,
                'id_tim' => 5,
            ],
            [
                'id_user' => 7,
                'username' => 'penanggungjawab6',
                'email' => 'penanggungjawab6@gmail.com',
                'password' => Hash::make('penanggungjawab6'),
                'id_jabatan' => 2,
                'id_tim' => 6,
            ],
            [
                'id_user' => 8,
                'username' => 'penanggungjawab7',
                'email' => 'penanggungjawab7@gmail.com',
                'password' => Hash::make('penanggungjawab7'),
                'id_jabatan' => 2,
                'id_tim' => 7,
            ],
            [
                'id_user' => 9,
                'username' => 'anggota',
                'email' => 'anggota@gmail.com',
                'password' => Hash::make('anggota'),
                'id_jabatan' => 3,
                'id_tim' => null,
            ],
        ]);
    }
}
