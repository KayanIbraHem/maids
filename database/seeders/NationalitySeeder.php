<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Handler\TitleLocalcodeHandler;
use App\Models\Nationality\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        DB::table('nationalities')->delete();
        $data = [
            'title_ar' =>  [
                'الفلبين',
                'سنغافورة',
                'باكستان',
                'اليمن',
                'إثيوبيا',
                'الهند',
                'بنجلاديش',
                'السودان',
            ],
            'title_en' => [
                'Philippine',
                'Singapore',
                'Pakistan',
                'Yemen',
                'Ethiopia',
                'India',
                'Bangladesh',
                'Sudan',
            ],
        ];

        $count = count($data['title_ar']);
        for ($i = 0; $i < $count; $i++) {

            $data['code'] = $faker->countryCode;
            $data['flag'] = 'default/Flag/defaultFlag.jpg';

            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $nationalityData[$localeCode] = [
                    'title' => $data['title_' . $localeCode][$i],
                ];
            }

            $nationalityData['code'] = $data['code'];
            $nationalityData['flag'] = $data['flag'];

            Nationality::create($nationalityData);
        }
    }
}
