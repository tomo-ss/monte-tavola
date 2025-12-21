@extends('layouts.admin')

@section('content')
<div
    class="max-w-7xl mx-auto"
    x-data="{
    deleteOpen: false,
    detailOpen: false,
    reservation: {
        id: null,
        name: '',
        name_kana: '',
        phone: '',
        email: '',
        date: '',
        time: '',
        people: '',
        note: ''
    }
}"

>


    <h1 class="text-xl font-semibold mb-6">予約管理</h1>

    {{-- 削除成功メッセージ --}}
@if (session('success'))
    <div class="mb-6 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif


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

            {{-- CSV出力 --}}
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

                                    {{-- 詳細 --}}
                                    <button
                                        type="button"
                                        @click="
                                            detailOpen = true;
                                            reservation = @js([
                                                'id' => $reservation->id,
                                                'name' => $reservation->name,
                                                'name_kana' => $reservation->name_kana,
                                                'phone' => $reservation->phone,
                                                'email' => $reservation->email,
                                                'date' => $reservation->date,
                                                'time' => \Carbon\Carbon::parse($reservation->time)->format('H:i'),
                                                'people' => $reservation->people_count . '名',
                                                'note' => $reservation->note ?? 'なし',
                                            ])
                                        "
                                        class="bg-[#22314C] text-white px-3 py-1 rounded"
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

                                    {{-- 削除 --}}
                                 <button
                                    type="button"
                                    @click="
                                    deleteOpen = true;
                                    reservation = {
                                        id: {{ $reservation->id }},
                                        name: '{{ $reservation->name }}',
                                        datetime: '{{ $reservation->date }} {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}',
                                        people: '{{ $reservation->people_count }}名'
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
       {{-- 予約詳細モーダル --}}
<div
    x-show="detailOpen"
    x-cloak
    x-transition
    @click.self="detailOpen = false"
    @keydown.escape.window="detailOpen = false"
    class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
>
    <div class="bg-white w-full max-w-2xl rounded-xl px-12 py-10">

        {{-- タイトル --}}
        <h2 class="text-lg font-semibold border-b pb-3 mb-8">
            予約詳細
        </h2>

        {{-- お客様情報 --}}
        <div class="mb-10 flex justify-center">
            <div class="w-[440px] pl-6">
                <p class="font-semibold mb-3">■ お客様情報</p>

                <div class="grid grid-cols-[6rem_1rem_auto] gap-y-2 text-sm">
                    <div>氏名</div><div>：</div><div x-text="reservation.name"></div>
                    <div>フリガナ</div><div>：</div><div x-text="reservation.name_kana"></div>
                    <div>電話番号</div><div>：</div><div x-text="reservation.phone"></div>
                    <div>メール</div><div>：</div><div x-text="reservation.email"></div>
                </div>
            </div>
        </div>

        {{-- ご来店日時 --}}
        <div class="mb-10 flex justify-center">
            <div class="w-[440px] pl-6">
                <p class="font-semibold mb-3">■ ご来店日時</p>

                <div class="grid grid-cols-[6rem_1rem_auto] gap-y-2 text-sm">
                    <div>来店日</div><div>：</div><div x-text="reservation.date"></div>
                    <div>来店時間</div><div>：</div><div x-text="reservation.time"></div>
                    <div>人数</div><div>：</div><div x-text="reservation.people"></div>
                </div>
            </div>
        </div>

        {{-- ご要望 --}}
        <div class="mb-12 flex justify-center">
            <div class="w-[440px] pl-6">
                <p class="font-semibold mb-3">■ ご要望など</p>

                <p
                    class="text-sm whitespace-pre-wrap leading-relaxed break-words"
                    x-text="reservation.note"
                ></p>
            </div>
        </div>

        {{-- ボタン --}}
        <div class="flex justify-center">
            <button
                type="button"
                @click="detailOpen = false"
                class="px-8 py-2 border border-[#22314C] rounded text-[#22314C]"
            >
                閉じる
            </button>
        </div>

    </div>
</div>



            {{-- 削除確認モーダル --}}
            
            <div
                x-show="deleteOpen"
                x-cloak
                x-transition
                @click.self="deleteOpen = false"
                @keydown.escape.window="deleteOpen = false"
                class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
            >

            <div class="bg-white w-full max-w-lg rounded-xl px-10 py-8">

                {{-- タイトル --}}
                <h2 class="text-lg font-semibold border-b pb-3 mb-6">
                    予約削除の確認
                </h2>

                {{-- メッセージ --}}
                <p class="text-center mb-10">
                    こちらの予約を削除してもよろしいですか？<br>
                    <span class="text-sm">
                        削除すると元に戻すことはできません。
                    </span>
                </p>

        {{-- 予約情報 --}}
        <div class="mb-14 flex justify-center">
            <div class="grid grid-cols-[6rem_1rem_auto] gap-y-2 text-sm">
                <div>氏名</div>
                <div>：</div>
                <div x-text="reservation.name"></div>

                <div>来店日時</div>
                <div>：</div>
                <div x-text="reservation.datetime"></div>

                <div>人数</div>
                <div>：</div>
                <div x-text="reservation.people"></div>
            </div>
        </div>



                {{-- ボタン --}}
                <div class="flex justify-center gap-6 pt-2">
                    <button
                        type="button"
                        @click="deleteOpen = false"
                        class="px-6 py-2 border border-[#22314C] rounded text-[#22314C]"
                    >
                        閉じる
                    </button>

                    <form
                        :action="`/admin/reservations/${reservation.id}`"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="px-6 py-2 bg-red-600 text-white rounded"
                        >
                            削除する
                        </button>
                    </form>
                </div>

            </div>
        </div>

        </div>
@endsection
