<?php

namespace App\Http\Resources\Helpdesk;

use App\Models\Helpdesk\KbArticle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin KbArticle */
class KbArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => $this->category,
            'author' => $this->author
        ];
    }
}
