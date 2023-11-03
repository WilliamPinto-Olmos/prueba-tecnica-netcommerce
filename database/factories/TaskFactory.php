<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shouldBeExpired = fake()->boolean();

        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(5),
            'user_id' => User::factory()->create()->id,
            'company_id' => Company::factory()->create()->id,
            'is_completed' => fake()->boolean(),
            // Ensures that an expiration date is never lower than the start date.
            'start_at' => fake()->dateTimeBetween('-2 weeks', '-1 week'),
            'expired_at' => $shouldBeExpired ? fake()->dateTimeBetween('-1 week', 'now') : null,
        ];
    }

    /**
     * Defines a state for expired tasks.
     */
    public function expired(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                // Ensures that an expiration date is never lower than the start date.
                'start_at' => fake()->dateTimeBetween('-2 weeks', '-1 week'),
                'expired_at' => fake()->dateTimeBetween('-1 week', 'now'),
            ];
        });
    }
}
