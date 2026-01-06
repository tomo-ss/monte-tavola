{{-- モバイルメニュー（右からスライド） --}}
<div id="mobile-menu"
     class="fixed inset-y-0 right-0 w-72 bg-[#363427] text-[#F8F8F8]
       translate-x-full transition-transform duration-300
       z-[60] md:hidden">

    <div class="h-20 px-4 flex items-center justify-between border-b border-white/10">
        <span class="text-lg font-serif">Menu</span>

        <button id="mobile-menu-close" class="text-3xl leading-none">
            ×
        </button>
    </div>

    <nav class="px-6 py-6 space-y-5 text-lg">
        <a href="/#about" class="block hover:opacity-80">About Us</a>
        <a href="/news" class="block hover:opacity-80">News</a>
        <a href="/#menu" class="block hover:opacity-80">Menu</a>
        <a href="/reservation" class="block hover:opacity-80">Reservation</a>
        <a href="/access" class="block hover:opacity-80">Access</a>
        <a href="/contact" class="block hover:opacity-80">Contact</a>
    </nav>
</div>

{{-- 背景（押したら閉じる） --}}
<div id="mobile-menu-backdrop"
     class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none
            transition-opacity duration-300 z-[55] md:hidden"></div>
