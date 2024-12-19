<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User as ModelsUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ModelsUser::create([
            'company_id' => 1,
            'code' => 'ABC123',
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'remember_token' => null,
            'role' => 'admin',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        ModelsUser::create([
            'company_id' => 2,
            'code' => 'RD123',
            'name' => 'Admin Rest. Delicia',
            'email' => 'rd@admin.com',
            'password' => bcrypt('rd'),
            'remember_token' => null,
            'role' => 'subscriber',
            'created_at' => date("Y-m-d H:i:s")
        ]);

        ModelsUser::create([
            'company_id' => 1,
            'code' => 'RD1234',
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'),
            'remember_token' => null,
            'role' => 'waiter',
            'created_at' => date("Y-m-d H:i:s")
        ]);

    }
}
