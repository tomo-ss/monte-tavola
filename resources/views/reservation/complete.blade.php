@extends('layouts.app')
@section('title', 'ご予約')
@php
    $reservation = session('reservation');
@endphp


@section('content')
<div class="min-h-screen flex justify-center px-4 pt-32">
    <div class="w-full max-w-2xl text-center">

        <h1 class="text-2xl font-semibold text-[#363427] mb-6">
            以下の内容でご予約を承りました。
        </h1>

        <p class="text-sm text-[#363427] mb-16 leading-relaxed">
            ご来店を心よりお待ちしております。
        </p>

        <div class="bg-[#F1ECEB] rounded-3xl px-10 py-12 mb-16">
            <div class="grid grid-cols-[120px_1fr] gap-y-4 text-sm max-w-sm mx-auto text-left text-[#363427]">

                <div>■来店日</div>
                <div>{{ \Carbon\Carbon::parse($reservation->date)->format('Y/m/d') }}</div>

                <div>■来店時間</div>
                <div>{{ $reservation->time }}</div>

                <div>■人数</div>
                <div>{{ $reservation->people_count }}名</div>

            </div>
        </div>

        <p class="text-xs text-[#363427] mb-16">
            ※ ご登録のメールアドレスへ確認メールをお送りしています。
        </p>

        <a href="{{ route('top') }}"
           class="inline-flex items-center justify-center h-11 px-14 rounded-[10px]
                  bg-[#363427] text-white text-sm tracking-wider hover:opacity-80 transition">
            TOPへ戻る
        </a>

    </div>
</div>
@endsection
