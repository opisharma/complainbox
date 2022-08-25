<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            'role_id'       =>  '1',
            'name'          =>  'Admin',
            'email'         =>  'admin@admin.com',
            'student_id'    =>  '',
            'password'      =>  bcrypt('123456')
        ]);

    }
}
