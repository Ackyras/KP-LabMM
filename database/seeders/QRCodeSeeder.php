<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Seeder;

class QRCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $qr = QrCode::create([
            'valid_for'     =>  today(),
            'valid_until'   =>  '2021-08-25 04:27:00',
            'token'         =>  '7IGkpkqWwbGzitnb4wmE',
        ]);
    }
}
