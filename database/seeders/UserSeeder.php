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
            'password' =>'admin009',
        ])->assignRole('admin');
        User::create([
            'name' => 'Srudent',
            'email' => 'srudent@gmail.com',
            'email_verified_at' => now(),
            'password' => 'student009',
            'roll_no' => '170118',
            'registration_no' => '101749',
        ])->assignRole('student');
        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'password' => 'staff009',
        ])->assignRole('staff');
        User::create([
            'name' => 'Professor',
            'email' => 'professor@gmail.com',
            'email_verified_at' => now(),
            'password' => 'professor009',
        ])->assignRole('professor');
    }
}
