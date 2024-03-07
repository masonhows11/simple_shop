<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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

        //         \App\Models\User::factory()->create([
        //             'name' => 'naeem1992',
        //             'email' => 'mason.hows11@gmail.com',
        //             'password' => Hash::make('123456'),
        //             'email_verified_at' => now(),
        //         ]);
        // create users
        $users = [
            [
                'name' => 'naeem_sol',
                'first_name' => 'naeem',
                'last_name' => 'soltany',
                'mobile' => '09917230927',
                'password' => Hash::make('123456'),
                'email' => 'mason.hows11@gmail.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'mason_hows11',
                'first_name' => 'mason',
                'last_name' => 'hows',
                'mobile' => '09179817599',
                'password' => Hash::make('123456'),
                'email' => 'mason.hows12@gmail.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'joe_james',
                'first_name' => 'joe',
                'last_name' => 'james',
                'mobile' => '09172890423',
                'password' => Hash::make('123456'),
                'email' => 'joe.james556@gmail.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'james',
                'first_name' => 'joe',
                'last_name' => 'james',
                'role' => 'user',
            ],
            [
                'name' => 'nicky',
                'first_name' => 'nick',
                'last_name' => 'wilson',
                'role' => 'user',
            ],
            [
                'name' => 'Mary',
                'first_name' => 'maria',
                'last_name' => 'watson',
                'role' => 'user',
            ],
            [
                'name' => 'John97',
                'first_name' => 'John',
                'last_name' => 'marston',
                'role' => 'user',
            ],
            [
                'name' => 'David',
                'first_name' => 'David120',
                'last_name' => 'Bombal',
                'role' => 'user',
            ],
            [
                'name' => 'nicky',
                'first_name' => 'nick',
                'last_name' => 'wilson',
                'email' => 'nicky.wilson21@gmail.com',
                'password' => Hash::make('1289..//**'),
                'mobile' => '09917230929',
                'role' => 'user',
            ],
            [
                'name' => 'Mary',
                'first_name' => 'maria',
                'last_name' => 'watson',
                'email' => 'mary.watson90@gmail.com',
                'password' => Hash::make('1289..//**'),
                'mobile' => '09917230925',
                'role' => 'user',
            ],
            [
                'name' => 'John97',
                'first_name' => 'John',
                'last_name' => 'marston',
                'email' => 'john.marston1870@gmail.com',
                'password' => Hash::make('1289..//**'),
                'mobile' => '09917230922',
                'role' => 'user',
            ],
            [
                'name' => 'David',
                'first_name' => 'David120',
                'last_name' => 'Bombal',
                'email' => 'david.bombal11@gmail.com',
                'password' => Hash::make('1289..//**'),
                'mobile' => '09917230911',
                'role' => 'user',
            ],

        ];


        foreach ($users as $user) {
            User::create($user);
        }

         \App\Models\Product::factory(10)->create();
    }
}
