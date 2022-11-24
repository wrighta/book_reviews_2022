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
        // PublisherSeeder calls hasBooks() which
        // seeds the books table with 20 books for each Publisher.
        $this->call(PublisherSeeder::class);
        // AuthorSeeder creates authors then gets all the books from the DB
        // and randomly assigns authors to many books
        $this->call(AuthorSeeder::class);
    }
}
