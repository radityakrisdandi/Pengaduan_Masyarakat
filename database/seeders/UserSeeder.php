<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'name' => 'Radit',
                'email' => 'raditya@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Rusdi',
                'email' => 'Rusdi@gmail.com',
                'password' => bcrypt('muwani'),
                'role' => 'petugas'
            ],
            [
                'name' => 'Amba',
                'email' => 'amba@gmail.com',
                'password' => bcrypt('tivasi'),
                'role' => 'user'
            ]
        ];
        foreach ($data as $item) {
            User::create($item);
        }
    }
}
