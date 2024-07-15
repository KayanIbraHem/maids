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
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'password' => hashUserPassword('password'),
            'image' => 'uploads/admin/default_admin_image.png',
            'type' => AdminType::SUPER_ADMIN->value,
            'api_token' => '$2y$12$GRMRr9/TCYLi3qKRdWdb.ucZkuoxSq5BNQeC4tan4ADOoNTvXNmGK',
        ]);
    }
}
