<?php

namespace Database\Seeders;

use App\Models\Helpdesk\KbArticle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class kbArticleSeeder extends Seeder
{
    public function run(): void
    {
        kbArticle::factory(30)->create();
        kbArticle::factory(20)->create([
            'published_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
