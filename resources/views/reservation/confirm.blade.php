@extends('layouts.app')
@section('title', 'ご予約')
@section('content')
<div class="min-h-screen flex justify-center px-4 pt-32">
    <div class="w-full max-w-3xl">

        {{-- フォーム本体 --}}
        <h1 class="text-center text-2xl font-semibold text-[#363427] mb-20">
            入力内容ご確認
        </h1>

        {{-- フォーム本体 --}}
        <div class="max-w-3xl mx-auto bg-[#F1ECEB] rounded-3xl px-10 py-16">

        <p class="text-center text-sm text-[#363427] mb-12 leading-relaxed">
            以下の内容でよろしければ、「送信する」ボタンを押してください。<br>
            内容に誤りがある場合は、「戻る」ボタンで戻ってご確認ください。
        </p>

        {{-- ご来店日時 --}}
        <div class="mb-12">
            <h2 class="text-sm mb-6">■ ご来店日時</h2>

  <div class="grid grid-cols-[160px_1fr] gap-y-4 text-sm max-w-md mx-auto">
    <div>来店日</div>
    <div>{{ \Carbon\Carbon::parse($data['date'])->format('Y/m/d') }}</div>

    <div>来店時間</div>
    <div>{{ $data['time'] }}</div>

    <div>人数</div>
    <div>{{ $data['people_count'] }}名</div>
</div>


        <hr class="border-[#363427]/30 my-12">

        {{-- お客様情報 --}}
        <div class="mb-12">
            <h2 class="text-sm mb-6">■ お客様情報</h2>

            <div class="grid grid-cols-[160px_1fr] gap-y-4 text-sm max-w-md mx-auto">

                <div>氏名</div>
                <div>{{ $data['name'] }}</div>

                <div>フリガナ</div>
                <div>{{ $data['name_kana'] }}</div>

                <div>電話番号</div>
                <div>{{ $data['phone'] }}</div>

                <div>メールアドレス</div>
                <div>{{ $data['email'] }}</div>
            </div>
        </div>

        <hr class="border-[#363427]/30 my-12">

        {{-- 備考 --}}
        <div class="mb-16">
            <h2 class="text-sm mb-6">■ ご要望など</h2>

            <div class="grid grid-cols-[160px_1fr] gap-y-4 text-sm max-w-md mx-auto">
            <div>備考欄</div>
            <div class="whitespace-pre-line">
                {{ $data['note'] ?? '—' }}
            </div>
        </div>
        </div>

        {{-- hidden --}}
        <form method="POST" action="{{ route('reservation.store') }}"
        class="flex justify-center gap-6">

            @csrf
            @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value ?? '' }}">
            @endforeach


            <button type="button"
                    onclick="history.back()"
                    class="px-10 h-11 rounded-lg bg-[#363427]/20 text-[#363427] text-sm">
                戻る
            </button>

            <button type="submit"
                    class="px-10 h-11 rounded-lg bg-[#363427] text-white text-sm">
                送信する
            </button>
        </form>

        </div>
    </div>
</div>
@endsection
