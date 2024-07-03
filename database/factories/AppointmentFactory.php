<?php

namespace Database\Factories;

use App\Enums\AppointmentStatus;
use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $doctorIds = User::role(RolesEnum::DOCTOR->value)->pluck('id');
        $patientIds = User::role(RolesEnum::PATIENT->value)->pluck('id');
        $statuses = AppointmentStatus::values();

        return [
            'doctor_id' => $this->faker->randomElement($doctorIds),
            'patient_id' => $this->faker->randomElement($patientIds),
            'date' => $this->faker->date(),
            'from' => $this->faker->time('H:i'),
            'to' => $this->faker->time('H:i'),
            'treatment' => $this->faker->text(10),
            'notes' => $this->faker->text(20),
            'status' => $this->faker->randomElement($statuses)
        ];
    }
}
