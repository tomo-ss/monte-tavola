@extends('layouts.app')
@section('title', 'おしらせ')
@section('content')

<div class="max-w-3xl mx-auto py-16">

    {{-- タイトル --}}
    <div class="text-center mt-20 mb-6">
        <h1 class="text-2xl font-semibold text-[#363427]">{{ $news->title }}</h1>
        <p class="text-sm text-gray-600 mt-2">
            {{ \Carbon\Carbon::parse($news->published_at)->format('Y.m.d') }}
        </p>
    </div>

    {{-- 画像 --}}
    @if ($news->image_path)
        <div class="mb-8">
            <img src="{{ asset('storage/' . $news->image_path) }}" 
                 class="w-full rounded-lg shadow-md">
        </div>
    @endif

    {{-- 本文 --}}
    <div class="bg-[#F1ECEB] p-8 rounded-xl shadow-sm text-[#363427] leading-relaxed">
        {!! nl2br(e($news->body)) !!}
    </div>

    {{-- 一覧へ戻る --}}
    <div class="text-center mt-12">
        <a href="{{ route('news.index') }}"
           class="inline-block bg-[#363427] text-white px-6 py-3 rounded
                  transition-colors duration-300 hover:opacity-80">
            一覧に戻る
        </a>
    </div>

</div>

@endsection
