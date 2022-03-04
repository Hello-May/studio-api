<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    private static $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        return [
            'name' => $faker->name(),
            'index' => self::$index++,
            'category_id' => $faker->numberBetween(1, 3),
            'price' => $faker->randomNumber(),
            'description' => $faker->realText()
        ];
    }
}
