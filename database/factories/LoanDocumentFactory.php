<?php

namespace Database\Factories;

use App\Models\LoanApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanDocument>
 */
class LoanDocumentFactory extends Factory
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
            'type' => fake()->randomElement(['PAN Card', 'Aadhaar Card', 'Income Proof', 'Bank Statement']),
            'original_name' => fake()->word().'.pdf',
            'path' => 'loan-documents/example.pdf',
            'status' => 'pending',
        ];
    }
}
