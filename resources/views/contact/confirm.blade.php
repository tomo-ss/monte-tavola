@extends('layouts.app')
@section('title', 'お問い合わせ')
@section('content')
<div class="py-20">

    {{-- タイトル --}}
    <h1 class="text-center text-2xl font-semibold text-[#363427] mb-10 mt-20">
        入力内容のご確認
    </h1>

    {{-- 確認画面背景 --}}
    <div class="max-w-4xl mx-auto bg-[#F1ECEB] p-12 rounded-2xl">

        {{-- 説明文（枠内） --}}
        <p class="text-center text-sm text-[#363427] leading-relaxed mb-12">
            以下の内容でよろしければ、「送信する」ボタンを押してください。<br>
            内容に誤りがある場合は、「戻る」ボタンでご確認ください。
        </p>

        {{-- 入力内容一覧 --}}
        <div class="space-y-10 mb-10 text-[#363427] max-w-2xl mx-auto">

            {{-- 氏名 --}}
            <div>
                <div class="flex items-start mb-3">
                    <span class="w-32 font-medium">氏名</span>
                    <span>{{ $inputs['name'] }}</span>
                </div>
                <div class="border-b border-[#D6D3CE]"></div>
            </div>

            {{-- メールアドレス --}}
            <div>
                <div class="flex items-start mb-3">
                    <span class="w-32 font-medium">メールアドレス</span>
                    <span>{{ $inputs['email'] }}</span>
                </div>
                <div class="border-b border-[#D6D3CE]"></div>
            </div>

            {{-- 件名 --}}
            <div>
                <div class="flex items-start mb-3">
                    <span class="w-32 font-medium">件名</span>
                    <span>{{ $inputs['subject'] }}</span>
                </div>
                <div class="border-b border-[#D6D3CE]"></div>
            </div>

            {{-- 本文 --}}
            <div>
                <div class="flex items-start mb-3">
                    <span class="w-32 font-medium">本文</span>
                    <span class="whitespace-pre-line">
                        {{ $inputs['message'] }}
                    </span>
                </div>
                <div class="border-b border-[#D6D3CE]"></div>
            </div>
        </div>

        {{-- ボタンエリア --}}
        <form action="{{ route('contact.complete') }}" method="POST" class="text-center">
            @csrf

            {{-- hidden項目（messageだけtextareaで保持） --}}
            @foreach ($inputs as $key => $value)
                @if ($key === 'message')
                    <textarea name="{{ $key }}" hidden>{{ $value }}</textarea>
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach

            <button
                type="submit"
                name="action"
                value="back"
                class="py-3 px-10 mr-5 bg-[#F8F8F8] border border-[#363427] text-[#363427] rounded hover:bg-[#e5e5e5] transition">
                戻る
            </button>

            <button
                type="submit"
                class="py-3 px-10 bg-[#363427] text-white rounded hover:opacity-80 transition">
                送信する
            </button>
        </form>

    </div>
</div>
@endsection
