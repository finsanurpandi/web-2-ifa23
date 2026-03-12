<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // filter data user by role = 0
        $users = DB::table('users')->where('role', 0)->get();

        // inisiasi faker
        $faker = Faker::create('it_IT');

        // pembuatan data
        foreach ($users as $user) {
            // nidn, address, user_id
            DB::table('lecturers')->insert([
                'nidn' =>rand(1111111111, 9999999999),
                'address' => $faker->address,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
