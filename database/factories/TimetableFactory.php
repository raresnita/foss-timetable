<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Group;
use App\Models\Subject;
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
            'start_hour' => fake()->randomElement([8, 10, 12, 14, 16]),
            'end_hour' => function (array $attributes) {
                return $attributes['start_hour'] + 2;
            },
        ];
    }
}
