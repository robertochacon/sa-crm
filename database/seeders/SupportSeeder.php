<?php

namespace Database\Seeders;

use App\Models\Support as ModelsSupport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsSupport::create([
            'name'=>'Basico',
        ]);

        ModelsSupport::create([
            'name'=>'Avanzado',
        ]);

    }
}
