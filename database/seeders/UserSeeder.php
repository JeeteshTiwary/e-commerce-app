<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed a user with role_id = 1 (admin)
        $user = [
            'name' => 'Jmt Admin',
            'email' => 'jmt.admin@mailinator.com',
            'contact_no' => '9999999999',
            'address' => 'Narola Nashik',
            'password' => Hash::make('jmt.admin@mailinator.com'),
            'role_id' => 1,
        ];
        User::create($user);
    }
}