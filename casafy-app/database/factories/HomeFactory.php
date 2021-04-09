<?php

namespace Database\Factories;

use App\Models\Home;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Home::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        try {
            $owner_id = Owner::all()->random()->id;
        } catch (\Exception $th) {
            $owner_id = Owner::factory()->create()->id;
        }
        return [
            'address' => $this->faker->address,
            'bedrooms' => $this->faker->numberBetween($min = 1, $max = 4),
            'bathrooms' => $this->faker->numberBetween($min = 1, $max = 3),
            'total_area' => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 45, $max = 400),
            'purcharsed' => $this->faker->randomElement($array = array (True, False)),
            'value' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 120000, $max = 2000000),
            'discount' => $this->faker->numberBetween($min = 1, $max = 99),
            'owner_id' => $owner_id
        ];
    }
}
