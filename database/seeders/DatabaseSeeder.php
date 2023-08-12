<?php

namespace Database\Seeders;
use DB;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('student_data')->insert([
            'studentname' => 'testseeder1',
            'email' => 'testseeder1@gmail.com',
            'department' => 'IT',
        ]);
        DB::table('student_data')->insert([
            'studentname' => 'testseeder1',
            'email' => 'testseeder2@gmail.com',
            'department' => 'IT',
        ]);

    }
}
