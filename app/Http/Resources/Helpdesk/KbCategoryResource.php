<?php

namespace App\Http\Resources\Helpdesk;

use App\Models\Helpdesk\KbCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin KbCategory */
class KbCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'articles' => $this->kb_articles,
        ];
    }
}
