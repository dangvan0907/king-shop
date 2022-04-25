<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Mr.A',
                'email' => 'a@gmail.com',
                'password' => bcrypt(123456789),
            ],
            [
                'name' => 'Mr.B',
                'email' => 'b@gmail.com',
                'password' => bcrypt(123456789),
            ],
            [
                'name' => 'Mr.C',
                'email' => 'c@gmail.com',
                'password' => bcrypt(123456789),
            ],
        ]);

    }
}
