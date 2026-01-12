@extends('layouts.app')
@section('title', 'アクセス')
@section('title', 'Access')
@section('description', 'Monte Tavola へのアクセス情報')

@section('content')

{{-- タイトル --}}
<section class="pt-32 pb-10 text-center">
  <h1 class="font-serif text-3xl md:text-4xl font-semibold text-[#363427]">
    Access
  </h1>
  <p class="mt-2 text-sm text-[#363427]">
    アクセス
  </p>
</section>


{{-- ===== 説明文 & 電話番号 ===== --}}
<section class="text-center px-6 max-w-3xl mx-auto">
    <p class="text-[#363427] text-sm leading-relaxed">
        下記の地図をご参考ください。道に迷われた際は、お気軽にお電話ください。
    </p>
    <p class="text-[#363427] text-sm mt-1 font-medium">
        TEL：0000-000-0000
    </p>
</section>

{{-- ===== Google Map 埋め込み ===== --}}
<section class="mt-10 px-6 max-w-4xl mx-auto">
    <div class="w-full h-[350px] md:h-[450px] shadow-sm">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.521870216447!2d139.81070087611593!3d35.71003467258079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018894ec7c244b7%3A0x6a11145892556277!2z5p2x5Lqs6aeF!5e0!3m2!1sja!2sjp!4v1636592400000!5m2!1sja!2sjp"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

{{-- ===== アクセス説明 ===== --}}
<section class="mt-6 px-6 max-w-3xl mx-auto text-center">
    <p class="text-[#363427] text-sm leading-relaxed">
        最寄り駅「〇〇駅」より徒歩約〇分。<br>
        バスをご利用の場合は「〇〇停留所」で下車後、徒歩〇分です。<br>
        お車の場合は〇〇インターから約〇分、店舗横に駐車場がございます。
    </p>
</section>

{{-- ===== 店舗外観（写真 + 説明） ===== --}}
<section class="mt-20 px-6 max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

    {{-- 写真 --}}
    <div>
        <img src="{{ asset('images/access/shop.jpg') }}"
             class="w-full shadow-sm"
             alt="Monte Tavola 外観">
    </div>

     {{-- 説明文（モバイル中央 / PC左寄せ） --}}
    <div class="text-center md:text-left">
        <p class="text-[#363427] text-sm leading-relaxed">
            長野の自然に溶け込む、木のぬくもりを感じる看板が目印です。<br>
            小道を抜けた先に、静かで心地よい空間が広がっています。<br>
            四季折々の風景と風音を楽しみながら、ゆっくりとした時間を<br>
            過ごしていただける場所でお待ちしております。
        </p>
    </div>

</section>

@endsection
