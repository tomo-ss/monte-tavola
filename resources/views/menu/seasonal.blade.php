@extends('layouts.app')

@php($transparent_header = true)

@section('title', 'Seasonal Menu')
@section('description', 'Monte Tavola の季節限定メニュー')

@section('content')


{{-- Hero --}}
<section class="relative w-full h-[400px] overflow-hidden">
    <img src="{{ asset('images/menu/seasonal-hero.jpg') }}"
         class="w-full h-full object-cover brightness-75"
         alt="Seasonal Menu">
    
    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-[#F8F8F8] text-4xl md:text-5xl font-serif tracking-wide border border-[#F8F8F8] px-6 py-3"
            style="text-shadow: 0 4px 12px rgba(0,0,0,0.35);">
            Seasonal Menu
        </h1>
    </div>
</section>

{{-- Items --}}
<section class="py-20 max-w-5xl mx-auto px-6">

{{-- 2カラムのグリッド --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

        {{-- 1品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/seasonal-1.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">
                パンプキンスープ
            </p>
        </div>

        {{-- 2品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/seasonal-2.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">
                サーモンパスタ
            </p>
        </div>

        {{-- 3品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/seasonal-3.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">
                モンブラン
            </p>
        </div>
    </div>
</div>

</section>

@endsection
