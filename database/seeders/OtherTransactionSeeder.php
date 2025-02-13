<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('other_transactions')->insert([
            [
                'item' => 'Kopi',
                'qty' => 2,
                'harga' => 10000,
                'tgl' => '2023-01-01',
            ],
            [
                'item' => 'Pemompa Karet',
                'qty' => 2,
                'harga' => 50000,
                'tgl' => '2023-01-01',
            ],
            [
                'item' => 'Beras',
                'qty' => 2,
                'harga' => 10000,
                'tgl' => '2023-01-01',
            ]
        ]);
    }
}
