<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveNewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'body'         => ['nullable', 'string'],
            'published_at' => ['required', 'date'],
            'image_path'   => ['nullable', 'string'],
        ];
    }
}
