<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // A company name must be unique.
        do {
            $name = fake()->company() . ' ' . fake()->companySuffix();
        } while (Company::where('name', $name)->exists());

        return [
            'name' => $name,
        ];
    }
}
