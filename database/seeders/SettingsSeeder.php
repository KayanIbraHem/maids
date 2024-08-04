<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceType\ServiceType;
use App\Models\Settings\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();
        Settings::create([
            'name' => 'Maids',
            'phone' => '0100000000',
            'address' => 'Egypt',
            'whatsapp' => '0100000000',
            'facebook' => 'https://www.facebook.com/',
            'x' => 'https://x.com/',
            'youtube' => 'https://www.youtube.com/',
            'instagram' => 'https://www.instagram.com/',
            'linkedin' => 'https://www.linkedin.com/',
        ]);
    }
}
