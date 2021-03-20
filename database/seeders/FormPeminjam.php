<?php

namespace Database\Seeders;

use App\Models\FormBarang;
use Illuminate\Database\Seeder;

class FormPeminjam extends Seeder
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
                'nama_peminjam'         => 'Muhammad Ikhbal',
                'nim'                   => '118140123',
                'email'                 => 'muhammad.118140123@student.itera.ac.id',
                'no_hp'                 => '082246105525',
                'afiliasi'              => 'Teknik Informatika',
                'tanggal_peminjaman'    => '2021-03-17',
                'tanggal_pengembalian'  => '2021-03-19',
            ],
            [
                'nama_peminjam'         => 'Annisa Dwi Atika',
                'nim'                   => '118140082',
                'email'                 => 'annisa.118140082@student.itera.ac.id',
                'no_hp'                 => '36737373252',
                'afiliasi'              => 'Teknik Informatika',
                'tanggal_peminjaman'    => '2021-03-18',
                'tanggal_pengembalian'  => '2021-03-19',
            ],
            [
                'nama_peminjam'         => 'Ezra',
                'nim'                   => '118140525',
                'email'                 => 'ezra.118140123@student.itera.ac.id',
                'no_hp'                 => '0822346105525',
                'afiliasi'              => 'Teknik Industri',
                'tanggal_peminjaman'    => '2021-03-17',
                'tanggal_pengembalian'  => '2021-03-19',
            ],
            [
                'nama_peminjam'         => 'Ackyra',
                'nim'                   => '118140363',
                'email'                 => 'ackyra.118140123@student.itera.ac.id',
                'no_hp'                 => '0822463105525',
                'afiliasi'              => 'Teknik Kimia',
                'tanggal_peminjaman'    => '2021-03-17',
                'tanggal_pengembalian'  => '2021-03-19',
            ],
            [
                'nama_peminjam'         => 'Nazla',
                'nim'                   => '118140325',
                'email'                 => 'muhammad.118140123@student.itera.ac.id',
                'no_hp'                 => '082246105525',
                'afiliasi'              => 'Teknik Informatika',
                'tanggal_peminjaman'    => '2021-03-17',
                'tanggal_pengembalian'  => '2021-03-19',
            ],
        ];

        foreach ($data as $key => $value) {
            FormBarang::create($value);
        }
    }
}
