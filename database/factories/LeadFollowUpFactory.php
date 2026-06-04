<?php

namespace Database\Factories;

use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadFollowUp>
 */
class LeadFollowUpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'loan_application_id' => LoanApplication::factory(),
            'user_id' => User::factory(),
            'type' => fake()->randomElement(['note', 'call', 'email', 'visit']),
            'note' => fake()->paragraph(),
            'next_follow_up_at' => fake()->optional()->dateTimeBetween('now', '+10 days'),
        ];
    }
}
