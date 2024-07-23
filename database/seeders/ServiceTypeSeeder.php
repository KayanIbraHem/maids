<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_types')->delete();
        $data = [
            'title_ar' =>  [
                'استقدام',
                'باقات شهرية',
                'نقل خدمات'
            ],
            'title_en' => [
                'Admission',
                'monthly packages',
                'transfer services'
            ],
        ];
        $numServiceTypes = count($data['title_ar']);
        for ($i = 0; $i < $numServiceTypes; $i++) {
            $serviceType = [];
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $serviceType[$localeCode] = [
                    'title' => $data['title_' . $localeCode][$i],
                ];
            }
            ServiceType::create($serviceType);
        }
    }
}
