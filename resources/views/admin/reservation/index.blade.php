@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

    <h1 class="text-xl font-semibold mb-6">予約管理</h1>

    {{-- 検索フォーム --}}
    <form
        method="GET"
        action="{{ route('admin.reservation.index') }}"
        class="bg-white p-6 mb-10"
    >
        <p class="font-semibold mb-4">■ 検索フォーム</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- 氏名 --}}
            <input
                type="text"
                name="name"
                placeholder="氏名"
                value="{{ request('name') }}"
                class="border p-2"
            >

            {{-- 来店日 --}}
            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="border p-2"
            >

            {{-- ステータス --}}
            <select
                name="status"
                class="border p-2"
            >
                <option value="">すべて</option>
                <option value="未確認" @selected(request('status') === '未確認')>
                    未確認
                </option>
                <option value="確認済" @selected(request('status') === '確認済')>
                    確認済
                </option>
            </select>
        </div>

        <div class="flex justify-center gap-4 mt-6">
            <button
                type="submit"
                class="bg-[#22314C] text-white px-6 py-2 rounded"
            >
                検索する
            </button>

            {{-- CSVは次ステップ用（今はダミーOK） --}}
                <a
            href="{{ route('admin.reservation.csv', request()->query()) }}"
            class="bg-[#22314C] text-white px-6 py-2 rounded"
        >
            CSV出力
        </a>
        </div>
    </form>

    {{-- 予約一覧 --}}
    <div class="bg-white p-6">
        <p class="font-semibold mb-4">■ 予約一覧</p>

        {{-- 検索結果0件 --}}
        @if ($reservations->isEmpty())
            <p class="text-center text-gray-500 py-10">
                該当する予約はありません
            </p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">氏名</th>
                        <th class="border p-2">カナ</th>
                        <th class="border p-2">日時</th>
                        <th class="border p-2">人数</th>
                        <th class="border p-2">ステータス</th>
                        <th class="border p-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="border p-2">{{ $reservation->id }}</td>
                            <td class="border p-2">{{ $reservation->name }}</td>
                            <td class="border p-2">{{ $reservation->name_kana }}</td>
                            <td class="border p-2">
                                {{ $reservation->date }} {{ $reservation->time }}
                            </td>
                            <td class="border p-2">{{ $reservation->people_count }}名</td>

                            {{-- ステータス --}}
                            <td class="border p-2">
                                <div class="flex items-center gap-2">
                                    @if ($reservation->status === '未確認')
                                        <span class="inline-block w-3 h-3 rounded-full bg-yellow-400"></span>
                                        <span>未確認</span>
                                    @else
                                        <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                                        <span>確認済</span>
                                    @endif
                                </div>
                            </td>

                            {{-- 操作 --}}
                            <td class="border p-2">
                                <div class="flex justify-center gap-2">

                                    {{-- 詳細（未実装でもOK） --}}
                                    <button
                                        type="button"
                                        class="bg-[#22314C] text-white px-3 py-1 rounded opacity-50 cursor-not-allowed"
                                    >
                                        詳細
                                    </button>

                                    {{-- ステータス切り替え --}}
                                    <form
                                        action="{{ route('admin.reservation.toggle', $reservation->id) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        @if ($reservation->status === '未確認')
                                            <button
                                                type="submit"
                                                class="bg-[#22314C] text-white px-3 py-1 rounded"
                                            >
                                                確認済に変更
                                            </button>
                                        @else
                                            <button
                                                type="submit"
                                                class="bg-white text-[#22314C] border border-[#22314C] px-3 py-1 rounded"
                                            >
                                                未確認に戻す
                                            </button>
                                        @endif
                                    </form>

                                    {{-- 削除（未実装OK） --}}
                                    <button
                                        type="button"
                                        class="bg-red-600 text-white px-3 py-1 rounded opacity-50 cursor-not-allowed"
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
