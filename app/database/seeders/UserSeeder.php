<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // inisiasi faker
        $faker = Faker::create('id_ID');

        // username, name, email, password, department_id, role
        for ($i=0; $i < 20; $i++) { 
            DB::table('users')->insert([
                'username' => $faker->username,
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'department_id' => $faker->randomElement([1, 2, 3]),
                'role' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
