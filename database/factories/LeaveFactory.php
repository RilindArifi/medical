<?php

namespace Database\Factories;

use App\Enums\LeaveStatus;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id');
        $leaveTypeId = LeaveType::pluck('id');
        $statuses = LeaveStatus::values();


        return [
            'user_id' => $this->faker->randomElement($userIds),
            'leave_type_id' => $this->faker->randomElement($leaveTypeId),
            'days' => $this->faker->randomNumber(5,10),
            'duration' => $this->faker->randomNumber(5,10),
            'from' => $this->faker->date('Y-m-d'),
            'to' => $this->faker->date('Y-m-d'),
            'reason' => $this->faker->text(10),
            'status' => $this->faker->randomElement($statuses)
        ];
    }
}
