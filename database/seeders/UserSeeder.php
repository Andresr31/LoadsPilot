<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->fullname = 'Admin';
        $user->email = 'admin@alpina.com';
        $user->password = 'admin';
        $user->role_id = 1;
        $user->save();
    }
}
