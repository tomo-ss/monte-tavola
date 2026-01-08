{{-- モバイルメニュー --}}
<div id="mobile-menu"
     class="fixed top-0 left-0 w-screen h-screen
            bg-[#363427] text-[#F8F8F8]
            z-[2147483647] md:hidden
            opacity-0 pointer-events-none transition-opacity duration-200">




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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('mobile-menu-open');
    const closeBtn = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');

    if (!openBtn || !closeBtn || !mobileMenu) return;

openBtn.addEventListener('click', () => {
    document.body.classList.add('menu-open');
    mobileMenu.style.display = 'block';
    document.body.classList.add('overflow-hidden');
      if (window.mainSwiper) {
            window.mainSwiper.disable();
        }
});

closeBtn.addEventListener('click', () => {
    document.body.classList.remove('menu-open');
    mobileMenu.style.display = 'none';
    document.body.classList.remove('overflow-hidden');
    
            if (window.mainSwiper) {
            window.mainSwiper.enable();
        }
});
});
</script>
@endpush

