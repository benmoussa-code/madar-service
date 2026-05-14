<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Prestataire One',
            'email' => 'provider@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'provider',
            'phone' => '0600000000',
            'city' => 'Casablanca',
        ]);

        \App\Models\User::create([
            'name' => 'Client One',
            'email' => 'client@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'client',
        ]);
    }
}
