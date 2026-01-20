@extends('layouts.app')
@section('title', 'お問い合わせ')
@section('content')
<div class="py-16">
    
    {{--  タイトル  --}}
    <div class="max-w-3xl mx-auto mt-20 mb-6 text-center">
    <h1 class="font-serif text-3xl md:text-4xl font-semibold text-[#363427]">
        Contact
    </h1>
    <p class="mt-2 text-sm text-[#363427]">
        お問い合わせ
    </p>
    </div>


    {{-- フォームの背景 --}}
    <div class="max-w-3xl mx-auto bg-[#F1ECEB] p-10 rounded-2xl shadow-sm">

        {{-- 説明文 --}}
        <div class="text-center text-sm text-[#363427] leading-relaxed mb-10">
            <p>ご予約以外のお問い合わせについてはこちらからお願いいたします。</p>
            <p>アレルギーや食材の確認、取材・ご協力の依頼などもこちらからお気軽にどうぞ。</p>
            <p class="mt-4">
                ※内容によっては返信にお時間をいただく場合がございます。<br>
                ※営業中・営業時間外のお問い合わせは、営業日以降にご返信いたします。
            </p>
        </div>

    {{-- エラー表示 --}}
    @if ($errors->any())
    <div class="max-w-3xl mx-auto mb-8 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
        <ul class="list-disc pl-5 space-y-1">
        @php
            $order = [
            'name',
            'email',
            'subject',
            'message',
            ];
        @endphp

        @foreach ($order as $field)
            @error($field)
            <li>{{ $message }}</li>
            @enderror
        @endforeach
        </ul>
    </div>
    @endif


        {{-- フォーム --}}
        <form action="{{ route('contact.confirm') }}" method="POST" class="space-y-6" novalidate>
            @csrf

            {{-- 氏名 --}}
            <div>
                <label class="block font-medium text-[#363427] mb-2">
                    氏名
                    <span class="ml-2 bg-[#363427] text-white text-xs px-2 py-1 rounded">必須</span>
                </label>
                <input type="text" 
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border border-[#D6D3CE] p-3 rounded bg-[#F8F8F8] focus:ring-2 focus:ring-[#363427]"
                    placeholder="例）山中 三郎">
            </div>

            {{-- メールアドレス --}}
            <div>
                <label class="block font-medium text-[#363427] mb-2">
                    メールアドレス
                    <span class="ml-2 bg-[#363427] text-white text-xs px-2 py-1 rounded">必須</span>
                </label>
                <input type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border border-[#D6D3CE] p-3 rounded bg-[#F8F8F8] focus:ring-2 focus:ring-[#363427]"
                    placeholder="例）yamanaka@example.com">
            </div>

            {{-- 件名 --}}
            <div>
                <label class="block font-medium text-[#363427] mb-2">
                    件名
                    <span class="ml-2 bg-[#363427] text-white text-xs px-2 py-1 rounded">必須</span>
                </label>
                <input type="text" 
                        name="subject"
                        value="{{ old('subject') }}"
                        placeholder="例）アレルギーについてのご相談"
                        class="w-full border border-[#D6D3CE] p-3 rounded bg-[#F8F8F8] focus:ring-2 focus:ring-[#363427]">
                 </div>

            {{-- 本文 --}}
            <div>
                <label class="block font-medium text-[#363427] mb-2">
                    本文
                    <span class="ml-2 bg-[#363427] text-white text-xs px-2 py-1 rounded">必須</span>
                </label>
                <textarea 
                    name="message" 
                    rows="10"
                    placeholder="例）卵が含まれているメニューを教えてください。"
                    class="w-full border border-[#D6D3CE] p-3 rounded bg-[#F8F8F8] focus:ring-2 focus:ring-[#363427]">{{ old('message') }}</textarea>

            </div>

            {{-- ボタン --}}
            <div class="text-center mt-10">
                <button type="submit"
                    class="bg-[#363427] text-white py-3 px-10 rounded hover:opacity-80 transition">
                    確認画面へ
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
