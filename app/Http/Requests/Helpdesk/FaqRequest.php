<?php

namespace App\Http\Requests\Helpdesk;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'answer' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'question' => [
                'required',
                'string',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
