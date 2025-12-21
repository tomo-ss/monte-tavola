@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

    <h1 class="text-xl font-semibold mb-6">お問い合わせ管理</h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <div class="mb-6 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6">
        <p class="font-semibold mb-4">■ お問い合わせ一覧</p>

        @if ($contacts->isEmpty())
            <p class="text-center text-gray-500 py-10">
                お問い合わせはありません
            </p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">氏名</th>
                        <th class="border p-2">件名</th>
                        <th class="border p-2">受信日時</th>
                        <th class="border p-2">ステータス</th>
                        <th class="border p-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="border p-2">{{ $contact->id }}</td>
                            <td class="border p-2">{{ $contact->name }}</td>
                            <td class="border p-2">{{ $contact->subject }}</td>
                            <td class="border p-2">
                                {{ $contact->created_at->format('Y-m-d H:i') }}
                            </td>

                            {{-- ステータス --}}
                            <td class="border p-2">
                                <div class="flex items-center gap-2">
                                    @if ($contact->status === '未対応')
                                        <span class="inline-block w-3 h-3 rounded-full bg-yellow-400"></span>
                                        <span>未対応</span>
                                    @else
                                        <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                                        <span>対応済</span>
                                    @endif
                                </div>
                            </td>

                            {{-- 操作（予約管理と同じ並び） --}}
                            <td class="border p-2">
                                <div class="flex justify-center gap-2">

                                    {{-- 詳細 --}}
                                    <a
                                        href="{{ route('admin.contacts.show', $contact) }}"
                                        class="bg-[#22314C] text-white px-3 py-1 rounded"
                                    >
                                        詳細
                                    </a>

                                    {{-- ステータス切替 --}}
                                    <form
                                        action="{{ route('admin.contacts.updateStatus', $contact) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        @if ($contact->status === '未対応')
                                            <input type="hidden" name="status" value="対応済">
                                            <button
                                                type="submit"
                                                class="bg-[#22314C] text-white px-3 py-1 rounded"
                                            >
                                                対応済に変更
                                            </button>
                                        @else
                                            <input type="hidden" name="status" value="未対応">
                                            <button
                                                type="submit"
                                                class="bg-white text-[#22314C] border border-[#22314C] px-3 py-1 rounded"
                                            >
                                                未対応に戻す
                                            </button>
                                        @endif
                                    </form>

                                    {{-- 削除 --}}
                                    <form
                                        action="{{ route('admin.contacts.destroy', $contact) }}"
                                        method="POST"
                                        onsubmit="return confirm('このお問い合わせを削除してもよろしいですか？');"
                                    >
                                        @csrf
                                        @method('DELETE')

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

</div>
@endsection
