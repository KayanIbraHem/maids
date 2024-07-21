<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Maid\Maid;
use function PHPSTORM_META\map;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nationality\Nationality;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maids')->delete();

        $nationalities = Nationality::all()->pluck('id', 'id')->toArray();
        $serviceTypes = ServiceType::all()->pluck('id', 'id')->toArray();

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Maid::create([
                'name' => $faker->name,
                'age' => $faker->numberBetween(20, 45),
                'image' => 'default/Maid/defaultUser.jpg',
                'cv' => 'default/Maid/defaultPdf.pdf',
                'nationality_id' => $nationalities[array_rand($nationalities)],
                'service_type_id' => $serviceTypes[array_rand($serviceTypes)]
            ]);
        }
    }
}
