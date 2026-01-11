@extends('layouts.app')
@section('title', 'メニュー')
@php($transparent_header = true)

@section('title', 'Food Menu')
@section('description', 'Monte Tavola のフードメニュー一覧')

@section('content')


{{-- Hero --}}
<section class="relative w-full h-[400px] overflow-hidden">
    <img src="{{ asset('images/menu/food-hero.jpg') }}" 
         class="w-full h-full object-cover brightness-75" 
         alt="Food Menu">

    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-[#F8F8F8] text-4xl md:text-5xl font-serif tracking-wide border border-[#F8F8F8] px-6 py-3"
            style="text-shadow: 0 4px 12px rgba(0,0,0,0.35);">
            Food Menu
        </h1>
    </div>
</section>

{{-- Menu Navigation Tabs --}}
<section class="mt-10 mb-12">
    <div class="w-full flex justify-center">
        <div class="inline-flex space-x-10 text-lg font-medium">

            <a href="/menu/food" 
               class="text-[#363427] border-b-2 border-[#363427] pb-1">
                Food
            </a>

            <a href="/menu/drink" 
               class="text-[#6B6861] hover:text-[#363427] pb-1 transition">
                Drink
            </a>

            <a href="/menu/seasonal" 
               class="text-[#6B6861] hover:text-[#363427] pb-1 transition">
                Seasonal
            </a>

        </div>
    </div>
</section>



{{-- Food Items --}}
<section class="py-20 max-w-5xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

        {{-- 1品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-1.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">イタリアンサラダ</p>
        </div>

        {{-- 2品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-2.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">ミネストローネ</p>
        </div>

        {{-- 3品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-3.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">マルゲリータ</p>
        </div>

        {{-- 4品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-4.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">ボロネーゼ</p>
        </div>

        {{-- 5品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-5.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">生ハムとベビーリーフのピッツァ</p>
        </div>

        {{-- 6品目 --}}
        <div class="text-center">
            <img src="{{ asset('images/menu/food-6.jpg') }}" class="w-full shadow-sm mb-3">
            <p class="text-sm tracking-wide text-[#363427]">ティラミス</p>
        </div>

    </div>
</section>

@endsection
