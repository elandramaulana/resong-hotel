<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaundryGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laundry_guests')->insert([
            [
                'room_id' => 1,
                'jenis_laundry' => 'Pakaian',
                'catatan' => 'Baju 3 pcs, celana 2 pcs',
                'harga' => 50000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 15, 8, 30, 0),
                'fo_user_id_keluar' => 1,
                'tgl_laundry_masuk' => Carbon::create(2024, 2, 16, 14, 0, 0),
                'fo_user_id_masuk' => 2,
                'status' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 15, 8, 30, 0),
                'updated_at' => Carbon::create(2024, 2, 16, 14, 0, 0)
            ],
            [
                'room_id' => 1,
                'jenis_laundry' => 'Pakaian',
                'catatan' => 'Baju 3 pcs, celana 2 pcs',
                'harga' => 80000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 15, 8, 30, 0),
                'fo_user_id_keluar' => 1,
                'tgl_laundry_masuk' => Carbon::create(2024, 2, 16, 14, 0, 0),
                'fo_user_id_masuk' => 2,
                'status' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 15, 8, 30, 0),
                'updated_at' => Carbon::create(2024, 2, 16, 14, 0, 0)
            ],
            [
                'room_id' => 3,
                'jenis_laundry' => 'Bedding',
                'catatan' => 'Sprei dan sarung bantal',
                'harga' => 75000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 17, 10, 15, 0),
                'fo_user_id_keluar' => 1,
                'tgl_laundry_masuk' => null,
                'fo_user_id_masuk' => null,
                'status' => 'keluar',
                'created_at' => Carbon::create(2024, 2, 17, 10, 15, 0),
                'updated_at' => Carbon::create(2024, 2, 17, 10, 15, 0)
            ],
            [
                'room_id' => 5,
                'jenis_laundry' => 'Mix Items',
                'catatan' => 'Handuk 2 pcs, baju 4 pcs',
                'harga' => 150000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 12, 9, 0, 0),
                'fo_user_id_keluar' => 2,
                'tgl_laundry_masuk' => Carbon::create(2024, 2, 13, 16, 30, 0),
                'fo_user_id_masuk' => 1,
                'status' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 12, 9, 0, 0),
                'updated_at' => Carbon::create(2024, 2, 19, 16, 30, 0)
            ],
            [
                'room_id' => 5,
                'jenis_laundry' => 'Mix Items',
                'catatan' => 'Handuk 2 pcs, baju 4 pcs',
                'harga' => 100000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 13, 9, 0, 0),
                'fo_user_id_keluar' => 2,
                'tgl_laundry_masuk' => Carbon::create(2024, 2, 14, 16, 30, 0),
                'fo_user_id_masuk' => 1,
                'status' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 18, 9, 0, 0),
                'updated_at' => Carbon::create(2024, 2, 19, 16, 30, 0)
            ],
            [
                'room_id' => 5,
                'jenis_laundry' => 'Mix Items',
                'catatan' => 'Handuk 2 pcs, baju 4 pcs',
                'harga' => 170000,
                'tgl_laundry_keluar' => Carbon::create(2024, 2, 14, 9, 0, 0),
                'fo_user_id_keluar' => 2,
                'tgl_laundry_masuk' => Carbon::create(2024, 2, 15, 16, 30, 0),
                'fo_user_id_masuk' => 1,
                'status' => 'masuk',
                'created_at' => Carbon::create(2024, 2, 18, 9, 0, 0),
                'updated_at' => Carbon::create(2024, 2, 19, 16, 30, 0)
            ],
        ]);
    }
}
