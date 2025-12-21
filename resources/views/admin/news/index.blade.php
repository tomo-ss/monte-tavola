@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

    <h1 class="text-xl font-semibold mb-16">お知らせ管理</h1>

    {{-- 新規投稿 --}}
    <div class="flex justify-center mb-24">
        <a
            href="{{ route('admin.news.create') }}"
            class="bg-[#22314C] text-white px-10 py-3 rounded"
        >
            新規投稿
        </a>
    </div>

    {{-- 検索フォーム --}}
    <form
        method="GET"
        action="{{ route('admin.news.index') }}"
        class="bg-white p-6 mb-10"
    >
        <p class="font-semibold mb-4">■ 検索フォーム</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- タイトル --}}
            <input
                type="text"
                name="title"
                placeholder="タイトル"
                value="{{ request('title') }}"
                class="border p-2"
            >

            {{-- キーワード --}}
            <input
                type="text"
                name="keyword"
                placeholder="キーワード"
                value="{{ request('keyword') }}"
                class="border p-2"
            >

            {{-- 公開日 --}}
            <input
                type="date"
                name="published_at"
                value="{{ request('published_at') }}"
                class="border p-2"
            >
        </div>

        <div class="flex justify-center mt-6">
            <button
                type="submit"
                class="bg-[#22314C] text-white px-8 py-2 rounded"
            >
                検索する
            </button>
        </div>
    </form>

    {{-- 一覧 --}}
    <div class="bg-white p-6">
        <p class="font-semibold mb-4">■ お知らせ一覧</p>

        @if ($newsList->isEmpty())
            <p class="text-center text-gray-500 py-10">
                お知らせはまだありません
            </p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">タイトル</th>
                        <th class="border p-2">公開日</th>
                        <th class="border p-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsList as $news)
                        <tr>
                            <td class="border p-2">
                                {{ $news->title }}
                            </td>
                            <td class="border p-2">
                                {{ \Carbon\Carbon::parse($news->published_at)->format('Y.m.d') }}
                            </td>
                            <td class="border p-2">
                                <div class="flex justify-center gap-2">

                                    {{-- 編集（未実装） --}}
                                    <button
                                        type="button"
                                        class="bg-[#22314C] text-white px-3 py-1 rounded
                                            opacity-50 cursor-not-allowed"
                                    >
                                        編集
                                    </button>

                                    {{-- 削除（未実装） --}}
                                    <button
                                        type="button"
                                        class="bg-red-600 text-white px-3 py-1 rounded
                                            opacity-50 cursor-not-allowed"
                                    >
                                        削除
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection
