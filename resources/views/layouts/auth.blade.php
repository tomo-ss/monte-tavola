<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ログイン') | Monte Tavola</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E8EBF0] text-[#363427] min-h-screen flex flex-col">

    {{-- ====== ヘッダー（ロゴのみ） ====== --}}
    <header class="bg-[#22314C] text-white py-4">
        <div class="max-w-7xl mx-auto px-6">
            <span class="font-bold tracking-wide text-lg">
                Monte Tavola
            </span>
        </div>
    </header>

    {{-- ====== メイン ====== --}}
    <main class="flex-grow flex items-center justify-center px-6">
        @yield('content')
    </main>

    {{-- ====== 共通フッター ====== --}}
    @include('partials.admin-footer')

</body>
</html>
