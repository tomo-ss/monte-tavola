@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

    <h1 class="text-xl font-semibold border-b pb-2 mb-6"
        style="border-color:#5A7193;">
        お知らせ投稿フォーム
    </h1>

    {{-- 投稿フォーム --}}
    <form
        action="{{ route('admin.news.confirm') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white p-10 max-w-6xl mx-auto space-y-5"
    >
        @csrf

        {{-- タイトル --}}
        <div>
            <label class="font-semibold text-[#363427]">■ タイトル</label>
            <input
                type="text"
                name="title"
                class="w-full border border-gray-300 rounded p-2 mt-2"
                value="{{ old('title') }}"
            >
        </div>

        {{-- 本文 --}}
        <div>
            <label class="font-semibold text-[#363427]">■ 本文</label>
            <textarea
                name="body"
                rows="10"
                class="w-full border border-gray-300 rounded p-2 mt-2"
            >{{ old('body') }}</textarea>
        </div>

        {{-- ファイルアップロード --}}
        <div>
            <label class="font-semibold text-[#363427]">■ ファイルアップロード</label>
            <input
                type="file"
                name="image"
                class="border border-gray-300 rounded p-2 w-full mt-2"
            >
        </div>

        {{-- 公開日 --}}
        <div>
            <label class="font-semibold text-[#363427]">■ 公開日</label>
            <input
                type="date"
                name="published_at"
                class="border border-gray-300 rounded p-2 w-60 mt-2"
                value="{{ old('published_at') }}"
            >
        </div>

        {{-- ボタン --}}
        <div class="flex justify-center mt-16">
            <button
                type="submit"
                class="bg-[#2C406E] text-white px-10 py-2 rounded hover:opacity-90 transition"
            >
                確認画面へ
            </button>
        </div>

    </form>

</div>
@endsection
