<?php

namespace Database\Factories;

use App\Models\Fabric;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FabricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fabric::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fabric_no' => $this->faker->unique()->numerify('FAB-####'),
            'composition' => $this->faker->word,
            'gsm' => $this->faker->numberBetween(100, 500),
            'qty' => $this->faker->randomFloat(2, 100, 1000),
            'cuttable_width' => $this->faker->numberBetween(100, 200) . 'cm',
            'production_type' => $this->faker->randomElement(['Sample Yardage', 'SMS', 'Bulk']),
            'image_path' => $this->faker->imageUrl(),
            'barcode' => $this->faker->unique()->ean13,
            'supplier_id' => Supplier::factory(),
            'added_by' => User::factory(),
        ];
    }
}