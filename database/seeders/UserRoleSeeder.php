<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_roles')->insert([
            ['id_user' => 1, 'id_role' => 1],
            ['id_user' => 2, 'id_role' => 2],
            ['id_user' => 3, 'id_role' => 3],
            ['id_user' => 4, 'id_role' => 4],
        ]);
    }
}
