<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country,
            'company_name' => $this->faker->company,
            'code' => $this->faker->unique()->swiftBicNumber,
            'added_by' => User::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'representative_name' => $this->faker->name,
            'representative_email' => $this->faker->unique()->safeEmail,
            'representative_phone' => $this->faker->phoneNumber,
        ];
    }
}