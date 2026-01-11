<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->randomElement([
                'Databases',
                'Advanced Web Development',
                'Mobile Application Development',
                'Operating Systems & Kernel Arch',
                'Cyber Security',
                'Software Engineering Patterns',
                'UI/UX Design & Graphics',
                'Cloud Computing Services',
                'Artificial Intelligence',
                'Data Structures & Algorithms',
                'Computer Networks',
                'Functional Programming',
                'Parallel & Distributed Systems'
            ]),
            'professor_id' => User::where('user_role', 'prof')->inRandomOrder()->first()->id,
        ];
    }
}
