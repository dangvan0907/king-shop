<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_login_id' => rand(1, 5),
            'status'        => rand(1, 5),
            'sub_total'     => rand(10000, 20000),
            'shipping'      => rand(100, 200),
            'total'         => rand(1000, 100000),
        ];
    }
}
