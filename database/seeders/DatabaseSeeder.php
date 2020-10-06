<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Fund;
use App\Models\Investment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ClientSeeder::class,
            FundSeeder::class,
        ]);
        foreach (Client::all() as $client) {
            $funds = Fund::whereIn('type', $client->permission)
                ->get();
            foreach ($funds as $fund) {
                Investment::factory()
                    ->state([
                        'client_id' => $client->id,
                        'fund_id' => $fund->id,
                    ])
                    ->create();
            }
        }
    }
}
