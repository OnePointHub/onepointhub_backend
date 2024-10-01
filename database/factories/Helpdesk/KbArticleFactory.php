<?php

namespace Database\Factories\Helpdesk;

use App\Models\Helpdesk\KbArticle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class KbArticleFactory extends Factory
{
    protected $model = KbArticle::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'author_id' => User::factory()->create(),
            'body' => $this->faker->paragraph(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
