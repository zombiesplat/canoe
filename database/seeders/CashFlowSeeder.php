<?php

namespace Database\Seeders;

use App\Models\CashFlow;
use App\Models\Investment;
use Illuminate\Database\Seeder;

class CashFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CashFlow::factory()
            ->count(5)
            ->for(Investment::factory())
            ->create();
    }
}
