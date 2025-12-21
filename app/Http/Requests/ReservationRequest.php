<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reservation;
use App\Models\Holiday;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:100'],
            'name_kana'    => ['required', 'string', 'max:100', 'regex:/^[ァ-ヶー]+$/u'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['required', 'string', 'max:20'],
            'date'         => ['required', 'date'],
            'time'         => ['required'],
            'people_count' => ['required', 'integer', 'between:1,10'],
            'note'         => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * 追加バリデーション
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $date = $this->input('date');
            $time = $this->input('time');

            if (!$date || !$time) {
                return;
            }

            /**
             * ① 重複予約チェック
             */
            $exists = Reservation::where('date', $date)
                ->where('time', $time)
                ->where('status', '!=', 'キャンセル')
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'time',
                    'この日時はすでに予約が入っています。別の日時を選択してください。'
                );
            }

            /**
             * ② 休業日チェック
             */
            if (Holiday::where('date', $date)->exists()) {
                $validator->errors()->add(
                    'date',
                    '選択された日は休業日のため予約できません。'
                );
            }
        });
    }
}
