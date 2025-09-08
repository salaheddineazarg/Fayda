<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone_number'=>'0610203040',
            'password'=>'salah123',
            'role'=>'VENDOR'

        ]);
        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'phone_number'=>'0610203040',
            'password'=>'salah123',
            'role'=>'CUSTOMER'

        ]);
    }
}
