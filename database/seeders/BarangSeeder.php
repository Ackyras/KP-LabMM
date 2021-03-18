<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = [
            [
                'kd_barang' => 'LCD1',
                'nama_barang' => 'MSI LCD',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Elektronik',
                'stok' => '30',
                'peminjaman' => '30',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LCD2',
                'nama_barang' => 'Panasonic LCD',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '20',
                'peminjaman' => '11',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-01',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'PRYK1',
                'nama_barang' => 'MSI Proyektor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '21',
                'peminjaman' => '11',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-17',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'PRYK2',
                'nama_barang' => 'Asus Proyektor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '12',
                'peminjaman' => '11',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR1',
                'nama_barang' => 'MSI Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '40',
                'peminjaman' => '30',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR2',
                'nama_barang' => 'HP Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '30',
                'peminjaman' => '20',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR3',
                'nama_barang' => 'Asus Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '30',
                'peminjaman' => '30',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR4',
                'nama_barang' => 'Apple Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '2',
                'peminjaman' => '2',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR5',
                'nama_barang' => 'Samsung Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '200',
                'peminjaman' => '180',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR6',
                'nama_barang' => 'Lenovo Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '2',
                'peminjaman' => '2',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MNTR7',
                'nama_barang' => 'Acer Monitor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '12',
                'peminjaman' => '10',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP1',
                'nama_barang' => 'MSI Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '8',
                'peminjaman' => '7',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP2',
                'nama_barang' => 'Asus Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '10',
                'peminjaman' => '3',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP3',
                'nama_barang' => 'Acer Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Elektronik',
                'stok' => '18',
                'peminjaman' => '17',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP4',
                'nama_barang' => 'Lenovo Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Elektronik',
                'stok' => '80',
                'peminjaman' => '71',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP5',
                'nama_barang' => 'Xiaomi Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Elektronik',
                'stok' => '14',
                'peminjaman' => '13',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP6',
                'nama_barang' => 'ROG Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Elektronik',
                'stok' => '3',
                'peminjaman' => '1',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'LPTP7',
                'nama_barang' => 'Vivobook Laptop',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Elektronik',
                'stok' => '12',
                'peminjaman' => '1',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MEJA1',
                'nama_barang' => 'Meja IKEA',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Non Elektronik',
                'stok' => '12',
                'peminjaman' => '12',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MEJA2',
                'nama_barang' => 'Meja Informa',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Non Elektronik',
                'stok' => '10',
                'peminjaman' => '8',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MEJA3',
                'nama_barang' => 'Meja Gaming',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'PRODI',
                'kategori' => 'Non Elektronik',
                'stok' => '1',
                'peminjaman' => '1',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'MEJA4',
                'nama_barang' => 'Meja Kantor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Non Elektronik',
                'stok' => '12',
                'peminjaman' => '12',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'KURSI1',
                'nama_barang' => 'Kursi Kantor',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Non Elektronik',
                'stok' => '10',
                'peminjaman' => '8',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'KURSI2',
                'nama_barang' => 'Kursi Gaming',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Non Elektronik',
                'stok' => '12',
                'peminjaman' => '8',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
            [
                'kd_barang' => 'KURSI3',
                'nama_barang' => 'Kursi Pesta',
                'foto' => 'https://static.vecteezy.com/system/resources/previews/001/203/171/original/laptop-png.png',
                'lokasi' => 'TPB',
                'kategori' => 'Non Elektronik',
                'stok' => '20',
                'peminjaman' => '20',
                'status' => 'Baik',
                'masuk_barang' => '2021-03-02',
                'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta')
            ],
        ];

        foreach ($barang as $key => $value) {
            Inventaris::create($value);
        }
    }
}
