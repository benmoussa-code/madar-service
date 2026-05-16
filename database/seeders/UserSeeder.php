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

        $providers = [
            ['name' => 'Jean Plombier', 'email' => 'plombier@gmail.com'],
            ['name' => 'Marc Élec', 'email' => 'electricien@gmail.com'],
            ['name' => 'Sophie Peintre', 'email' => 'peintre@gmail.com'],
            ['name' => 'Service Nettoyage', 'email' => 'nettoyeur@gmail.com'],
            ['name' => 'Pro Clim', 'email' => 'climatiseur@gmail.com'],
            ['name' => 'Artisan Menuisier', 'email' => 'menuisier@gmail.com'],
        ];

        foreach ($providers as $p) {
            \App\Models\User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'provider',
                'phone' => '0600000000',
                'city' => 'Laayoune',
            ]);
        }

        \App\Models\User::create([
            'name' => 'Client Test',
            'email' => 'client@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'client',
        ]);
    }
}
