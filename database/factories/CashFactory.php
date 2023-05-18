<?php

namespace Database\Factories;

use App\Models\Cash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CashFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cash::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'opening_cash' => $this->faker->randomNumber(2),
            'closing_cash' => $this->faker->randomNumber(2),
            'short_cash' => $this->faker->randomNumber(2),
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
