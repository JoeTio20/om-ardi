<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Patah Besar',
                'description' => 'Sarang burung walet kualitas premium, patah ukuran besar.',
                'price'       => 1990000,
                'badge'       => 'limited',
                'category'    => 'premium',
                'images'      => ['/IMAGE/PATAH BESAR.jpeg'],
            ],
            [
                'name'        => 'Indonmmie',
                'description' => 'Sarang burung walet pilihan, bentuk mie khas Indonesia.',
                'price'       => 1500000,
                'badge'       => null,
                'category'    => 'reguler',
                'images'      => ['/IMAGE/INDONMMIE.jpeg'],
            ],
            [
                'name'        => 'Patah Sambung',
                'description' => 'Sarang burung walet patah sambung, tekstur unik berkualitas.',
                'price'       => 1750000,
                'badge'       => 'new',
                'category'    => 'premium',
                'images'      => ['/IMAGE/PATAH SAMBUNG.jpeg'],
            ],
            [
                'name'        => 'Super',
                'description' => 'Sarang burung walet grade super, kualitas terbaik.',
                'price'       => 2500000,
                'badge'       => 'limited',
                'category'    => 'premium',
                'images'      => ['/IMAGE/SUPER.jpeg'],
            ],
            [
                'name'        => 'Mangkok',
                'description' => 'Sarang burung walet bentuk mangkok utuh, paling dicari.',
                'price'       => 3200000,
                'badge'       => 'new',
                'category'    => 'premium',
                'images'      => ['/IMAGE/MANGKOK.jpeg'],
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}