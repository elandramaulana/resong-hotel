<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperuserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'=>'super.user',
            'name'=>'SuperUser',
            'email'=>'superuser@metrosoft.com',
            'level_user'=>'SUPERADMIN',
            'password'=>Hash::make('123qweasd')
        ]);
    }
}
