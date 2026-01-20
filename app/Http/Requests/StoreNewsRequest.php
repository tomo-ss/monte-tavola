<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'image'        => ['nullable', 'image'],

            // confirm→store で受け渡す一時パス用
            'image_path'   => ['nullable', 'string'],
        ];
    }
}
