<header id="site-header"
        data-transparent="{{ $transparent_header ? 'true' : 'false' }}"
        class="fixed top-0 left-0 w-full z-50
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
        <div class="md:hidden">
            <button id="mobile-menu-open" class="text-3xl leading-none">☰</button>
        </div>

    </div>
</header>

@include('partials.mobile-menu')


<script>
document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('site-header');
    const transparent = header?.dataset.transparent === "true";

    // 初期背景
    if (header) {
        if (transparent) {
            header.classList.add("bg-transparent");
        } else {
            header.classList.add("bg-[#363427]");
        }

        // TOP/MENUのときだけスクロールで背景変更
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
    }

    // モバイルメニュー開閉（安全）
    const mobileMenu = document.getElementById('mobile-menu');
    const openBtn = document.getElementById('mobile-menu-open');
    const closeBtn = document.getElementById('mobile-menu-close');
    const backdrop = document.getElementById('mobile-menu-backdrop');

    if (mobileMenu && openBtn && closeBtn && backdrop) {
        const open = () => {
            mobileMenu.classList.remove('translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
        };

        const close = () => {
            mobileMenu.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
        };

        openBtn.addEventListener('click', open);
        closeBtn.addEventListener('click', close);
        backdrop.addEventListener('click', close);
    }
});
</script>
