<?php

namespace Database\Seeders;

use App\Enums\UserLevel;
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
                    'user_id' => 3,
                    'username' => 'username5',
                    'name' => 'Lê Hữu Phước',
                    'email' => 'daudangtung1@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 4,
                    'username' => 'username4',
                    'name' => 'Trần Thị Duyên',
                    'email' => 'daudangtung2@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 5,
                    'username' => 'username3',
                    'name' => 'Cao Ngọc Thế',
                    'email' => 'daudangtung3@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
//                [
//                    'name' => 'Nguyễn Anh Tú',
//                    'email' => 'daudangtung4@gmail.com',
//                    'role' => 1,
//                    'level' => UserLevel::Employee,
//                    'password' => bcrypt('11111111'),
//                ],
//                [
//                    'name' => 'Nguyễn Thị Sương',
//                    'email' => 'daudangtung5@gmail.com',
//                    'role' => 1,
//                    'level' => UserLevel::Employee,
//                    'password' => bcrypt('11111111'),
//                ],
//                [
//                    'name' => 'Trần Thị Thùy Trang',
//                    'email' => 'daudangtung6@gmail.com',
//                    'role' => 1,
//                    'level' => UserLevel::Employee,
//                    'password' => bcrypt('11111111'),
//                ],
//                [
//                    'name' => 'Đậu Khắc Lợi',
//                    'email' => 'daudangtung7@gmail.com',
//                    'role' => 1,
//                    'level' => UserLevel::Employee,
//                    'password' => bcrypt('11111111'),
//                ],
            ],
        );
    }
}
