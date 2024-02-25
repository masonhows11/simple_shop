<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'naeem1992',
             'email' => 'mason.hows11@gmail.com',
             'password' => Hash::make('123456'),
             'email_verified_at' => now(),
         ]);

         \App\Models\Product::factory(10)->create();
    }
}
