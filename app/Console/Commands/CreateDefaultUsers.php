<?php

namespace App\Console\Commands;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateDefaultUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the default users in the system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create the default editor account
        User::create([
            'firstname' => 'Default',
            'lastname' => 'Editor',
            'name' => 'Default Editor',
            'type' => UserType::EDITOR,
            'status' => UserStatus::ACTIVE,
            'email' => 'default.editor@example.com',
            'password' => Hash::make('password')
        ]);

        // Create the default writer account
        User::create([
            'firstname' => 'Default',
            'lastname' => 'Writer',
            'name' => 'Default Writer',
            'type' => UserType::WRITER,
            'status' => UserStatus::ACTIVE,
            'email' => 'default.writer@example.com',
            'password' => Hash::make('password')
        ]);
    }
}
