<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminLoginSeeder extends Seeder
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
                'name' => 'Đậu Đăng Tùng',
                'email' => 'daudangtung@gmail.com',
                'role' => 0,
                'level' => 1,
                'password' => bcrypt('11111111'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 0,
                'level' => 1,
                'password' => bcrypt('12345678'),
            ],
        );
    }
}
