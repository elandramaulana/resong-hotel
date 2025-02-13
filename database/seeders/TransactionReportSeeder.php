<?php

namespace Database\Seeders;

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
                'type_transaksi' => 'checkin',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '300000',
                'keterangan_transaksi' => 'masuk',
            ],
            [
                'tabel_referensi' => 'checkouts',
                'id_referensi' => 3,
                'type_transaksi' => 'checkout',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '300000',
                'keterangan_transaksi' => 'keluar',
            ],
            [
                'tabel_referensi' => 'other_transactions',
                'id_referensi' => 2,
                'type_transaksi' => 'other',
                'jenis_transaksi' => 'cash',
                'besar_transaksi' => '100000',
                'keterangan_transaksi' => 'lainnya',
            ],
        ]);
    }
}
