<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company as ModelsCompanies;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsCompanies::create([
            'plan_id' => 2,
            'full_name' => 'RacvyCode',
            'short_name' => 'RacvyCode',
            'rnc' => '000000000',
            'website' => 'https://racvycode.com',
            'phone' => '8297821156',
            'color' => 'orange',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        ModelsCompanies::create([
            'full_name' => 'Restaurante la Delicia',
            'short_name' => 'RD',
            'rnc' => '000000000',
            'website' => null,
            'phone' => null,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
