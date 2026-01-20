<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
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
                'unique:holidays,date,' . $this->holiday->id,
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
