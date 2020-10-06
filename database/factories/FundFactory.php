<?php

namespace Database\Factories;

use App\Models\Fund;
use Illuminate\Database\Eloquent\Factories\Factory;

class FundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fund::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'type' => $this->faker->randomElement(Fund::TYPES),
            'inception_date' => $this->faker->dateTimeInInterval('-1 year', '-1 day'),
            'description' => $this->faker->sentence(4),
        ];
    }
}
