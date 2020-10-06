<?php

namespace Database\Seeders;

use App\Models\Fund;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Fund::TYPES as $fund_type) {
            Fund::factory()
                ->state(['type' => $fund_type])
                ->create();
        }
    }
}
