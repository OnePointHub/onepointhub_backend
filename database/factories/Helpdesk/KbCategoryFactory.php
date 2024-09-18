<?php

namespace Database\Factories\Helpdesk;

use App\Models\Helpdesk\KbCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class KbCategoryFactory extends Factory
{
    protected $model = KbCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
