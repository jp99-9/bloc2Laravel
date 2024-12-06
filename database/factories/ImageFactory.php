<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'url' =>fake()->imageUrl(),
            'comment_id' => Comment::inRandomOrder()->first()->id,           
        ];
    }
}
