{{-- モバイルメニュー OVERLAY --}}
<div id="mobile-menu-overlay"
     class="fixed inset-0 z-[2147483647] hidden bg-black/40 pointer-events-auto isolation-isolate">


    {{-- モバイルメニュー本体 --}}
    <div id="mobile-menu"
        class="absolute top-0 left-0 w-full h-full
                bg-[#363427] text-[#F8F8F8]
                isolation-isolate
                pointer-events-auto">


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
</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn  = document.getElementById('mobile-menu-open');
    const closeBtn = document.getElementById('mobile-menu-close');
    const overlay  = document.getElementById('mobile-menu-overlay');
    const root     = document.getElementById('overlay-root');

    if (!openBtn || !closeBtn || !overlay || !root) return;

    // body 最後へ移動
    root.appendChild(overlay);

    const closeMenu = () => {
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    openBtn.addEventListener('click', () => {
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeBtn.addEventListener('click', closeMenu);

    overlay.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            closeMenu();
        });
    });
});
</script>

@endpush

