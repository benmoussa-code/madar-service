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
                'image' => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Installation Électrique',
                'category_slug' => 'electricite',
                'description' => 'Installation complète pour villas et appartements, mise en conformité et dépannage.',
                'price' => 200.00,
                'image' => 'https://images.unsplash.com/photo-1621905252507-b35242f8df49?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Peinture & Décoration',
                'category_slug' => 'peinture',
                'description' => 'Travaux de peinture intérieure et extérieure avec des produits de haute qualité.',
                'price' => 80.00,
                'image' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Nettoyage Maison & Bureau',
                'category_slug' => 'nettoyage',
                'description' => 'Service de nettoyage professionnel pour particuliers et entreprises.',
                'price' => 300.00,
                'image' => 'https://images.unsplash.com/photo-1581578731522-745d05cb9734?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Réparation Climatisation',
                'category_slug' => 'climatisation',
                'description' => 'Entretien et recharge de gaz pour tous types de climatiseurs.',
                'price' => 250.00,
                'image' => 'https://images.unsplash.com/photo-1631541486121-69e0004ccf4f?auto=format&fit=crop&q=80&w=800'
            ],
            [
                'title' => 'Menuiserie Bois & Alu',
                'category_slug' => 'menuiserie',
                'description' => 'Conception et fabrication de meubles, portes et fenêtres sur mesure.',
                'price' => 500.00,
                'image' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?auto=format&fit=crop&q=80&w=800'
            ],
        ];

        foreach ($services as $s) {
            $category = $categories->where('slug', $s['category_slug'])->first();
            \App\Models\Service::create([
                'user_id' => $provider->id,
                'category_id' => $category->id,
                'title' => $s['title'],
                'description' => $s['description'],
                'price' => $s['price'],
                'image' => $s['image'],
                'status' => 'approved',
                'phone' => '0600000000',
                'whatsapp' => '212600000000'
            ]);
        }
    }
}
