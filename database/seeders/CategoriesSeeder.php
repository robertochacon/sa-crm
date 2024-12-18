<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'company_id' => 2,
                'name' => 'Comida Rápida',
                'icon' => 'https://img.icons8.com/?size=48&id=r2CPanP0nY5E&format=png',
                'status' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Mariscos',
                'icon' => 'https://img.icons8.com/?size=48&id=16080&format=png',
                'status' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Postres',
                'icon' => 'https://img.icons8.com/?size=48&id=VzE-LU1E1B_t&format=png',
                'status' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Bebidas',
                'icon' => 'https://img.icons8.com/?size=48&id=g1gVq9lil3jm&format=png',
                'status' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Platos Típicos',
                'icon' => 'https://img.icons8.com/?size=48&id=yqZm7m9vpAuT&format=png',
                'status' => true,
            ],
            [
                'company_id' => 2,
                'name' => 'Comida Saludable',
                'icon' => 'https://img.icons8.com/?size=48&id=107450&format=png',
                'status' => true,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
