<?php

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
        $this->call(UserSeeder::class);
        $this->call(PostalCodeSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SchoolSeeder2::class);
        $this->call(EventTypeSeeder::class);
    }
}
