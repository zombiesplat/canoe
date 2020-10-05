<?php

namespace Database\Factories;

use App\Models\Client;
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
                Client::PERMISSIONS,
                $this->faker->numberBetween(1, count(Client::PERMISSIONS))
            ),
            'description' => $this->faker->sentence(3)
        ];
    }
}
