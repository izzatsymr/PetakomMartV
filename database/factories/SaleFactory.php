<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subtotal_sales' => $this->faker->randomNumber(2),
            'service_tax' => $this->faker->randomNumber(2),
            'total_sales' => $this->faker->randomNumber(2),
            'status' => 'completed',
            'refunded_reason' => $this->faker->text,
            'payment_method_id' => PaymentMethod::inRandomOrder()->pluck('id')->first(),
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
