<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        $waktu = ['07:00', '09:00', '13:00', '15:00'];
        for ($i = 1; $i < 17; $i++) {
            foreach ($hari as $key => $h) {
                foreach ($waktu as $k => $w) {
                    Ruangan::create([
                        'waktu' => $w,
                        'hari' => $h,
                        'minggu' => $i
                    ]);
                }
            }
        }
    }
}
