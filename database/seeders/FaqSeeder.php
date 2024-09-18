<?php

namespace Database\Seeders;

use App\Models\Helpdesk\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::factory(20)->create();
    }
}
