<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fund;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->domainName,
            'client_id' => Client::factory(),
            'fund_id' => Fund::factory(),
            'date' => $this->faker->dateTimeBetween('-5 months', '-1 day'),
            'amount' => $this->faker->numberBetween(10000, 100000000),
        ];
    }
}
