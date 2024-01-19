<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'abdi',
            'email' => 'abdi@gmail.com',
            'password' => 'password',
        ]);

        $this->call(EmployeesTableSeeder::class);
        $this->call(DepositsTableSeeder::class);
        $this->call(WithdrawTableSeeder::class);
    }
}
