<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {


        // 🏠 إنشاء مستخدمي العائلات وربطهم
        $families = DB::table('families')->get();

        foreach ($families as $index => $family) {
            $userId = DB::table('users')->insertGetId([
                'name' => $family->alias,
                'email' => strtolower(str_replace(' ', '', $family->alias)) . $index . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'family',
                'family_id' => $family->id, // ربط المستخدم بالعائلة
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // إذا جدول families يحتوي على user_id يمكن تحديثه
            DB::table('families')->where('id', $family->id)->update([
                'user_id' => $userId
            ]);
        }

        // 👨‍💻 إضافة متبرعين
        DB::table('users')->insert([
            [
                'name' => 'Donor One',
                'email' => 'donor1@gmail.com',
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
           // 🛡️ إنشاء المسؤول
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
    }
}
