@extends('layouts.admin')

@section('title', 'お知らせ投稿確認')

@section('content')

<div class="max-w-4xl mx-auto py-16">

    <h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;">
    お知らせ投稿確認
    </h1>

    <p class="text-center text-sm text-[#363427] mb-10">
        以下の内容で「お知らせ」を公開します。<br>
        修正する場合は戻るを押してください。
    </p>

    {{-- 確認内容 --}}
    <div class="space-y-10">

        {{-- タイトル --}}
        <div>
            <p class="font-semibold text-[#363427]">■タイトル</p>
            <p class="mt-2">{{ $data['title'] }}</p>
        </div>

        {{-- 本文 --}}
        <div>
            <p class="font-semibold text-[#363427]">■本文</p>
            <div class="mt-2 leading-relaxed whitespace-pre-line">
                {{ $data['body'] }}
            </div>
        </div>

        {{-- ファイル --}}
        <div>
            <p class="font-semibold text-[#363427]">■ファイル</p>
            <p class="mt-2">
                {{ $image_path ? basename($image_path) : '（なし）' }}
            </p>
        </div>

        {{-- 公開日 --}}
        <div>
            <p class="font-semibold text-[#363427]">■公開日</p>
            <p class="mt-2">{{ $data['published_at'] }}</p>
        </div>

    </div>


    {{-- ボタン --}}
    <div class="flex justify-center gap-10 mt-14">

        {{-- 戻る --}}
        <form action="{{ route('admin.news.create') }}" method="GET">
            @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            {{-- 画像パスも戻す --}}
            <input type="hidden" name="image_path" value="{{ $image_path }}">

            <button
                class="bg-[#2C406E] text-white px-10 py-3 rounded hover:opacity-90 transition"
                type="submit">
                戻る
            </button>
        </form>

        {{-- 投稿する --}}
        <form action="{{ route('admin.news.store') }}" method="POST">
            @csrf

            @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            {{-- 画像パス --}}
            <input type="hidden" name="image_path" value="{{ $image_path }}">

            <button
                class="bg-[#2C406E] text-white px-10 py-3 rounded hover:opacity-90 transition"
                type="submit">
                投稿する
            </button>
        </form>

    </div>

</div>

@endsection
