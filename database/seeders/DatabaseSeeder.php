<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // You can either use factories or directly call the seeder class
        $this->call([
            UserSeeder::class,  // Call UserSeeder
        ]);
    }
}
