<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Test1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test3',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
            ],
        ];
        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'email' => $user['email'],
                ],
                [
                    'name' => $user['name'],
                    'password' => $user['password'],
                ]
            );
        }

        User::whereNotIn('email', array_column($users, 'email'))->delete();
    }
}
