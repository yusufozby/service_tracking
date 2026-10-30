<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Personel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->word(),
            'model'=>fake()->word(),
            'type'=>fake()->word(),
            'serial_no'=>fake()->unique()->numerify('SN-######'),
            'status'=>fake()->randomElement(['active','passive']),
            'personel_id'=>Personel::inRandomOrder()->value('id')
            //
        ];
    }
}
