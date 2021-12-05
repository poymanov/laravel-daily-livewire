<?php

namespace Database\Factories;

use App\Models\Product;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stockDate = new DateTime();

        return [
            'name'        => $this->faker->sentence,
            'description' => $this->faker->text,
            'color'       => $this->faker->randomElement(array_keys(Product::COLORS_LIST)),
            'stock_date'  => $stockDate->format('m/d/Y'),
            'photo'       => $this->faker->image,
        ];
    }
}
