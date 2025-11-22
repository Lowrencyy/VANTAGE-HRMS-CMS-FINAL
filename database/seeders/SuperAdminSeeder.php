<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'laurence@superadmin.com')->exists()) {
            User::create([
                'name' => 'Mark Laurence Laurio Tomenio',
                'email' => 'laurence@superadmin.com',
                'password' => bcrypt('L@urence@2025!'),
                'role_name' => 'SuperAdmin',
                'status' => 'Active'
            ]);
        }
    }
}
