<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'application_number' => 'LA-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
            'status' => 'new_lead',
            'loan_type' => fake()->randomElement(['Personal Loan', 'Business Loan', 'Home Loan']),
            'loan_amount' => fake()->numberBetween(100000, 2500000),
            'loan_tenure' => fake()->randomElement(['12 Months', '24 Months', '36 Months', '60 Months']),
            'loan_purpose' => fake()->sentence(4),
            'employment_type' => fake()->randomElement(['Salaried', 'Self Employed', 'Business Owner']),
            'company_name' => fake()->company(),
            'monthly_income' => fake()->numberBetween(30000, 250000),
            'existing_emi' => fake()->numberBetween(0, 50000),
            'work_experience' => fake()->numberBetween(1, 12).' years',
            'contact_time' => fake()->randomElement(['Morning', 'Afternoon', 'Evening']),
            'submitted_at' => now(),
        ];
    }
}
