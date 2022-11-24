<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory()
        ->times(3)
        ->create();

        foreach(Book::all() as $book)
        {
            $authors = Author::inRandomOrder()->take(rand(1,3))->pluck('id');
            $book->authors()->attach($authors);
        }
    }
}
