<header id="site-header"
        data-transparent="{{ $transparent_header ? 'true' : 'false' }}"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 text-[#F8F8F8]">

    <div class="w-full h-20 flex items-center px-8 md:px-14">

        {{-- ロゴ --}}
        <a href="/" class="text-2xl font-serif tracking-wide">
            Monte Tavola
        </a>

        {{-- ナビ --}}
        <nav class="hidden md:flex space-x-12 text-lg font-medium ml-auto pr-0">
            <a href="/about" class="hover:opacity-80">About Us</a>
            <a href="/news" class="hover:opacity-80">News</a>
            <a href="/menu" class="hover:opacity-80">Menu</a>
            <a href="/reservation" class="hover:opacity-80">Reservation</a>
            <a href="/contact" class="hover:opacity-80">Contact</a>
        </nav>

        {{-- モバイルメニュー --}}
        <div class="md:hidden ml-auto">
            <button id="mobile-menu-open" class="text-3xl">☰</button>
        </div>
    </div>
</header>


{{-- ヘッダーの透明処理＆モバイルメニュー開閉 --}}
<script>
    const header = document.getElementById('site-header');
    const transparent = header.dataset.transparent === "true";

    if (transparent) {
        header.classList.add("bg-transparent");
    } else {
        header.classList.add("bg-[#363427]");
    }

    if (transparent) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 30) {
                header.classList.remove("bg-transparent");
                header.classList.add("bg-black/50", "backdrop-blur");
            } else {
                header.classList.remove("bg-black/50", "backdrop-blur");
                header.classList.add("bg-transparent");
            }
        });
    }

    document.getElementById('mobile-menu-open').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.remove('translate-x-full');
    });
    document.getElementById('mobile-menu-close').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.add('translate-x-full');
    });
</script>
