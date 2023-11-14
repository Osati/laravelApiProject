<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'rafi',
                'email'=>'rafi@gmail.com',
                'password'=>'12345'
            ],
            [
                'name'=>'kafi',
                'email'=>'kafi@gmail.com',
                'password'=>'12345'
            ],
            [
                'name'=>'safi',
                'email'=>'safi@gmail.com',
                'password'=>'12345'
            ],
            [
                'name'=>'bafi',
                'email'=>'bafi@gmail.com',
                'password'=>'12345'
            ],

        ];
        User::insert($users);
    }
}
