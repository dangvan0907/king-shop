<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'super-admin',
                'display_name' => 'SIEU QUAN TRI VIEN',
            ],
            [
                'name' => 'admin',
                'display_name' => 'QUAN TRI VIEN',
            ],
            [
                'name' => 'user',
                'display_name' => 'NGUOI DUNG',
            ],
        ]);

    }
}
