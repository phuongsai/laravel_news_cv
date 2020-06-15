<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
