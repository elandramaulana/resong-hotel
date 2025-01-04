<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DailyMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('daily_menus')->insert(
            [

                [
                    'id' => 1,
                    'day_name' => 'Senin',
                    'status' => 'Active'
                ],
                [
                    'id' => 2,
                    'day_name' => 'Selasa',
                    'status' => 'Active'
                ],
                [
                    'id' => 3,
                    'day_name' => 'Rabu',
                    'status' => 'Active'
                ],
                [
                    'id' => 4,
                    'day_name' => 'Kamis',
                    'status' => 'Active'
                ],
                [
                    'id' => 5,
                    'day_name' => 'Jumat',
                    'status' => 'Active'
                ],
                [
                    'id' => 6,
                    'day_name' => 'Sabtu',
                    'status' => 'Active'
                ],
                [
                    'id' => 7,
                    'day_name' => 'Minggu',
                    'status' => 'Active'
                ]
            ]
        );
    }
}
