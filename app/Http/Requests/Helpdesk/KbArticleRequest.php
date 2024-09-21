<?php

namespace App\Http\Requests\Helpdesk;

use Illuminate\Foundation\Http\FormRequest;

class KbArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'body' => [
                'required',
                'string',
            ],
            'category_id' => [
                'required',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
