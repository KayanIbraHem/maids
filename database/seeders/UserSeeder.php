<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => hashUserPassword('password'),
                'phone' => $faker->phoneNumber,
                'country_code' => $faker->countryCode,
                'is_phone_verified' => 1,
                'image' => 'default/User/defaultUser.jpg',
                'email_verified_at' => now(),
            ]);
        }
    }
}
