@extends('layouts.admin')
@section('title', 'お知らせ管理')
@section('content')
<div
    class="max-w-7xl mx-auto"
    x-data="{
        editOpen: false,
        deleteOpen: false,
        news: {
            id: null,
            title: '',
            body: '',
            published_at: ''
        }
    }"
>

    <h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;">
        お知らせ管理
    </h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <div class="mb-10 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

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
            <input type="text" name="title" placeholder="タイトル" value="{{ request('title') }}" class="border p-2">
            <input type="text" name="keyword" placeholder="キーワード" value="{{ request('keyword') }}" class="border p-2">
            <input type="date" name="published_at" value="{{ request('published_at') }}" class="border p-2">
        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="bg-[#22314C] text-white px-8 py-2 rounded">
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
                            <td class="border p-2">{{ $news->title }}</td>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($news->published_at)->format('Y.m.d') }}</td>
                            <td class="border p-2">
                                <div class="flex justify-center gap-2">
                                    {{-- 編集 --}}
                                    <button
                                        type="button"
                                        @click="
                                            editOpen = true;
                                            news = {
                                                id: {{ $news->id }},
                                                title: @js($news->title),
                                                body: @js($news->body ?? ''),
                                                published_at: '{{ \Carbon\Carbon::parse($news->published_at)->format('Y-m-d') }}'
                                            }
                                        "
                                        class="bg-[#22314C] text-white px-3 py-1 rounded"
                                    >
                                        編集
                                    </button>

                                    {{-- 削除 --}}
                                    <button
                                        type="button"
                                        @click="
                                            deleteOpen = true;
                                            news = {
                                                id: {{ $news->id }},
                                                title: @js($news->title),
                                                published_at: '{{ \Carbon\Carbon::parse($news->published_at)->format('Y.m.d') }}'
                                            }
                                        "
                                        class="bg-red-600 text-white px-3 py-1 rounded"
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

    {{-- 編集モーダル --}}
    <div
        x-show="editOpen"
        x-cloak
        x-transition
        @click.self="editOpen = false"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-xl rounded-xl px-10 py-8">

            <h2 class="text-lg font-semibold border-b pb-3 mb-6">
                お知らせ編集
            </h2>

            <form
                method="POST"
                :action="`/admin/news/${news.id}/update`"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-sm mb-1">タイトル</label>
                        <input type="text" name="title" x-model="news.title" class="w-full border p-2">
                    </div>

                    <div>
                        <label class="block text-sm mb-1">本文</label>
                        <textarea name="body" x-model="news.body" rows="6" class="w-full border p-2"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm mb-1">公開日</label>
                        <input type="date" name="published_at" x-model="news.published_at" class="border p-2">
                    </div>

                    {{-- ★ 画像差し替え --}}
                    <div>
                        <label class="block text-sm mb-1">画像（差し替え）</label>
                        <input type="file" name="image" class="border p-2 w-full">
                        <p class="text-xs text-gray-500 mt-1">
                            ※ 画像を選択した場合のみ差し替えます
                        </p>
                    </div>
                </div>

                <div class="flex justify-center gap-6">
                    <button type="button" @click="editOpen = false" class="px-6 py-2 border rounded">
                        閉じる
                    </button>

                    <button type="submit" class="px-6 py-2 bg-[#22314C] text-white rounded">
                        保存する
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 削除モーダル --}}
    <div
        x-show="deleteOpen"
        x-cloak
        x-transition
        @click.self="deleteOpen = false"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-lg rounded-xl px-10 py-8">

            <h2 class="text-lg font-semibold border-b pb-3 mb-6">
                お知らせ削除の確認
            </h2>

            <p class="text-center mb-8">
                こちらのお知らせを削除してもよろしいですか？<br>
                <span class="text-sm">削除すると元に戻すことはできません。</span>
            </p>

            <div class="text-sm mb-10 flex justify-center">
                <div class="grid grid-cols-[5rem_1rem_auto] gap-y-2">
                    <div>タイトル</div><div>：</div><div x-text="news.title"></div>
                    <div>公開日</div><div>：</div><div x-text="news.published_at"></div>
                </div>
            </div>

            <div class="flex justify-center gap-6">
                <button type="button" @click="deleteOpen = false" class="px-6 py-2 border rounded">
                    閉じる
                </button>

                <form method="POST" :action="`/admin/news/${news.id}/delete`">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded">
                        削除する
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
