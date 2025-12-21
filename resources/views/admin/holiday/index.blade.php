@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- タイトル --}}
    <h1 class="text-xl font-semibold mb-10">
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

    {{-- 休業日一覧 --}}
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
                    <th class="border p-2 text-center w-[180px]">操作</th>
                </tr>
            </thead>

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

                                    {{-- 編集（モーダル予定） --}}
                                    <button
                                        type="button"
                                        class="bg-[#22314C] text-white px-3 py-1 rounded
                                               opacity-50 cursor-not-allowed"
                                    >
                                        編集
                                    </button>

                                    {{-- 削除（今回は未実装） --}}
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
