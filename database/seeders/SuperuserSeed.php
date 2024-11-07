<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperuserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'super.user',
                'name' => 'SuperUser',
                'email' => 'superuser@metrosoft.com',
                'level_user' => 'SUPERADMIN',
                'password' => Hash::make('123qweasd')
            ],
            [
                'username' => 'admin.user',
                'name' => 'AdminUser',
                'email' => 'adminuser@metrosoft.com',
                'level_user' => 'ADMIN',
                'password' => Hash::make('123qweasd')
            ]
        ]);
    }
}
