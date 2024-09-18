<?php

namespace Database\Seeders;

use App\Models\Helpdesk\KbCategory;
use Illuminate\Database\Seeder;

class KbCategorySeeder extends Seeder
{
    public function run(): void
    {
        KbCategory::factory(10)->create();
    }
}
