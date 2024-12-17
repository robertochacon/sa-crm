<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan as ModelsPlan;


class PlanSeeder extends Seeder
{

    public function run(): void
    {

        ModelsPlan::create([
            'name'=>'Basico',
            'frequency_id'=>1,
            'support_id'=>1,
            'amount'=>500
        ]);

        ModelsPlan::create([
            'name'=>'Premium',
            'frequency_id'=>2,
            'support_id'=>2,
            'amount'=>1500
        ]);

    }
}
