<?php

namespace App\Http\Requests\Helpdesk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KbCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:kb_categories,name',
                'string',
                'min:3',
                'max:255',
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
