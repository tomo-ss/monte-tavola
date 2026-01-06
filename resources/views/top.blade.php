@extends('layouts.app')

@php($transparent_header = true)

@section('title', 'Monte Tavola - トップページ')
@section('description', '自然に囲まれた隠れ家レストラン Monte Tavola の公式サイトです。')
@section('body_class', 'top-page')

@section('content')

{{-- ========================================= --}}
{{-- Hero / Main Visual --}}
{{-- ========================================= --}}
<section class="relative w-full overflow-hidden">
    <div class="swiper main-visual-swiper h-screen md:h-[850px] overflow-hidden">
        <div class="swiper-wrapper overflow-hidden">
            @foreach ([1,2,3,4] as $i)
                <div class="swiper-slide overflow-hidden">
                    <img src="{{ asset("images/top/main-visual-{$i}.jpg") }}"
                         class="block w-full h-full object-cover brightness-75 zoom-kenburns">
                </div>
            @endforeach
        </div>
    </div>
</section>



{{-- ========================================= --}}
{{-- About Us --}}
{{-- ========================================= --}}
<section id="about"
    class="bg-[#F8F8F8] pt-16 pb-40 px-6 md:px-12 overflow-x-hidden">

  <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-10 items-center">

    {{-- 左：文章 --}}
    <div class="flex flex-col items-start">
      <h2 class="text-5xl font-bold text-[#363427] mb-4">About Us</h2>
      <p class="text-[#363427] leading-relaxed max-w-2xl mb-10">私たちについて</p>

      <div class="space-y-4 text-[#363427] leading-relaxed text-[16px]">
        <p>
          長野県の山あいにひっそりと佇む、夫婦で営む小さなイタリアンレストラン。<br>
          澄んだ空気、木々のざわめき、季節のうつろい——そんな自然の豊かさに包まれながら、<br>
          肩ひじ張らずに楽しめるカジュアルなイタリアンをご提供しています。
        </p>
        <p>
          私たちが目指すのは、日常からふっと離れて、心がほどけるようなひととき。<br>
          地元の食材を活かした料理と、温かみのある空間で、<br>
          訪れる方が「また帰ってきたくなる場所」になれたら嬉しいです。
        </p>
        <p>
          自然とともに、静かに、親しみ深く。<br>
          ここでしか味わえない時間を、どうぞごゆっくりお楽しみください。
        </p>
      </div>

      {{-- 予約ボタン --}}
      <a href="/reservation"
        class="btn-swipe-left-to-right inline-flex w-full md:w-[300px]
               h-[56px] md:h-[64px] px-6 justify-center items-center
               rounded-[10px] border border-[#363427]
               text-[#363427] font-semibold text-lg
               transition relative overflow-hidden mt-6">
        ご予約はこちら
      </a>

      <a href="/contact"
         class="mt-3 inline-block text-[#363427] underline hover:text-green-700 font-medium">
        ご予約以外のお問い合わせはこちらから
      </a>
    </div>

{{-- 右：画像 --}} 
<div class="relative w-full flex justify-center mt-6">

{{-- パスタ（大） --}} 
<div class="w-full max-w-[560px] h-[380px] overflow-hidden shadow-md relative z-10">
<img src="{{ asset('images/top/about_pasta.jpg') }}"
 alt="シーフードパスタ" 
 class="w-full h-full object-cover"> 
</div>

{{-- スタッフ（小） --}} 
<div class="w-[320px] h-[210px] overflow-hidden shadow-md
 absolute bottom-[-180px] left-[-40px] z-20">
  <img src="{{ asset('images/top/about_staff.jpg') }}"
   alt="スタッフの写真" 
   class="w-full h-full object-cover">
  </div>
</div>


    </div>

</section>

{{-- ========================================= --}}
{{-- News --}}
{{-- ========================================= --}}
<section id="news" class="py-16 px-6 md:px-12 bg-[#F1ECEB]">
  <div class="max-w-7xl mx-auto">

    <h2 class="text-5xl font-bold text-center text-[#363427] mb-2">News</h2>
    <p class="text-center text-[#363427] mb-8">おしらせ</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @forelse($latest_news as $item)
        <a href="{{ route('news.show', $item->id) }}"
           class="bg-white rounded overflow-hidden shadow hover:opacity-90 transition block">

          <div class="overflow-hidden">
            @if ($item->image_path)
              <img src="{{ asset('storage/' . $item->image_path) }}"
                   class="w-full h-48 object-cover hover:scale-110 transition">
            @else
              <div class="w-full h-48 bg-gray-200"></div>
            @endif
          </div>

          <div class="p-4">
            <h3 class="text-lg text-[#363427] font-semibold mb-2">
              {{ $item->title }}
            </h3>
            <p class="text-sm text-gray-500">
              {{ \Carbon\Carbon::parse($item->published_at)->format('Y.m.d') }}
            </p>
          </div>
        </a>
      @empty
        <p class="text-center text-gray-500">お知らせはまだありません。</p>
      @endforelse
    </div>

    <div class="mt-8 text-center">
      <a href="/news"
         class="inline-block bg-[#363427] text-white px-6 py-3 rounded
                hover:bg-[#4A4844] transition">
        View All
      </a>
    </div>

  </div>
</section>

{{-- ========================================= --}}
{{-- Menu --}}
{{-- ========================================= --}}
<section id="menu" class="py-14 px-6">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-5xl font-bold text-center text-[#363427] mb-2">Menu</h2>
    <p class="text-center text-[#363427] mb-6">メニュー</p>

    <div class="flex flex-wrap justify-center gap-6">
      @foreach (['food','drink','seasonal'] as $type)
        <div class="relative w-[340px] h-[390px] overflow-hidden rounded">
          <img src="{{ asset("images/top/menu_{$type}.png") }}"
               class="w-full h-full object-cover">
          <span class="absolute inset-0 flex items-center justify-center
                       text-white text-2xl font-semibold capitalize">
            {{ $type }}
          </span>
          <a href="/menu/{{ $type }}"
             class="absolute bottom-16 left-1/2 -translate-x-1/2
                    px-5 py-2 rounded-[10px]
                    bg-[#F8F8F8]/90 text-[#363427]
                    hover:bg-[#363427] hover:text-white transition">
            View Menu
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ========================================= --}}
{{-- Access --}}
{{-- ========================================= --}}
<section id="access" class="py-16 px-6 md:px-12 bg-[#F1ECEB]">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-5xl font-bold text-[#363427] mb-2">Access</h2>
    <p class="text-[#363427] mb-8">アクセス</p>

    <iframe class="w-full h-[350px] border-0"
        src="https://www.google.com/maps/embed?pb=!1m18..."
        loading="lazy"></iframe>

    <div class="mt-8 text-right">
      <a href="/access"
         class="inline-block bg-[#363427] text-white px-6 py-3 rounded
                hover:bg-[#4A4844] transition">
        View Details
      </a>
    </div>
  </div>
</section>

@push('scripts')
<script>
const mainSwiper = new Swiper('.main-visual-swiper', {
  loop: true,
  effect: 'fade',
  speed: 1500,
  autoplay: { delay: 3500, disableOnInteraction: false },
  fadeEffect: { crossFade: true },
});
</script>
@endpush

@endsection
