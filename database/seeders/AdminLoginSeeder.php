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
                'user_id' => 14,
                'username' => 'username1',
                'name' => 'zzz',
                'email' => 'daudangtung@gmail.com',
                'role' => UserRole::ADMIN,
                'level' => UserLevel::Dev,
                'password' => bcrypt('11111111'),
            ],
        );
    }
}
