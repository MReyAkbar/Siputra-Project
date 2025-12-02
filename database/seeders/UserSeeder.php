<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['name' => 'Atmint', 'email' => 'admin@gmail.com', 'role' => 'admin', 'password' => \Hash::make('admin1234')],
            ['name' => 'Atmint2', 'email' => 'admin2@gmail.com', 'role' => 'admin', 'password' => \Hash::make('admin21234')],
            ['name' => 'Manager', 'email' => 'manager@gmail.com', 'role' => 'manager', 'password' => \Hash::make('manager1234')],
        ];

        foreach ($user as $u) {
            User::create($u);
        }
    }
}
