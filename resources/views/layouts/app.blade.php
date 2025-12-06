<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Monte Tavola</title>
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta')

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="app" class="@yield('body_class') bg-[#F8F8F8] text-gray-800 font-sans">

    {{-- TOP/MENU → 透明ヘッダー、その他 → 通常ヘッダー --}}
    @include('partials.header', [
        'transparent_header' => !empty($transparent_header)
    ])

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- ページ別スクリプト --}}
    @stack('scripts')

</body>
</html>
