@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto text-center">

    <h1 class="inline-block bg-white px-8 py-4 text-xl font-semibold mb-16">
        Monte Tavola 業務管理システム
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- 予約管理 --}}
        <a href="#" class="bg-white rounded-2xl p-10 hover:shadow-md transition">
            <img
                src="{{ asset('images/admin/icon-reservation.png') }}"
                alt="予約管理"
                class="w-24 h-24 mx-auto mb-4"
            >
            <p class="text-lg font-medium">予約管理</p>
        </a>

        {{-- お知らせ管理 --}}
        <a href="#" class="bg-white rounded-2xl p-10 hover:shadow-md transition">
            <img
                src="{{ asset('images/admin/icon-news.png') }}"
                alt="お知らせ管理"
                class="w-24 h-24 mx-auto mb-4"
            >
            <p class="text-lg font-medium">お知らせ管理</p>
        </a>

        {{-- 休業日管理 --}}
        <a href="#" class="bg-white rounded-2xl p-10 hover:shadow-md transition">
            <img
                src="{{ asset('images/admin/icon-holiday.png') }}"
                alt="休業日管理"
                class="w-32 h-24 mx-auto mb-4"
            >
            <p class="text-lg font-medium">休業日管理</p>
        </a>

        {{-- お問い合わせ管理 --}}
        <a href="#" class="bg-white rounded-2xl p-10 hover:shadow-md transition">
            <img
                src="{{ asset('images/admin/icon-contact.png') }}"
                alt="お問い合わせ管理"
                class="w-28 h-24 mx-auto mb-4"
            >
            <p class="text-lg font-medium">お問い合わせ管理</p>
        </a>

    </div>
</div>
@endsection
