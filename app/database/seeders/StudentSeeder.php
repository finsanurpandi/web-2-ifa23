<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // npm, address, advisor_id, user_id

        // filter data user by role = 1
        $users = DB::table('users')->where('role', 1)->get();

        // inisiasi faker
        $faker = Faker::create('it_IT');

        foreach($users as $user) {
            $lecturer = DB::table('users')
                            ->where(['role' => 0, 'department_id' => $user->department_id])
                            ->inRandomOrder()
                            ->first();
            $advisor = DB::table('lecturers')->where('user_id', $lecturer->id)->first();
            $department = DB::table('departments')->where('id', $user->department_id)->first();
            $year = rand(2020, 2025);
            $reg = rand(1, 300);

            DB::table('students')->insert([
                'npm' => $department->code.''.substr($year, -2).''.sprintf('%03d', $reg),
                'address' => $faker->address,
                'advisor_id' => $advisor->nidn,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
