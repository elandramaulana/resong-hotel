<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisis')->insert([
            [
                'id' => 1,
                'd_nama' => "Front Office",
                'd_deskripsi' => "Front Office",
                'd_jobdesc'  => "Front Office",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 2,
                'd_nama' => "Housekeeping",
                'd_deskripsi' => "Housekeeping",
                'd_jobdesc'  => "Housekeeping",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 3,
                'd_nama' => "Kitchen",
                'd_deskripsi' => "Kitchen",
                'd_jobdesc'  => "Kitchen",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 4,
                'd_nama' => "Resto",
                'd_deskripsi' => "Resto",
                'd_jobdesc'  => "Resto",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 5,
                'd_nama' => "Manajemen Asset",
                'd_deskripsi' => "Manajemen Asset",
                'd_jobdesc'  => "Manajemen Asset",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 6,
                'd_nama' => "HRD",
                'd_deskripsi' => "HRD",
                'd_jobdesc'  => "HRD",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 7,
                'd_nama' => "Finance",
                'd_deskripsi' => "Finance",
                'd_jobdesc'  => "Finance",
                'd_OT_approver' => 1,
            ],
            [
                'id' => 8,
                'd_nama' => "Human Capital",
                'd_deskripsi' => "Human Capital",
                'd_jobdesc'  => "Human Capital",
                'd_OT_approver' => 1,
            ],
        ]);
    }
}
