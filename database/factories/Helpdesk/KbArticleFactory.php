<?php

namespace Database\Factories\Helpdesk;

use App\Models\Helpdesk\KbArticle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class KbArticleFactory extends Factory
{
    protected $model = KbArticle::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
//            'published_at' => $this->faker->dateTime(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
