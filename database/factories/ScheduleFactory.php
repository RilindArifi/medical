<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Enums\StatusGlobal;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctorIds = User::role(RolesEnum::DOCTOR->value)->pluck('id');
        $statuses = StatusGlobal::values();
        $daysOfWeek = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];

        return [
            'doctor_id' => $this->faker->randomElement($doctorIds),
            'available_days' => json_encode($daysOfWeek),
            'from' => $this->faker->time('H:i'),
            'to' => $this->faker->time('H:i'),
            'notes' => $this->faker->text(20),
            'status' => $this->faker->randomElement($statuses)
        ];

    }
}
