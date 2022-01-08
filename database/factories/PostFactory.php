<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(),
            'excerpt' => '<p>' . implode('</p><p>', [$this->faker->paragraph, $this->faker->paragraph]) . '</p>',
            'body' => $this->faker->paragraph(),
            'slug' => $this->faker->slug(),
        ];
    }
}
