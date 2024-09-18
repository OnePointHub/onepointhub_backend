<?php

namespace Database\Seeders;

use App\Models\Helpdesk\KbArticle;
use Illuminate\Database\Seeder;

class kbArticleSeeder extends Seeder
{
    public function run(): void
    {
        kbArticle::factory(50)->create();
    }
}
