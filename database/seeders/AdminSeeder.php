<?php

namespace Database\Seeders;

use App\Enums\AdminType;
use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->delete();

        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            // 'password' => hash_user_password('password'),
            'type' => AdminType::SUPER_ADMIN->value,
            'api_token' => Hash::make(rand(99, 99999999)),
        ]);
    }
}
