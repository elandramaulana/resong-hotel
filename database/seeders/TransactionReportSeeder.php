<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaction_reports')->insert([
            [
                'tabel_referensi' => 'checkins',
                'id_referensi' => 4,
                'type_transaksi' => 'IN',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '300000',
                'keterangan_transaksi' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 18, 8, 30, 0), // 18 Feb 2024 08:30:00
                'updated_at' => Carbon::create(2024, 2, 18, 8, 30, 0)
            ],
            [
                'tabel_referensi' => 'checkouts',
                'id_referensi' => 3,
                'type_transaksi' => 'IN',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '300000',
                'keterangan_transaksi' => 'keluar',
                'created_at' => Carbon::create(2024, 2, 18, 10, 15, 0), // 18 Feb 2024 10:15:00
                'updated_at' => Carbon::create(2024, 2, 18, 10, 15, 0)
            ],
            [
                'tabel_referensi' => 'other_transactions',
                'id_referensi' => 2,
                'type_transaksi' => 'OUT',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '100000',
                'keterangan_transaksi' => 'lainnya',
                'created_at' => Carbon::create(2024, 2, 18, 13, 45, 0), // 18 Feb 2024 13:45:00
                'updated_at' => Carbon::create(2024, 2, 18, 13, 45, 0)
            ],
        ]);
    }
}
