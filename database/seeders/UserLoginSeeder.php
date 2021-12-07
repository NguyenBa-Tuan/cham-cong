<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Lê Hữu Phước',
                    'email' => 'daudangtung1@gmail.com',
                    'role' => 1,
                    'level' => 2,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'name' => 'Trần Thị Duyên',
                    'email' => 'daudangtung2@gmail.com',
                    'role' => 1,
                    'level' => 2,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'name' => 'Cao Ngọc Thế',
                    'email' => 'daudangtung3@gmail.com',
                    'role' => 1,
                    'level' => 2,
                    'password' => bcrypt('11111111'),
                ]
            ],
        );
    }
}
