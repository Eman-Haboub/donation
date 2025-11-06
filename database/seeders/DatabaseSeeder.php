<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            FamiliesSeeder::class,       // أولًا العائلات
            UsersSeeder::class,          // ثانيًا المستخدمين المرتبطين بالعائلات
            WalletsSeeder::class,        // ثم المحافظ
            // WalletTransactionsSeeder::class,
            RolesAndUsersSeeder::class, // الأدوار والمستخدمين
            NewsSeeder::class,


        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
