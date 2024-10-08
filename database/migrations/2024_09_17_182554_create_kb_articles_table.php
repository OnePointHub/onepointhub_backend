<?php

use App\Models\Helpdesk\KbCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kb_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained((new KbCategory())->getTable());
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->boolean('published_at')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kb_articles');
    }
};
