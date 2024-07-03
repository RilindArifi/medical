<?php

namespace Database\Factories;

use App\Enums\StatusGlobal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = StatusGlobal::values();
        $names = [1 => 'General Physician', 2 => 'Dentist', 3 => 'ENT', 4 => 'Cardiologist', 5 => 'Opthomology'];

        return [
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->text(10),
            'date' => $this->faker->date('Y-m-d'),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
