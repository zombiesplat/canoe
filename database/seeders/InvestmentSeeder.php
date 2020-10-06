<?php

namespace Database\Seeders;

use App\Models\CashFlow;
use App\Models\Investment;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investment::factory()
            ->has(CashFlow::factory()->count(random_int(1,8)))
            ->times(5)
            ->create();
    }
}
