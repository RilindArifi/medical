<?php

namespace Database\Factories;

use App\Enums\StatusGlobal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $leave_types = ['Medical Leave', 'Casual Leave', 'Loss of Pay'];
        $statuses    = StatusGlobal::values();

        return [
            'name' => $this->faker->randomElement($leave_types),
            'status' => $this->faker->randomElement($statuses)
        ];
    }
}
