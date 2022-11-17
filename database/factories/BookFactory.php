<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'category' => $this->faker->text(50),
            'book_image' => "Tess_the_TickTock_Dog.jpg",
            'description' => $this->faker->text(200),
            'author' => $this->faker->name
            // Note I could add the PublisherId here, but I've chosen to do this using
            // a 'magic method' hasBooks() in the PublisherSeeder.
        ];
    }
}
