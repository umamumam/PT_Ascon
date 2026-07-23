<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'umam@gmail.com'],
            [
                'name' => 'Umam',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]
        );

        // Seed Global Settings
        $settings = [
            'hero_title' => "Partnership\nThrough Trust,\nSince 1999",
            'hero_subtitle' => 'Established in 1999, to facilitate the needs of a trustworthy freight forwarding agent in Jakarta. Now with over two decades of experience backed by a dedicated and knowledgeable team, we have gained partnership globally by being a trustworthy and reliable freight forwarding company',
            'head_office_address' => "Soepomo Office Park, Blok O\nJl. Prof. Dr. Supomo No. 143\nTebet Jakarta Selatan 12870\nIndonesia",
            'semarang_office_address' => "SETOS CO WORK\nMG Setos, Jl. Inspeksi Lt 3,\nKembangsari, Semarang Tengah,\nJawa Tengah, Indonesia 50133",
            'phone' => '+62 21 8379 1179',
            'phone_semarang' => '+62 24 8604 1230 Ext. 105',
            'phone_2' => '+62 21 8379 1183',
            'phone_semarang_2' => '+62 24 7644 1991',
            'email' => 'admin@asiaconnex.net',
            'whatsapp' => '+62 819 1000 1999',
            'facebook_link' => 'https://facebook.com',
            'instagram_link' => 'https://instagram.com',
            'linkedin_link' => 'https://linkedin.com',
        ];

        foreach ($settings as $key => $value) {
            \Illuminate\Support\Facades\DB::table('settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // Seed Social Feeds (Top 6 real Instagram posts from asiaconnexindo)
        $feeds = [
            [
                'title' => 'Air Cargo Regulations & Safety',
                'tag' => 'Air Cargo',
                'image_path' => 'assets/img/instagram/post1.jpg',
                'link' => 'https://www.instagram.com/asiaconnexindo/',
            ],
            [
                'title' => 'Reliable Logistics Solutions',
                'tag' => 'Sea, Air & Land',
                'image_path' => 'assets/img/instagram/post2.jpg',
                'link' => 'https://www.instagram.com/p/DaCkxjsiW91/',
            ],
            [
                'title' => 'Happy Islamic New Year 1448 H',
                'tag' => 'Greetings',
                'image_path' => 'assets/img/instagram/post3.jpg',
                'link' => 'https://www.instagram.com/asiaconnexindo/',
            ],
            [
                'title' => 'Ready to Take Your Business Global',
                'tag' => 'Global Business',
                'image_path' => 'assets/img/instagram/post4.jpg',
                'link' => 'https://www.instagram.com/p/DZeDEuAibpS/',
            ],
            [
                'title' => 'Your Cargo Matters, and So Does Your Time',
                'tag' => 'Logistics Expert',
                'image_path' => 'assets/img/instagram/post5.jpg',
                'link' => 'https://www.instagram.com/asiaconnexindo/',
            ],
            [
                'title' => 'Blessed Eid Al Adha Greetings',
                'tag' => 'Greetings',
                'image_path' => 'assets/img/instagram/post6.jpg',
                'link' => 'https://www.instagram.com/asiaconnexindo/',
            ]
        ];

        foreach ($feeds as $feed) {
            \Illuminate\Support\Facades\DB::table('social_feeds')->updateOrInsert(
                ['title' => $feed['title']],
                [
                    'tag' => $feed['tag'],
                    'image_path' => $feed['image_path'],
                    'link' => $feed['link'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
