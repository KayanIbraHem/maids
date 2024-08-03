<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\NationalitySeeder;
use Database\Seeders\ServiceTypeSeeder;
use Database\Seeders\NationalityTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminSeeder::class,
            ServiceTypeSeeder::class,
            NationalitySeeder::class,
            NationalityTypeSeeder::class,
            MaidSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class
        ]);
    }
}
