<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'お名前は必須です。',
            'name.max' => 'お名前は100文字以内で入力してください。',

            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',

            'subject.required' => '件名を入力してください。',
            'subject.max' => '件名は100文字以内で入力してください。',

            'message.required' => 'お問い合わせ内容を入力してください。',
            'message.max' => 'お問い合わせ内容は1000文字以内で入力してください。',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'subject' => '件名',
            'message' => 'お問い合わせ内容',
        ];
    }
}
