@extends('layouts.app')

@section('content')
<div class="pt-52 pb-60 px-4">

    <h1 class="text-center text-2xl font-semibold text-[#363427] tracking-wide mb-48">
        ご予約完了
    </h1>

    <div class="text-center mb-52">
        <p class="text-[#363427] text-2xl font-medium mb-6">
            ご予約を受け付けました。
        </p>
        <p class="text-[#363427] text-base leading-relaxed">
            内容確認のうえ、必要に応じてご連絡いたします。
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('top') }}"
           class="py-3 px-14 bg-[#363427] text-white rounded hover:opacity-80 transition text-sm tracking-wide">
            TOPへ戻る
        </a>
    </div>

</div>
@endsection
