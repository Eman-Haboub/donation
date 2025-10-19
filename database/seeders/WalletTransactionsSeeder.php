<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletTransactionsSeeder extends Seeder
{
    public function run()
    {
       $wallets = DB::table('wallets')->get();

foreach ($wallets as $wallet) {
    DB::table('wallet_transactions')->insert([
        [
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount' => 50,
            'description' => 'Initial deposit',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'wallet_id' => $wallet->id,
            'type' => 'donation',
            'amount' => 20,
            'description' => 'Donation to another family',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

    }
}
