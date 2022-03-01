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
                    'user_id' => 1,
                    'username' => 'username5',
                    'name' => 'Lê Hữu Phước',
                    'email' => 'daudangtung11@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 2,
                    'username' => 'username51',
                    'name' => 'Trần Thị Duyên',
                    'email' => 'daudangtung12@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 3,
                    'username' => 'username52',
                    'name' => 'Cao Ngọc Thế',
                    'email' => 'daudangtung13@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 4,
                    'username' => 'username53',
                    'name' => 'Nguyễn Văn Phương',
                    'email' => 'daudangtung14@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' =>5,
                    'username' => 'username54',
                    'name' => 'Trần Thị Thùy Trang',
                    'email' => 'daudangtung15@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 6,
                    'username' => 'username55',
                    'name' => 'Đậu Khắc Lợi',
                    'email' => 'daudangtung16@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 7,
                    'username' => 'username56',
                    'name' => 'Nguyễn Anh Tú',
                    'email' => 'daudangtung17@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 8,
                    'username' => 'username57',
                    'name' => 'Vương Thị Sương',
                    'email' => 'daudangtung18@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 9,
                    'username' => 'username58',
                    'name' => 'Đậu Đăng Tùng',
                    'email' => 'daudangtung19@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 10,
                    'username' => 'username59',
                    'name' => 'Vũ Văn Sáng',
                    'email' => 'daudangtung110@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 11,
                    'username' => 'username60',
                    'name' => 'Nguyễn Đức Chính',
                    'email' => 'daudangtung111@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 12,
                    'username' => 'username61',
                    'name' => 'Phạm Hữu Toại',
                    'email' => 'daudangtung112@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
                [
                    'user_id' => 13,
                    'username' => 'username62',
                    'name' => 'Nguyễn Bá Tuấn',
                    'email' => 'daudangtung113@gmail.com',
                    'role' => 1,
                    'level' => UserLevel::Dev,
                    'password' => bcrypt('11111111'),
                ],
            ],
        );
    }
}
