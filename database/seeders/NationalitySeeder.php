<?php

namespace Database\Seeders;

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
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $titles[$localeCode] = [
                    'title' => $data['title_' . $localeCode][$i],
                ];
            }
            Nationality::create($titles);
        }
    }
}
