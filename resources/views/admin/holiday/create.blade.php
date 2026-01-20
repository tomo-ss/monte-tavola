@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">

<h1 class="text-xl font-semibold border-b pb-2 mb-6" style="border-color:#5A7193;"> 
    休業日登録 
</h1>

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="mb-6 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 登録フォーム --}}
    <form
        method="POST"
        action="{{ route('admin.holiday.store') }}"
        class="bg-white p-10 max-w-6xl mx-auto"
    >
        @csrf


        {{-- 休業日 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <label class="block font-semibold mb-2">
                    休業日
                </label>
                <input
                    type="date"
                    name="date"
                    value="{{ old('date') }}"
                    class="border p-2 w-full"
                >
            </div>
        </div>

        {{-- 種別（横並び） --}}
        <div class="mt-10">
            <p class="font-semibold mb-2">
                種別
            </p>
            <div class="flex gap-10 mt-2">
                <label class="flex items-center gap-2">
                    <input
                        type="radio"
                        name="type"
                        value="定休日"
                        @checked(old('type', '定休日') === '定休日')
                    >
                    定休日
                </label>

                <label class="flex items-center gap-2">
                    <input
                        type="radio"
                        name="type"
                        value="臨時休業"
                        @checked(old('type') === '臨時休業')
                    >
                    臨時休業
                </label>
            </div>
        </div>

        {{-- 備考 --}}
        <div class="mt-10">
            <label class="block font-semibold mb-2">
                備考（任意）
            </label>
            <textarea
                name="note"
                rows="4"
                class="border p-2 w-full"
            >{{ old('note') }}</textarea>
        </div>

        {{-- ボタン（白背景内） --}}
        <div class="flex justify-center mt-16 gap-6">
            <a
                href="{{ route('admin.holiday.index') }}"
                class="px-8 py-2 border border-[#22314C] rounded text-[#22314C]"
            >
                戻る
            </a>

            <button
                type="submit"
                class="px-10 py-2 bg-[#22314C] text-white rounded"
            >
                登録する
            </button>
        </div>

    </form>

</div>
@endsection
