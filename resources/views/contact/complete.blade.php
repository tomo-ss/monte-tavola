@extends('layouts.app')

@section('content')
<div class="pt-52 pb-60">

    {{-- 上のタイトル --}}
    <h1 class="text-center text-2xl font-semibold text-[#363427] tracking-wide mb-48">
        お問い合わせ完了
    </h1>

    {{-- メッセージ（中央寄せ気味） --}}
    <div class="text-center mb-52">  {{-- ← この余白も大きく --}}
        <p class="text-[#363427] text-2xl font-medium mb-6">
            お問い合わせを受け付けました。
        </p>
        <p class="text-[#363427] text-base leading-relaxed">
            内容確認のうえ、担当者よりご連絡いたします。
        </p>
    </div>

    {{-- TOPへ戻る --}}
    <div class="text-center">
        <a href="{{ url('/') }}"
           class="py-3 px-14 bg-[#363427] text-white rounded hover:opacity-80 transition text-sm tracking-wide">
            TOPへ戻る
        </a>
    </div>

</div>
@endsection
