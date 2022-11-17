<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Publisher;
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
      //  $this->call(BookSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // I only need to call the PublisherSeeder, this calls hasBooks() which
        // seeds the books table with 20 books for each Publisher.
        $this->call(PublisherSeeder::class);

    }
}
