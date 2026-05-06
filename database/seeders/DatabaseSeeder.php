<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
        * Remplit la base de donnees de l'application.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'John', 'email' => 'john@example.com', 'branche' => 'Equipe A'],
            ['name' => 'Jane', 'email' => 'jane@example.com', 'branche' => 'Equipe A'],
            ['name' => 'Alice', 'email' => 'alice@example.com', 'branche' => 'Equipe B'],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'branche' => 'Equipe B'],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'branche' => $userData['branche'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
