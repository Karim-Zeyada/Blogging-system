<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Add PostSeeder to seed 500 posts.
        $this->call([
            PostSeeder::class,
        ]);
    }
}
