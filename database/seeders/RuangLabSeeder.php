<?php

namespace Database\Seeders;

use App\Models\RuangLab;
use Illuminate\Database\Seeder;

class RuangLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RuangLab::create(
            [
                'ruang'     => 'Labtek 1 Lantai 2',
                'lokasi'    => 'Labtek 1',
                'status'    => 'Baik'
            ]
        );
    }
}
