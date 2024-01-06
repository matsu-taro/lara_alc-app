<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alcohols')->insert([
            [
                'user_id' => '1',
                'alc_name' => 'キリン一番搾り',
                'price' =>  '500',
                'place' =>  'キリンシティ',
                'type' =>  '1',
                'status' =>  '1',
                'memo' =>  '上野店',
                'created_at' => '2024/1/1 12:00:00'
            ],
            [
                'user_id' => '1',
                'alc_name' => '本搾りレモン',
                'price' =>  '400',
                'place' =>  'キリンシティ',
                'type' =>  '2',
                'status' =>  '1',
                'memo' =>  '上野店',
                'created_at' => '2024/1/1 12:00:00'
            ],
        ]);
    }
}
