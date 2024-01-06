<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'matsu',
                'email' => 'eee.rip179@gmail.com',
                'password' =>  Hash::make('ripslyme3080'),
                'created_at' => '2024/1/1 12:00:00'
            ],
            [
                'name' => 'test',
                'email' => 'test@test.com',
                'password' =>  Hash::make('password'),
                'created_at' => '2024/1/2 12:00:00'
            ],
        ]);
    }
}
