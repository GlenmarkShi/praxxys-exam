<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'username' => 'admin',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'email_verified_at' => Carbon::now(),
            'username' => 'admin2',
            'password' => Hash::make('password'),
            'user_type' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'username' => 'user',
            'password' => Hash::make('password'),
            'user_type' => 'user',
            'remember_token' => Str::random(10),
        ]);
    }
}
