@extends('layouts.admin')

@section('title', 'お知らせ投稿完了')

@section('content')

<div class="max-w-4xl mx-auto py-16">

    {{-- タイトル --}}
    <h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;">
        お知らせ投稿完了
    </h1>



    {{-- 完了メッセージ --}}
    <p class="text-center text-2xl font-semibold text-[#363427] mt-24">
        投稿完了しました
    </p>

    {{-- ボタン --}}
    <div class="text-center mt-16">
        <a href="{{ route('admin.news.index') }}"
            class="bg-[#2C406E] text-white px-10 py-3 rounded hover:opacity-90 transition inline-block">
            お知らせ一覧へ戻る
        </a>
    </div>

</div>

@endsection
