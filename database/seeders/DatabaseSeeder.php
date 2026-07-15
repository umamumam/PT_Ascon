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

        // Seed Social Feeds
        $feeds = [
            [
                'title' => 'Top 10 Commodities',
                'tag' => 'Top Commodities',
                'image_path' => 'https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=400&q=80',
                'link' => 'https://instagram.com',
            ],
            [
                'title' => 'Isra Miraj',
                'tag' => 'Event',
                'image_path' => 'https://images.unsplash.com/photo-1564507592333-c60657eea523?auto=format&fit=crop&w=400&q=80',
                'link' => 'https://instagram.com',
            ],
            [
                'title' => 'Merry Christmas',
                'tag' => 'Merry Christmas',
                'image_path' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=400&q=80',
                'link' => 'https://instagram.com',
            ],
            [
                'title' => 'Happy New Year',
                'tag' => 'New Year',
                'image_path' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=400&q=80',
                'link' => 'https://instagram.com',
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
