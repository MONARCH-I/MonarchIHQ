<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Servers',          'icon' => '🖥️',  'sort' => 1],
            ['name' => 'Networking',       'icon' => '🌐',  'sort' => 2],
            ['name' => 'Security Cameras', 'icon' => '📷',  'sort' => 3],
            ['name' => 'Access Control',   'icon' => '🔐',  'sort' => 4],
            ['name' => 'SaaS Plans',       'icon' => '☁️',  'sort' => 5],
            ['name' => 'Storage Devices',  'icon' => '💾',  'sort' => 6],
            ['name' => 'Workstations',     'icon' => '🖱️',  'sort' => 7],
            ['name' => 'Audio / Visual',   'icon' => '🎙️',  'sort' => 8],
            ['name' => 'Accessories',      'icon' => '🔌',  'sort' => 9],
            ['name' => 'Software Licenses', 'icon' => '📄',  'sort' => 10],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'sort_order' => $cat['sort'],
                    'is_active' => true,
                ]
            );
        }
    }
}
