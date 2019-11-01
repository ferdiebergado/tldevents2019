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
            'email' => 'abc@123.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'is_active' => true,
            'email_verified_at' => now(),
            'role' => 1
        ]);
    }
}
