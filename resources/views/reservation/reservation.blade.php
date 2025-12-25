@extends('layouts.app')

@section('content')
<div class="pt-44 pb-60 px-4">

    {{-- タイトル --}}
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-medium text-[#363427] tracking-wide leading-none">
            Reservation
        </h1>
        <p class="mt-2 text-sm text-[#363427]/70 tracking-[0.25em]">
            ご予約フォーム
        </p>
    </div>

    {{-- エラー --}}
    @if ($errors->any())
        <div class="max-w-[920px] mx-auto mb-8 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 成功 --}}
    @if (session('success'))
        <div class="max-w-[920px] mx-auto mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- フォーム本体 --}}
    <div class="max-w-[920px] mx-auto">
        <div class="bg-[#F1ECEB] rounded-[24px] px-6 md:px-16 py-12 md:py-14">

            <form method="POST" action="{{ route('reservation.confirm', [], false) }}">

                @csrf

                {{-- ========= ご来店日時 ========= --}}
                <div>
                    <h2 class="text-sm text-[#363427] tracking-wider mb-6">
                        ■ ご来店日時
                    </h2>

                    {{-- 来店日 --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">来店日</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>

                {{-- input + icon を包む --}}
                <div class="relative">
                    <input
                        type="text"
                        name="date"
                        id="reservation_date"
                        value="{{ old('date') }}"
                        placeholder="選択してください"
                        class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 pr-10 text-sm
                            text-[#363427] placeholder:text-[#363427]
                            focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40"
                    />

                    {{-- カレンダーアイコン（SVG・単色） --}}
                    <svg
                        class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#363427]/60"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-11 8h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        />
                    </svg>
                </div>
                </div>


                    {{-- 来店時間 --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">来店時間</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                         @php
                            // 選択されている日付（未選択なら null）
                            $selectedDate = old('date');

                            // 選択された日の予約済み時間一覧
                            $reservedForDate = $selectedDate && isset($reservedTimes[$selectedDate])
                                ? $reservedTimes[$selectedDate]
                                : collect();
                        @endphp

                        <select name="time" id="time" disabled
                        class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                            focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                        <option value="">選択してください</option>

                        @php
                            $start = \Carbon\Carbon::createFromFormat('H:i', '11:00');
                            $end   = \Carbon\Carbon::createFromFormat('H:i', '16:00');
                        @endphp

                        @for ($t = $start->copy(); $t->lte($end); $t->addMinutes(30))
                            <option value="{{ $t->format('H:i') }}">
                                {{ $t->format('H:i') }}
                            </option>
                        @endfor
                    </select>


                    {{-- 人数 --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_minmax(420px,1fr)] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">人数</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                        <div>
                            <select name="people_count"
                                    class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                                           focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                                <option value="">選択してください</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('people_count') == $i ? 'selected' : '' }}>
                                        {{ $i }}名
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                {{-- 区切り線 --}}
                <div class="my-10 border-t border-[#363427]/25"></div>

                {{-- ========= お客様情報 ========= --}}
                <div>
                    <h2 class="text-sm text-[#363427] tracking-wider mb-6">
                        ■ お客様情報
                    </h2>

                    {{-- 氏名 --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">氏名</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                        <div>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="例）山田 太郎"
                                   class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                                          placeholder:text-[#363427]/45
                                          focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                        </div>
                    </div>

                    {{-- フリガナ --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">フリガナ</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                        <div>
                            <input type="text" name="name_kana" value="{{ old('name_kana') }}" placeholder="例）ヤマダ タロウ"
                                   class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                                          placeholder:text-[#363427]/45
                                          focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                        </div>
                    </div>

                    {{-- 電話番号 --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">電話番号</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                        <div>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="例）090-1234-5678"
                                   class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                                          placeholder:text-[#363427]/45
                                          focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                        </div>
                    </div>

                    {{-- メール --}}
                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] items-center gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427]">メールアドレス</div>
                        <div>
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#363427] text-white text-xs tracking-wider">
                                必須
                            </span>
                        </div>
                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="例）yamanaka@example.com"
                                   class="w-full h-11 rounded-lg border border-[#363427]/20 bg-white px-4 text-sm text-[#363427]
                                          placeholder:text-[#363427]/45
                                          focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">
                        </div>
                    </div>
                </div>

                {{-- 区切り線 --}}
                <div class="my-10 border-t border-[#363427]/25"></div>

                {{-- ========= 備考 ========= --}}
                <div>
                    <h2 class="text-sm text-[#363427] tracking-wider mb-6">
                        ■ ご要望など（アレルギー食材はこちらにご記入ください）
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-[140px_80px_1fr] gap-3 md:gap-6 py-3">
                        <div class="text-sm text-[#363427] pt-3">備考欄</div>
                        <div class="pt-2">
                            <span class="inline-flex items-center justify-center h-6 w-12 rounded-md bg-[#D9D5D0] text-[#363427] text-xs tracking-wider">
                                任意
                            </span>
                        </div>
                        <div>
                            <textarea name="note" rows="7" placeholder="例）記念日利用のため、静かな席を希望"
                                      class="w-full rounded-lg border border-[#363427]/20 bg-white px-4 py-3 text-sm text-[#363427]
                                             placeholder:text-[#363427]/45
                                             focus:outline-none focus:ring-2 focus:ring-[#363427]/20 focus:border-[#363427]/40">{{ old('note') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex justify-center mt-12">
                    <button type="submit"
                            class="h-11 px-14 rounded-[10px] bg-[#363427] text-white text-sm tracking-wider
                                   hover:opacity-80 transition">
                        確認画面へ
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
  window.reservedTimes = @json($reservedTimes);
</script>


@endsection
