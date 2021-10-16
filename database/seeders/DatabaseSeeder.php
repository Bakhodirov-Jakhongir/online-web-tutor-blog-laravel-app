<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        // Product::factory(500)->create();
        // Student::factory(100)->create();
    }
}
