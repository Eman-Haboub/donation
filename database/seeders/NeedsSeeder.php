<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeedsSeeder extends Seeder
{
    public function run()
    {
        DB::table('needs')->insert([
            [
                'family_id' => 1,
                'type' => 'rent',
                'description' => 'The family lost their house and urgently needs help paying rent for the next 3 months.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 1,
                'type' => 'food',
                'description' => 'Monthly food basket for 8 family members.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 2,
                'type' => 'food',
                'description' => 'Healthy meals and school supplies for 6 children.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 3,
                'type' => 'medicine',
                'description' => 'Medication for chronic illnesses for elderly couple.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 4,
                'type' => 'rent',
                'description' => 'Help covering tuition and school supplies for two children.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 5,
                'type' => 'medicine',
                'description' => 'Purchase of wheelchair and medical equipment for disabled young man.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'family_id' => 6,
                'type' => 'food',
                'description' => 'Urgent food assistance for large family facing hunger.',
                'fulfilled' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
