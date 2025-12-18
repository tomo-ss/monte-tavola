@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-semibold text-[#363427] mb-6 border-b pb-3">
        お知らせ投稿フォーム
    </h1>

    {{-- 投稿フォーム --}}
    <form action="{{ route('admin.news.confirm') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-5">
        @csrf

        {{-- タイトル --}}
        <div>
            <label class="font-semibold text-[#363427]">■ タイトル</label>
            <input type="text" name="title"
                class="w-full border border-gray-300 rounded p-2 mt-2"
                value="{{ old('title') }}">
        </div>

        {{-- 本文 --}}
        <div>
            <label class="font-semibold text-[#363427]">■ 本文</label>
            <textarea name="body"
                rows="10"
                class="w-full border border-gray-300 rounded p-2 mt-2">{{ old('body') }}</textarea>
        </div>

        {{-- ファイルアップロード --}}
        <div>
            <label class="font-semibold text-[#363427]">■ ファイルアップロード</label>
            <input type="file" name="image"
                class="border border-gray-300 rounded p-2 w-full mt-2">
        </div>

        {{-- 公開日 --}}
        <div>
            <label class="font-semibold text-[#363427]">■ 公開日</label>
            <input type="date" name="published_at"
                class="border border-gray-300 rounded p-2 w-60 mt-2"
                value="{{ old('published_at') }}">
        </div>

        {{-- ボタン --}}
        <div class="text-center pt-6">
            <button type="submit"
                class="bg-[#2C406E] text-white px-8 py-3 rounded hover:opacity-90 transition">
                確認画面へ
            </button>
        </div>

    </form>
</div>

@endsection
