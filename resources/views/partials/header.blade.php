<header id="site-header"
        data-transparent="{{ $transparent_header ? 'true' : 'false' }}"
        class="fixed top-0 left-0 w-full h-20 z-50
               transition-all duration-300 text-[#F8F8F8]">


    <div class="w-full h-20 flex items-center px-8 md:px-14">

        {{-- ロゴ --}}
        <a href="/" class="text-2xl font-serif tracking-wide">
            Monte Tavola
        </a>

        {{-- ナビ --}}
        <nav class="hidden md:flex space-x-12 text-lg font-medium ml-auto pr-0">
            <a href="/#about" class="hover:opacity-80">About Us</a>
            <a href="/news" class="hover:opacity-80">News</a>
            <a href="/#menu" class="hover:opacity-80">Menu</a>
            <a href="/reservation" class="hover:opacity-80">Reservation</a>
            <a href="/access" class="hover:opacity-80">Access</a>
            <a href="/contact" class="hover:opacity-80">Contact</a>
        </nav>
        {{-- モバイルメニュー（SPのみ） --}}
        <div class="md:hidden ml-auto">
            <button id="mobile-menu-open" class="text-3xl leading-none">☰</button>
        </div>


    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('site-header');
    if (!header) return;

    const transparent = header.dataset.transparent === "true";
    const isMobile = !window.matchMedia('(min-width: 768px)').matches;

    // ===== 初期背景 =====
    if (transparent) {
        if (isMobile) {
            // ★ SPは最初から半透明
            header.classList.add('bg-black/50');
        } else {
            // PCは最初は透明
            header.classList.add('bg-transparent');
        }
    } else {
        header.classList.add('bg-[#363427]');
    }

    // ===== PCのみスクロール処理 =====
    if (transparent && !isMobile) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 30) {
                header.classList.remove('bg-transparent');
                header.classList.add('bg-black/50');
            } else {
                header.classList.remove('bg-black/50');
                header.classList.add('bg-transparent');
            }
        });
    }
});
</script>
