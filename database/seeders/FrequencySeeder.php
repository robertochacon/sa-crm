<?php

namespace Database\Seeders;

use App\Models\Frequency as ModelsFrequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsFrequency::create([
            'name'=>'Quincenal',
        ]);

        ModelsFrequency::create([
            'name'=>'Mensual',
        ]);

        ModelsFrequency::create([
            'name'=>'Anual',
        ]);
    }
}
