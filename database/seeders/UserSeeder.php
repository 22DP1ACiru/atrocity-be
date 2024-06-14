<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'profilePicture' => 'default_profile.webp',
            'accountDescription' => 'Admin account',
            'followerCount' => 0,
            'isAdmin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
