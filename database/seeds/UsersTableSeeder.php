<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'is_active' => true,
            'email_verified_at' => now(),
            'role' => 2
        ]);

        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'is_active' => true,
            'email_verified_at' => now(),
            'role' => 1
        ]);
    }
}
