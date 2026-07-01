@extends('layouts.app')
@section('title','Sarang Burung')
@section('content')

<section class="relative w-full min-h-screen flex items-end overflow-hidden">
  <img src="/IMAGE/SUPER.jpeg" alt="" class="absolute inset-0 w-full h-full object-cover">
  <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/20 to-transparent"></div>
  <div class="relative z-10 px-8 md:px-20 pb-16 md:pb-28 max-w-2xl">
    <span class="block text-[10px] tracking-[.35em] uppercase text-white/60 mb-5">{{ __('messages.hero_label') }}</span>
    <h1 class="font-serif text-4xl md:text-6xl font-normal leading-tight text-white mb-6">{{ __('messages.hero_title') }}</h1>
    <p class="text-sm text-white/65 leading-relaxed mb-10 max-w-sm">{{ __('messages.master_p1') }}</p>
    <div class="flex gap-4 flex-wrap">
      <a href="{{ route('product') }}" class="bg-white text-gray-900 text-[10px] tracking-[.15em] uppercase px-8 py-3.5 hover:bg-gray-100 transition font-semibold">{{ __('messages.hero_shop') }}</a>
      <a href="{{ route('philosophy') }}" class="border border-white/60 text-white text-[10px] tracking-[.15em] uppercase px-8 py-3.5 hover:bg-white/10 transition">{{ __('messages.hero_phil') }} &rarr;</a>
    </div>
  </div>
</section>

<section class="max-w-screen-xl mx-auto px-6 md:px-16 py-24 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
  <div>
    <span class="block text-[10px] tracking-[.25em] uppercase text-gray-400 mb-4">01 / Heritage</span>
    <h2 class="font-serif text-3xl md:text-4xl font-normal mb-6">{{ __('messages.master_title') }}</h2>
    <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ __('messages.master_p1') }}</p>
    <p class="text-sm text-gray-500 leading-relaxed mb-8">{{ __('messages.master_p2') }}</p>
    <a href="{{ route('philosophy') }}" class="text-[10px] font-semibold tracking-[.2em] uppercase border-b border-gray-800 pb-1 hover:opacity-50 transition">&mdash; {{ __('messages.master_link') }}</a>
  </div>
  <div class="grid grid-cols-2 gap-3">
    <div class="col-span-2 overflow-hidden aspect-video">
      <img src="/IMAGE/MANGKOK.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
    </div>
    <div class="overflow-hidden aspect-square">
      <img src="/IMAGE/SUPER.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
    </div>
    <div class="overflow-hidden aspect-square">
      <img src="/IMAGE/PATAH BESAR.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
    </div>
  </div>
</section>

<section class="bg-gray-50 py-24 px-6">
  <div class="max-w-screen-xl mx-auto">
    <div class="flex justify-between items-end mb-12">
      <div>
        <span class="block text-[10px] tracking-[.25em] uppercase text-gray-400 mb-2">{{ __('messages.feat_label') }}</span>
        <h2 class="font-serif text-3xl font-normal">{{ __('messages.feat_title') }}</h2>
      </div>
      <a href="{{ route('product') }}" class="text-[10px] tracking-[.15em] uppercase text-gray-400 border-b border-gray-300 hover:text-gray-800 transition hidden md:block">{{ __('messages.feat_all') }}</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-8">
@foreach($featured as $p)
      <div class="product-card group">
        <div class="relative overflow-hidden bg-gray-100 mb-3 md:mb-4">
          <div class="aspect-[3/4] overflow-hidden">
            <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" onerror="this.src='/IMAGE/SUPER.jpeg'">
          </div>
          <div class="overlay-btn absolute bottom-0 left-0 right-0 p-3">
            <button class="btn-add-cart w-full bg-white text-gray-900 text-[9px] md:text-[10px] tracking-[.12em] uppercase py-2.5 md:py-3 font-semibold hover:bg-gray-900 hover:text-white transition"
              data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->price }}" data-image="{{ $p->thumbnail }}">
              {{ __('messages.add_cart') }}
            </button>
          </div>
        </div>
        <h3 class="font-serif text-sm md:text-base mb-1">{{ $p->name }}</h3>
        <div class="flex justify-between items-center">
          <p class="text-[9px] tracking-widest uppercase text-gray-400 hidden md:block">Sarang Burung</p>
          <p class="text-sm text-gray-700">Rp {{ number_format(\$p->price,0,'.',',') }}</p>
        </div>
      </div>
@endforeach
    </div>
    <div class="text-center mt-10 md:hidden">
      <a href="{{ route('product') }}" class="text-[10px] tracking-[.15em] uppercase text-gray-400 border-b border-gray-300">{{ __('messages.feat_all') }}</a>
    </div>
  </div>
</section>

<section style="background:#0D1F3C" class="text-white py-24 md:py-28 px-6">
  <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div>
      <span class="block text-[10px] tracking-[.3em] uppercase mb-6" style="color:rgba(255,255,255,.4)">{{ __('messages.hero_label') }}</span>
      <h2 class="font-serif text-3xl md:text-5xl font-normal leading-tight mb-10">{{ __('messages.banner_title') }}</h2>
      <div class="space-y-6 mb-10">
        <div>
          <p class="text-[10px] tracking-[.2em] uppercase mb-1.5 font-semibold" style="color:rgba(255,255,255,.35)">01. {{ __('messages.tan_title') }}</p>
          <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,.6)">{{ __('messages.tan_desc') }}</p>
        </div>
        <div>
          <p class="text-[10px] tracking-[.2em] uppercase mb-1.5 font-semibold" style="color:rgba(255,255,255,.35)">02. {{ __('messages.cut_title') }}</p>
          <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,.6)">{{ __('messages.cut_desc') }}</p>
        </div>
        <div>
          <p class="text-[10px] tracking-[.2em] uppercase mb-1.5 font-semibold" style="color:rgba(255,255,255,.35)">03. {{ __('messages.stitch_title') }}</p>
          <p class="text-sm leading-relaxed" style="color:rgba(255,255,255,.6)">{{ __('messages.stitch_desc') }}</p>
        </div>
      </div>
      <a href="{{ route('philosophy') }}" class="inline-block border text-[10px] tracking-[.15em] uppercase px-7 py-3.5 transition" style="border-color:rgba(255,255,255,.3);color:#fff" onmouseover="this.style.background='#fff';this.style.color='#0D1F3C'" onmouseout="this.style.background='transparent';this.style.color='#fff'">{{ __('messages.banner_cta') }}</a>
    </div>
    <div class="hidden md:block overflow-hidden aspect-[3/4] opacity-50">
      <img src="/IMAGE/MANGKOK.jpeg" class="w-full h-full object-cover">
    </div>
  </div>
</section>

<section class="py-24 px-6 text-center">
  <div class="max-w-md mx-auto">
    <h2 class="font-serif text-2xl md:text-3xl font-normal mb-3">Stay Informed</h2>
    <p class="text-sm text-gray-400 leading-relaxed mb-8">Receive exclusive updates on limited harvests and seasonal collection launches.</p>
    <form class="flex" onsubmit="return false">
      <input type="email" placeholder="EMAIL ADDRESS" class="flex-1 border border-gray-200 border-r-0 px-4 py-3.5 text-[10px] tracking-[.1em] outline-none focus:border-gray-800">
      <button style="background:#0D1F3C" class="text-white text-[10px] tracking-[.15em] uppercase px-6 py-3.5 font-semibold hover:opacity-80 transition">SUBSCRIBE</button>
    </form>
  </div>
</section>
@endsection
