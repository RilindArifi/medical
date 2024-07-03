<?php

namespace Database\Factories;

use App\Enums\StatusGlobal;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = Department::pluck('id');
        $statuses = StatusGlobal::values();

        return [
            'department_id' => $this->faker->randomElement($departments),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email'     => $this->faker->email(),
            'password'  => $this->faker->password(),
            'mobile'   => $this->faker->phoneNumber(),
            'education'   => $this->faker->text(5),
            'status'   => $this->faker->randomElement($statuses)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
