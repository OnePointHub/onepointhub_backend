<?php

namespace Database\Seeders;

use App\Models\Helpdesk\KbCategory;
use Illuminate\Database\Seeder;

class KbCategorySeeder extends Seeder
{
    public function run(): void
    {
        KbCategory::factory()->create([
            'name' => 'Account',
        ]);

        KbCategory::factory()->create([
            'name' => 'Email',
        ]);

        KbCategory::factory()->create([
            'name' => 'Files',
        ]);

        KbCategory::factory()->create([
            'name' => 'Databases',
        ]);

        KbCategory::factory()->create([
            'name' => 'Webmail',
        ]);
    }
}
