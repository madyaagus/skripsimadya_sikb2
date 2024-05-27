<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Staf BB Kejaksaan Sijunjung',
                'nip' => '123456789321456789',
                'role' => 'stafbb',
                'password' => bcrypt('stafbb123')
            ],
            [
                'name' => 'Kasi BB Kejaksaan Sijunjung',
                'nip' => '345456789321456789',
                'role' => 'kasibb',
                'password' => bcrypt('kasibb345')
            ],
            [
                'name' => 'Kajari Kejaksaan Sijunjung',
                'nip' => '987456789321456789',
                'role' => 'kajari',
                'password' => bcrypt('kajari987')
            ],
            [
                'name' => 'Jaksa Kejaksaan Sijunjung',
                'nip' => '567456789321456789',
                'role' => 'jaksa',
                'password' => bcrypt('jaksa567')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
