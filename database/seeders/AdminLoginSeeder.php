<?php

namespace Database\Seeders;

use App\Enums\UserLevel;
use App\Enums\UserRole;
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
                'user_id' => 1,
                'username' => 'username1',
                'name' => 'Đậu Đăng Tùng',
                'email' => 'daudangtung@gmail.com',
                'role' => UserRole::ADMIN,
                'level' => UserLevel::Admin,
                'password' => bcrypt('11111111'),
            ],
        );
        DB::table('users')->insert(
            [
                'user_id' => 2,
                'name' => 'Admin',
                'username' => 'username2',
                'email' => 'admin@gmail.com',
                'role' => UserRole::ADMIN,
                'level' =>  UserLevel::Admin,
                'password' => bcrypt('12345678'),
            ],
        );
    }
}
