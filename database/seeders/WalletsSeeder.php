<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsSeeder extends Seeder
{
    public function run()
    {
       $familyUsers = DB::table('users')->where('role', 'family')->get();

foreach ($familyUsers as $user) {
    DB::table('wallets')->insert([
        'user_id' => $user->id,
        'family_id' => $user->family_id,
        'balance' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

    }
}
