<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            // Beer
            [
                'category_id'   => 1,
                'product_name'  => 'Red Horse Beer',
                'brand'         => 'San Miguel',
                'description'   => 'Strong beer perfect for parties.',
                'volume_ml'     => 500,
                'alcohol_content' => 7.0,
                'price'         => 60.00,
                'stock'         => 50,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Gin
            [
                'category_id'   => 2,
                'product_name'  => 'Ginebra San Miguel',
                'brand'         => 'Ginebra',
                'description'   => 'The classic Filipino gin.',
                'volume_ml'     => 700,
                'alcohol_content' => 40.0,
                'price'         => 120.00,
                'stock'         => 30,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Rum
            [
                'category_id'   => 3,
                'product_name'  => 'Tanduay Rhum',
                'brand'         => 'Tanduay',
                'description'   => 'Famous Filipino rum.',
                'volume_ml'     => 750,
                'alcohol_content' => 37.5,
                'price'         => 140.00,
                'stock'         => 25,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Brandy
            [
                'category_id'   => 4,
                'product_name'  => 'Emperador Brandy',
                'brand'         => 'Emperador',
                'description'   => 'Award-winning Filipino brandy.',
                'volume_ml'     => 750,
                'alcohol_content' => 36.0,
                'price'         => 130.00,
                'stock'         => 40,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Whiskey
            [
                'category_id'   => 5,
                'product_name'  => 'Jack Daniel\'s Old No.7',
                'brand'         => 'Jack Daniel\'s',
                'description'   => 'A classic Tennessee Whiskey.',
                'volume_ml'     => 700,
                'alcohol_content' => 40.0,
                'price'         => 1200.00,
                'stock'         => 15,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Vodka
            [
                'category_id'   => 6,
                'product_name'  => 'Absolut Vodka',
                'brand'         => 'Absolut',
                'description'   => 'Premium Swedish vodka.',
                'volume_ml'     => 700,
                'alcohol_content' => 40.0,
                'price'         => 890.00,
                'stock'         => 20,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Wine
            [
                'category_id'   => 7,
                'product_name'  => 'Novellino Strawberry',
                'brand'         => 'Novellino',
                'description'   => 'Sweet strawberry wine.',
                'volume_ml'     => 750,
                'alcohol_content' => 12.0,
                'price'         => 350.00,
                'stock'         => 12,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Tequila
            [
                'category_id'   => 8,
                'product_name'  => 'Jose Cuervo Especial',
                'brand'         => 'Jose Cuervo',
                'description'   => 'Popular tequila for your cocktails.',
                'volume_ml'     => 700,
                'alcohol_content' => 38.0,
                'price'         => 950.00,
                'stock'         => 10,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Liqueur
            [
                'category_id'   => 9,
                'product_name'  => 'Baileys Irish Cream',
                'brand'         => 'Baileys',
                'description'   => 'Creamy liqueur imported from Ireland.',
                'volume_ml'     => 700,
                'alcohol_content' => 17.0,
                'price'         => 990.00,
                'stock'         => 8,
                'image'         => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}