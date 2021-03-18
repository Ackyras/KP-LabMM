<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'username' => 'superadmin',
                'name' => 'Super Admin',
                'email' => 'superadmin@laboran.com',
                'role' => 'superadmin',
                'password' => bcrypt('laboran')
            ],
            [
                'username' => 'rekrut',
                'name' => 'Admin Rekrut',
                'email' => 'adminasprak@laboran.com',
                'role' => 'asprak',
                'password' => bcrypt('laboran')
            ],
            [
                'username' => 'inventaris',
                'name' => 'Admin Inventaris',
                'email' => 'admininventaris@laboran.com',
                'role' => 'inventaris',
                'password' => bcrypt('laboran')
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
