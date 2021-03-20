<?php

namespace Database\Seeders;

use App\Models\PeminjamanBarang as ModelsPeminjamanBarang;
use Illuminate\Database\Seeder;

class PeminjamanBarang extends Seeder
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
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
            [
                'form_barang_id'    => rand(1, 5),
                'barang_id'         => rand(1, 25),
                'jumlah'            => rand(1, 3)
            ],
        ];

        foreach ($data as $key => $value) {
            ModelsPeminjamanBarang::create($value);
        }
    }
}
