@extends('layouts.app')
@section('title', 'おしらせ')
@section('content')

<div class="max-w-5xl mx-auto py-16">

{{--  タイトル  --}}
<div class="max-w-3xl mx-auto mt-20 mb-12 text-center">
    <h1 class="font-serif text-3xl md:text-4xl font-semibold text-[#363427]">
        News
    </h1>
    <p class="mt-2 text-sm text-[#363427]">
        おしらせ
    </p>
</div>

    {{-- ニュース一覧 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        @foreach ($news as $item)
            <a href="{{ route('news.show', $item->id) }}"
               class="block shadow bg-white rounded overflow-hidden hover:opacity-90 transition">

                {{-- 画像 --}}
                @if ($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                         class="w-full h-60 object-cover">
                @else
                    <div class="w-full h-60 bg-gray-200"></div>
                @endif

                <div class="p-4">
                    {{-- タイトル --}}
                    <h2 class="text-lg font-semibold text-[#363427] mb-2">
                        {{ $item->title }}
                    </h2>

                    {{-- 公開日 --}}
                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($item->published_at)->format('Y.m.d') }}
                    </p>
                </div>

            </a>
        @endforeach

    </div>

    {{-- ページネーション --}}
    <div class="mt-12">
        {{ $news->links() }}
    </div>

</div>

@endsection
