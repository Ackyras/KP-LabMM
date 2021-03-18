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
            ]
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
