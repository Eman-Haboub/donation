<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {

        if (!DB::table('users')->where('email', 'admin@example.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 🏠 عائلات — نربط كل مستخدم بعائلة من جدول families
        $families = DB::table('families')->get();

       foreach ($families as $index => $family) {
    DB::table('users')->insert([
        'name' => $family->alias,
        'email' => strtolower(str_replace(' ', '', $family->alias)) . $index . '@example.com',
        'password' => Hash::make('password'),
        'role' => 'family',
        'family_id' => $family->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}



        // 👨‍💻 متبرعين
        DB::table('users')->insert([
            [
                'name' => 'Donor One',
                'email' => 'donor1@example.com',
                'password' => Hash::make('password'),
                'role' => 'donor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Donor Two',
                'email' => 'donor2@example.com',
                'password' => Hash::make('password'),
                'role' => 'donor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
