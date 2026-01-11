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
     * バリデーションエラーメッセージ（日本語）
     */
    public function messages(): array
    {
        return [
            'name.required' => 'お名前は必須です。',
            'name.string' => 'お名前は文字で入力してください。',
            'name.max' => 'お名前は100文字以内で入力してください。',

            'name_kana.required' => 'フリガナは必須です。',
            'name_kana.regex' => 'フリガナはカタカナで入力してください。',
            'name_kana.max' => 'フリガナは100文字以内で入力してください。',

            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',

            'phone.required' => '電話番号は必須です。',
            'phone.max' => '電話番号は20文字以内で入力してください。',

            'date.required' => '来店日を選択してください。',
            'date.date' => '正しい日付を選択してください。',

            'time.required' => '来店時間を選択してください。',

            'people_count.required' => '人数を選択してください。',

            'note.max' => '備考は1000文字以内で入力してください。',
        ];
    }

    /**
     * 属性名の日本語化
     */
    public function attributes(): array
    {
        return [
            'name' => 'お名前',
            'name_kana' => 'フリガナ',
            'email' => 'メールアドレス',
            'phone' => '電話番号',
            'date' => '来店日',
            'time' => '来店時間',
            'people_count' => '人数',
            'note' => '備考',
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
