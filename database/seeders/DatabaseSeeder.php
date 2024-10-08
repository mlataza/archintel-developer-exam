<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserType;
use App\Enums\UserStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'firstname' => 'Default',
            'lastname' => 'Editor',
            'name' => 'Default Editor',
            'type' => UserType::EDITOR,
            'status' => UserStatus::ACTIVE,
            'email' => 'default.editor@example.com'
        ]);

        User::factory()->create([
            'firstname' => 'Default',
            'lastname' => 'Writer',
            'name' => 'Default Writer',
            'type' => UserType::WRITER,
            'status' => UserStatus::ACTIVE,
            'email' => 'default.writer@example.com'
        ]);
    }
}
