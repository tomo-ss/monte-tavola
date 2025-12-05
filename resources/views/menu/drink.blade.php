@extends('layouts.app')

@php($transparent_header = true)

@section('title', 'Drink Menu')
@section('description', 'Monte Tavola のドリンクメニュー一覧')

@section('content')


{{-- Hero --}}
<section class="relative w-full h-[400px] overflow-hidden">
    <img src="{{ asset('images/menu/drink-hero.jpg') }}" 
         class="w-full h-full object-cover brightness-75" 
         alt="Drink Menu">

    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-[#F8F8F8] text-4xl md:text-5xl font-serif tracking-wide border border-[#F8F8F8] px-6 py-3"
            style="text-shadow: 0 4px 12px rgba(0,0,0,0.35);">
            Drink Menu
        </h1>
    </div>
</section>


{{-- Drink Items --}}
<section class="py-20 max-w-5xl mx-auto px-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

        {{-- 1品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-1.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">赤ワイン</p>
        </div>

        {{-- 2品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-2.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">白ワイン</p>
        </div>

        {{-- 3品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-3.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">ビール</p>
        </div>

        {{-- 4品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-4.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">カクテル</p>
        </div>

        {{-- 5品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-5.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">コーヒー</p>
        </div>

        {{-- 6品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/drink-6.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">紅茶</p>
        </div>

    </div>

</section>

@endsection
