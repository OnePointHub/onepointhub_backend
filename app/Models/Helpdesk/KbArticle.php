<?php

namespace App\Models\Helpdesk;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KbArticle extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'body',
        'published_at',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The categories that belong to this article.
     */
    public function kb_categories(): BelongsToMany
    {
        return $this->belongsToMany(KbCategory::class, 'kb_article_kb_category');
    }

}
