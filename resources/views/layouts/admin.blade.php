<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | 管理画面</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E8EBF0] text-[#363427] min-h-screen flex flex-col">


    {{-- ====== ヘッダー ====== --}}
    <header class="bg-[#22314C] text-white py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">

            {{-- 管理ナビ --}}
            <nav class="flex space-x-8 text-sm">
                <a href="/admin" class="hover:opacity-80">トップ</a>
                <a href="/admin/reservation" class="hover:opacity-80">予約管理</a>
                <a href="/admin/news" class="hover:opacity-80">お知らせ管理</a>
                <a href="/admin/holiday" class="hover:opacity-80">休業日管理</a>
                <a href="/admin/contact" class="hover:opacity-80">お問い合わせ管理</a>
            </nav>

          {{-- 
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>
--}}
        </div>
    </header>


    {{-- ====== メインコンテンツ ====== --}}
  <main class="max-w-7xl mx-auto py-12 px-6 flex-grow">
    @yield('content')
</main>



    {{-- ====== フッター ====== --}}
    <footer class="bg-[#22314C] text-white text-center py-6 mt-16">
        © Monte Tavola 業務管理システム
    </footer>

</body>
</html>
