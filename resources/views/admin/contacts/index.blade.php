@extends('layouts.admin')

@section('content')
<div
    class="max-w-7xl mx-auto"
    x-data="{
        detailOpen: false,
        deleteOpen: false,
        contact: {
            id: null,
            name: '',
            email: '',
            subject: '',
            message: '',
            created_at: ''
        },
        deleteContact: {
            id: null,
            name: '',
            subject: '',
            created_at: ''
        }
    }"
>

    <h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;">
    お問い合わせ管理
    </h1>

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

                            {{-- 操作 --}}
                            <td class="border p-2">
                                <div class="flex justify-center gap-2">

                                    {{-- 詳細 --}}
                                    <button
                                        type="button"
                                        @click="
                                            detailOpen = true;
                                            contact = @js([
                                                'id' => $contact->id,
                                                'name' => $contact->name,
                                                'email' => $contact->email,
                                                'subject' => $contact->subject,
                                                'message' => $contact->message,
                                                'created_at' => $contact->created_at->format('Y-m-d H:i'),
                                            ])
                                        "
                                        class="bg-[#22314C] text-white px-3 py-1 rounded"
                                    >
                                        詳細
                                    </button>

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
                                    <button
                                        type="button"
                                        @click="
                                            deleteOpen = true;
                                            deleteContact = {
                                                id: {{ $contact->id }},
                                                name: '{{ $contact->name }}',
                                                subject: '{{ $contact->subject }}',
                                                created_at: '{{ $contact->created_at->format('Y/m/d H:i') }}'
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

    {{-- お問い合わせ詳細モーダル --}}
    <div
        x-show="detailOpen"
        x-cloak
        x-transition
        @click.self="detailOpen = false"
        @keydown.escape.window="detailOpen = false"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-2xl rounded-xl px-12 py-10">

            <h2 class="text-lg font-semibold border-b pb-3 mb-8">
                お問い合わせ詳細
            </h2>

            <div class="mb-10 flex justify-center">
                <div class="w-[440px] pl-6">
                    <p class="font-semibold mb-3">■ 基本情報</p>

                    <div class="grid grid-cols-[6rem_1rem_auto] gap-y-2 text-sm">
                        <div>氏名</div><div>：</div><div x-text="contact.name"></div>
                        <div>メール</div><div>：</div><div x-text="contact.email"></div>
                        <div>件名</div><div>：</div><div x-text="contact.subject"></div>
                        <div>受信日時</div><div>：</div><div x-text="contact.created_at"></div>
                    </div>
                </div>
            </div>

            <div class="mb-12 flex justify-center">
                <div class="w-[440px] pl-6">
                    <p class="font-semibold mb-3">■ お問い合わせ内容</p>

                    <p
                        class="text-sm whitespace-pre-wrap leading-relaxed break-words"
                        x-text="contact.message"
                    ></p>
                </div>
            </div>

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

    {{-- お問い合わせ削除モーダル --}}
    <div
        x-show="deleteOpen"
        x-cloak
        x-transition
        @click.self="deleteOpen = false"
        @keydown.escape.window="deleteOpen = false"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
    >
        <div class="bg-white w-full max-w-xl rounded-xl px-12 py-10">

            <h2 class="text-lg font-semibold border-b pb-3 mb-8">
                お問い合わせ削除の確認
            </h2>

            <p class="text-sm text-center mb-8">
                こちらのお問い合わせを削除してもよろしいですか？<br>
                <span>削除すると元に戻すことはできません。</span>
            </p>

            <div class="text-sm mb-10 flex justify-center">
                <div class="grid grid-cols-[6rem_1rem_auto] gap-y-2">
                    <div>氏名</div><div>：</div><div x-text="deleteContact.name"></div>
                    <div>送信日時</div><div>：</div><div x-text="deleteContact.created_at"></div>
                    <div>件名</div><div>：</div><div x-text="deleteContact.subject"></div>
                </div>
            </div>

            <div class="flex justify-center gap-6">
                <button
                    type="button"
                    @click="deleteOpen = false"
                    class="px-6 py-2 border border-[#22314C] rounded text-[#22314C]"
                >
                    閉じる
                </button>

                <form
                    :action="`/admin/contacts/${deleteContact.id}`"
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
