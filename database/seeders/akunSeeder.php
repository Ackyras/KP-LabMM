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
        $user =[
            [
                'username' => 'ackyras',
                'name' => 'ackyras',
                'email' => 'ackyrasibarani@gmail.com',
                'role' => 'admin',
                'password'=>bcrypt('140220')
            ],[
                'username' => 'romance',
                'name' => 'romance',
                'email' => 'romantikabanjarnahor@gmail.com',
                'role' => 'user',
                'password'=>bcrypt('140220')
            ]
        ];
        foreach($user as $key=>$value){
            User::create($value);

        }
    }
}
