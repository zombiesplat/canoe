<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Fund;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'permission' => $this->faker->randomElements(
                Fund::TYPES,
                $this->faker->numberBetween(1, count(Fund::TYPES))
            ),
            'description' => $this->faker->sentence(3)
        ];
    }
}
