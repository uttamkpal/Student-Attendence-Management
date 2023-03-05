<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin009'),
        ])->assignRole('admin');
        User::create([
            'name' => 'Srudent',
            'email' => 'srudent@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('student009'),
        ])->assignRole('student');
        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('staff009'),
        ])->assignRole('staff');
        User::create([
            'name' => 'Professor',
            'email' => 'professor@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('professor009'),
        ])->assignRole('professor');
    }
}
