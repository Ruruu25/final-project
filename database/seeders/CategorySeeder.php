<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [ 'id' => 1, 'name' => 'Beer',    'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 2, 'name' => 'Gin',     'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 3, 'name' => 'Rum',     'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 4, 'name' => 'Brandy',  'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 5, 'name' => 'Whiskey', 'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 6, 'name' => 'Vodka',   'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 7, 'name' => 'Wine',    'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 8, 'name' => 'Tequila', 'created_at' => now(), 'updated_at' => now() ],
            [ 'id' => 9, 'name' => 'Liqueur', 'created_at' => now(), 'updated_at' => now() ],
        ]);
    }
}