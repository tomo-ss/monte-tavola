<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Holiday;

class StoreHolidayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
                // 重複登録不可
                'unique:holidays,date',
            ],
            'type' => [
                'required',
                'string',
                'in:定休日,臨時休業',
            ],
            'note' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }
}
