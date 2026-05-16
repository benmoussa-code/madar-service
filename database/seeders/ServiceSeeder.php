<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provider = \App\Models\User::where('role', 'provider')->first();
        $categories = \App\Models\Category::all();

        $services = [
            [
                'title' => 'Plomberie Express',
                'category_slug' => 'plomberie',
                'description' => 'Réparation de fuites, installation de robinetterie et débouchage canalisation 24h/24.',
                'price' => 150.00,
                'image' => 'https://images.pexels.com/photos/6419128/pexels-photo-6419128.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            [
                'title' => 'Installation Électrique',
                'category_slug' => 'electricite',
                'description' => 'Installation complète pour villas et appartements, mise en conformité et dépannage.',
                'price' => 200.00,
                'image' => 'https://images.pexels.com/photos/257736/pexels-photo-257736.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            [
                'title' => 'Peinture & Décoration',
                'category_slug' => 'peinture',
                'description' => 'Travaux de peinture intérieure et extérieure avec des produits de haute qualité.',
                'price' => 80.00,
                'image' => 'https://images.pexels.com/photos/1669754/pexels-photo-1669754.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            [
                'title' => 'Nettoyage Maison & Bureau',
                'category_slug' => 'nettoyage',
                'description' => 'Service de nettoyage professionnel pour particuliers et entreprises.',
                'price' => 300.00,
                'image' => 'https://images.pexels.com/photos/6195125/pexels-photo-6195125.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            [
                'title' => 'Réparation Climatisation',
                'category_slug' => 'climatisation',
                'description' => 'Entretien et recharge de gaz pour tous types de climatiseurs.',
                'price' => 250.00,
                'image' => 'https://images.pexels.com/photos/3680319/pexels-photo-3680319.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
            [
                'title' => 'Menuiserie Bois & Alu',
                'category_slug' => 'menuiserie',
                'description' => 'Conception et fabrication de meubles, portes et fenêtres sur mesure.',
                'price' => 500.00,
                'image' => 'https://images.pexels.com/photos/1750059/pexels-photo-1750059.jpeg?auto=compress&cs=tinysrgb&w=800'
            ],
        ];

        foreach ($services as $s) {
            $category = $categories->where('slug', $s['category_slug'])->first();
            
            $prefix = match($s['category_slug']) {
                'electricite' => 'electricien',
                'climatisation' => 'climatiseur',
                'peinture' => 'peintre',
                'nettoyage' => 'nettoyeur',
                'menuiserie' => 'menuisier',
                default => 'plombier',
            };
            
            $email = $prefix . '@gmail.com';
            $provider = \App\Models\User::where('email', $email)->first();

            \App\Models\Service::create([
                'user_id' => $provider->id,
                'category_id' => $category->id,
                'title' => $s['title'],
                'description' => $s['description'],
                'price' => $s['price'],
                'image' => $s['image'],
                'status' => 'approved',
                'phone' => '0600000000',
                'whatsapp' => '212600000000',
                'address' => 'Avenue Mekka, Laayoune',
                'latitude' => 27.1500,
                'longitude' => -13.2000
            ]);
        }
    }
}
