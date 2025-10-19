<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $donorRole = Role::firstOrCreate(['name' => 'donor']);
        $familyRole = Role::firstOrCreate(['name' => 'family']);

        // إنشاء المستخدمين التجريبيين
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('123')]
        );
        $admin->assignRole($adminRole);

        $donor = User::firstOrCreate(
            ['email' => 'donor@example.com'],
            ['name' => 'Donor User', 'password' => Hash::make('123')]
        );
        $donor->assignRole($donorRole);

        $family = User::firstOrCreate(
            ['email' => 'family@example.com'],
            ['name' => 'Family User', 'password' => Hash::make('123')]
        );
        $family->assignRole($familyRole);
    }
}
