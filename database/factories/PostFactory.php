<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    // Specify the model that this factory is for.
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            // Create a new user using the User factory
            'user_id'     => User::factory(),
            'title'       => $this->faker->unique()->sentence(6),
            'description' => $this->faker->paragraph(4),
            'created_at'  => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
