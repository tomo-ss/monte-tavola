@extends('layouts.admin')
@section('title', '休業日管理')
@section('content')
<div
    class="max-w-7xl mx-auto"
    x-data="{
        editOpen: false,
        holiday: {
            id: null,
            date: '',
            type: '定休日',
            note: ''
        }
    }"
>

    {{-- タイトル --}}
    <h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;">
        休業日管理
    </h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <div class="mb-6 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- 新規登録 --}}
    <div class="flex justify-center mb-16">
        <a
            href="{{ route('admin.holiday.create') }}"
            class="bg-[#22314C] text-white px-10 py-3 rounded"
        >
            新規登録
        </a>
    </div>

    {{-- 一覧 --}}
    <div class="bg-white p-6">
        <p class="font-semibold mb-4">■ 休業日一覧</p>

        @if ($holidays->isEmpty())
            <p class="text-center text-gray-500 py-10">
                休業日はまだ登録されていません
            </p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2 text-center w-[160px]">日付</th>
                        <th class="border p-2 text-center w-[140px]">区分</th>
                        <th class="border p-2">備考</th>
                        <th class="border p-2 text-center w-[200px]">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($holidays as $holiday)
                        <tr>
                            <td class="border p-2 text-center">
                                {{ \Carbon\Carbon::parse($holiday->date)->format('Y.m.d') }}
                            </td>

                            <td class="border p-2 text-center">
                                {{ $holiday->type }}
                            </td>

                            <td class="border p-2">
                                {{ $holiday->note ?? '—' }}
                            </td>

                            <td class="border p-2">
                                <div class="flex justify-center gap-2">

                                    {{-- 編集 --}}
                                    <button
                                        type="button"
                                        @click="
                                            editOpen = true;
                                            holiday = {
                                                id: {{ $holiday->id }},
                                                date: '{{ $holiday->date }}',
                                                type: '{{ $holiday->type }}',
                                                note: @js($holiday->note ?? '')
                                            }
                                        "
                                        class="bg-[#22314C] text-white px-3 py-1 rounded"
                                    >
                                        編集
                                    </button>

                                    {{-- 削除（即削除） --}}
                                    <form
                                        method="POST"
                                        action="{{ route('admin.holiday.delete', $holiday) }}"
                                        onsubmit="return confirm('この休業日を削除してもよろしいですか？')"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded"
                                        >
                                            削除
                                        </button>
                                    </form>

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
        @keydown.escape.window="editOpen = false"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-xl rounded-xl px-10 py-8">

            <h2 class="text-lg font-semibold border-b pb-3 mb-8">
                休業日編集
            </h2>

            <form
                method="POST"
                :action="`/admin/holiday/${holiday.id}/update`"
            >
                @csrf

                <div class="space-y-8 mb-10">

                    {{-- 日付 --}}
                    <div>
                        <label class="block font-semibold mb-2">
                            休業日
                        </label>
                        <input
                            type="date"
                            name="date"
                            x-model="holiday.date"
                            class="border p-2 w-full"
                            required
                        >
                    </div>

                    {{-- 種別 --}}
                    <div>
                        <p class="font-semibold mb-2">
                            種別
                        </p>
                        <div class="flex gap-10">
                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="type"
                                    value="定休日"
                                    x-model="holiday.type"
                                >
                                定休日
                            </label>

                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="type"
                                    value="臨時休業"
                                    x-model="holiday.type"
                                >
                                臨時休業
                            </label>
                        </div>
                    </div>

                    {{-- 備考 --}}
                    <div>
                        <label class="block font-semibold mb-2">
                            備考（任意）
                        </label>
                        <textarea
                            name="note"
                            rows="4"
                            x-model="holiday.note"
                            class="border p-2 w-full"
                        ></textarea>
                    </div>

                </div>

                {{-- ボタン --}}
                <div class="flex justify-center gap-6">
                    <button
                        type="button"
                        @click="editOpen = false"
                        class="px-8 py-2 border border-[#22314C] rounded text-[#22314C]"
                    >
                        閉じる
                    </button>

                    <button
                        type="submit"
                        class="px-10 py-2 bg-[#22314C] text-white rounded"
                    >
                        保存する
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
