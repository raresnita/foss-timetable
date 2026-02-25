<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Group;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimetableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'group_id' => Group::inRandomOrder()->first()->id,
            'classroom_id' => Classroom::inRandomOrder()->first()->id,
            'course_type' => fake()->randomElement(['Course', 'Laboratory']),
            'day_of_week' => fake()->numberBetween(1, 5),
            'start_hour' => $start = fake()->randomElement(['08:00', '10:00', '12:00', '14:00', '16:00']),
            'end_hour' => Carbon::parse($start)->addHours(2)->format('H:i'),
        ];
    }
}
