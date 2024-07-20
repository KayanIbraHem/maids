<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nationality\Nationality;
use App\Models\ServiceType\ServiceType;
use App\Models\NationalityType\NationalityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NationalityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nationality_types')->delete();
        $nationalities = Nationality::all()->pluck('id', 'id');
        $serviceTypes = ServiceType::all()->pluck('id', 'id');

        $data = [];
        foreach ($nationalities as $nationalityId => $nationality) {
            foreach ($serviceTypes as $serviceTypeId => $serviceType) {
                $data[] = [
                    'nationality_id' => $nationalityId,
                    'service_type_id' => $serviceTypeId,
                    'price' => rand(100, 200),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        NationalityType::insert($data);
    }
}
