<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=> 'admin',
                'user_name'=> 'admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make(111),
                'role'=> 'admin',
                'status'=> '1',
            ]]);
    }
}
