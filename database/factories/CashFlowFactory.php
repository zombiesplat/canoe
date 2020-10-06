<?php

namespace Database\Factories;

use App\Models\CashFlow;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashFlowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CashFlow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'investment_id' => Investment::factory(),
            'date' => $this->faker->dateTimeThisMonth,
            'return' => $this->faker->numberBetween(1, 15),
        ];
    }
}
