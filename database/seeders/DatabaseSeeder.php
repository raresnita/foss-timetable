<?php

namespace Database\Seeders;

use App\Models\Group;
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
            'name'=> 'admin',
            'email' => 'admin@test.test',
            'user_role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // creation of 5 groups of 10 students
        $groups = Group::factory(5)->create();

        // creation of 7 professors
        User::factory(7)->create([
            'group_id' => null,
            'user_role' => 'prof',
        ]);

        foreach ($groups as $group) {
            User::factory(10)->create([
                'group_id' => $group->id,
                'user_role' => 'stud',
            ]);
        }
    }
}
