<?php

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Collection::create([
            'name' => 'The Tatreez Collection',
            'slug' => 'tatreez-collection',
            'description' => 'Exquisite traditional embroidery collection featuring authentic Tatreez craftsmanship',
            'image' => null,
        ]);

        Collection::create([
            'name' => 'The Ramadan Collection',
            'slug' => 'ramadan-collection',
            'description' => 'Exclusive collection celebrating the spirit of Ramadan with elegant designs',
            'image' => null,
        ]);

        Collection::create([
            'name' => 'Double Exposure',
            'slug' => 'double-exposure',
            'description' => 'Contemporary fusion collection blending traditional and modern aesthetics',
            'image' => null,
        ]);
    }
}
