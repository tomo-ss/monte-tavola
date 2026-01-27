@extends('layouts.auth')
@section('title', '業務管理システムログイン')
@section('content')


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>業務管理システムログイン</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F8F8F8]">

    <div class="w-full max-w-md bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-semibold text-center text-[#233758] mb-6">
            業務管理システムログイン
        </h1>

        <form method="POST" action="/login" class="space-y-10">
            @csrf

        {{-- メールアドレス --}}
        <div>
            <label class="block text-sm text-[#242424] mb-1">
                メールアドレス
            </label>
            <input
                type="email"
                name="email"
                required
                class="w-full rounded border border-gray-300 px-3 py-2
                    text-[#242424]
                    focus:outline-none focus:border-[#242424]"
            >
        </div>

        {{-- パスワード --}}
        <div>
            <label class="block text-sm text-[#242424] mb-1">
                パスワード
            </label>
            <input
                type="password"
                name="password"
                required
                class="w-full rounded border border-gray-300 px-3 py-2
                    text-[#242424]
                    focus:outline-none focus:border-[#242424]"
            >
        </div>


            {{-- エラーメッセージ --}}
            @if ($errors->any())
                <p class="text-sm text-red-600">
                    {{ $errors->first() }}
                </p>
            @endif

            {{-- ログインボタン --}}
            <button
                type="submit"
                class="mx-auto block w-2/3 mt-20 bg-gray-800 text-white py-2 rounded
                    hover:bg-gray-700 transition"
            >
                ログイン
            </button>
        </form>
    </div>

</body>
</html>
@endsection