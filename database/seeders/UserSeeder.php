<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Maid\Maid;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->safeEmail,
                'password' => hashUserPassword('password'),
                'phone' => $faker->phoneNumber,
                'image' => 'default/User/defaultUser.jpg',
                'api_token' => hashApiToken(),
                'email_verified_at' => now(),
            ]);
        }
    }
}
