<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Group;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin creation
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.test',
            'user_role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // creation of 5 groups of 10 students
        $groups = Group::factory(5)->create();

        // creation of 10 professors
        User::factory(10)->create([
            'group_id' => null,
            'user_role' => 'prof',
        ]);

        // creating 10 students each for one group
        foreach ($groups as $group) {
            User::factory(10)->create([
                'group_id' => $group->id,
                'user_role' => 'stud',
            ]);
        }

        // demo accounts creation
        User::factory()->create([
            'name' => 'Demo Administrator',
            'email' => 'demo_admin@test.test',
            'user_role' => 'admin',
            'password' => Hash::make('demo_password')
        ]);

        User::factory()->create([
            'name' => fake()->name,
            'email' => 'demo_prof@test.test',
            'user_role' => 'prof',
            'password' => Hash::make('demo_password')
        ]);

        User::factory()->create([
            'name' => fake()->name,
            'email' => 'demo_stud@test.test',
            'user_role' => 'stud',
            'group_id' => $groups->first()->id,
            'password' => Hash::make('demo_password')
        ]);

        $classrooms = Classroom::factory(10)->create();
        $subjects = Subject::factory(10)->create();

        foreach ($groups as $group) {
            $days = [1, 2, 3, 4, 5];
            shuffle($days);
            $selectedDays = array_slice($days, 0, rand(3, 5));

            foreach ($selectedDays as $day) {
                $hours = [8, 10, 12, 14];
                shuffle($hours);
                $selectedHours = array_slice($hours, 0, rand(2, 4));

                foreach ($selectedHours as $hour) {
                    $startTime = sprintf('%02d:00', $hour);
                    $endTime = sprintf('%02d:00', $hour + 2);

                    Timetable::create([
                        'group_id' => $group->id,
                        'subject_id' => $subjects->random()->id,
                        'classroom_id' => $classrooms->random()->id,
                        'course_type' => fake()->randomElement(['Course', 'Laboratory']),
                        'day_of_week' => $day,
                        'start_hour' => $startTime,
                        'end_hour' => $endTime,
                    ]);
                }
            }
        }


    }
}
