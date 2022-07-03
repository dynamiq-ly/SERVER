<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReminderCallController>
 */
class ReminderCallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reminder_title' => $this->faker->name(),
            'reminder_date' => $this->faker->date(),
            'reminder_priority' => 'minor'
        ];
    }
}
