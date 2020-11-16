<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Product_M;
use Illuminate\Database\Eloquent\Factories\Factory;

class Product_MFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product_M::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->sentence(2),
                'image' => $this->faker->image(),
                'price' => $this->faker->numberBetween(1,999999.99),
                'description' => $this->faker->paragraph(3),
        ];
    }
}
