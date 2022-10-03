<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => rand(1, 10),
            'cart_id'    => rand(1, 5),
            'price'      => rand(10000, 20000),
            'quantity'   => rand(1, 10),
        ];
    }
}
