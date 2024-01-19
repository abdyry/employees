<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class DepositsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $employeeIds = DB::table('employees')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('deposits')->insert([
                'employee_id' => $faker->randomElement($employeeIds),
                'amount' => $faker->randomFloat(2, 100, 1000),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
