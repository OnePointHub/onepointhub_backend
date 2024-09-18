<?php

use App\Models\Helpdesk\KbArticle;
use App\Models\Helpdesk\KbCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kb_article_kb_category', function (Blueprint $table) {
            $table->primary(['kb_article_id', 'kb_category_id']);
            $table->foreignIdFor(KbArticle::class);
            $table->foreignIdFor(KbCategory::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kb_article_kb_category');
    }
};
