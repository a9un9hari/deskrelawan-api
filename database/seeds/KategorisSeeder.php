<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama'              => 'Medis',
                'deskripsi'         => 'Tenaga medis',
                'warna'             => '#ff0000',
                'induk'             => 0,
                'status'            => 1
            ]
        ];
        Kategori::insert($data);
    }
}
