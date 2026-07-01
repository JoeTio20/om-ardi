@extends('layouts.app')
@section('title','Our Philosophy - Sarang Burung')
@section('content')

<section class="relative w-full h-[80vh] flex items-center justify-center overflow-hidden">
  <img src="/IMAGE/MANGKOK.jpeg" class="absolute inset-0 w-full h-full object-cover">
  <div class="absolute inset-0" style="background:rgba(10,20,40,.62)"></div>
  <div class="relative z-10 text-center px-6">
    <span class="block text-[10px] tracking-[.35em] uppercase mb-5" style="color:rgba(255,255,255,.5)">{{ __('messages.hero_label') }}</span>
    <h1 class="font-serif text-4xl md:text-6xl font-normal text-white">{{ __('messages.phil_hero_title') }}</h1>
  </div>
</section>

<section class="max-w-screen-xl mx-auto px-6 md:px-16 py-24 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
  <div>
    <span class="block text-[10px] tracking-[.25em] uppercase text-gray-400 mb-4">01 / Heritage</span>
    <h2 class="font-serif text-3xl md:text-4xl font-normal mb-6">{{ __('messages.phil_s1_title') }}</h2>
    <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ __('messages.phil_s1_p1') }}</p>
    <p class="text-sm text-gray-500 leading-relaxed">{{ __('messages.phil_s1_p2') }}</p>
  </div>
  <div class="overflow-hidden aspect-[4/5]">
    <img src="/IMAGE/SUPER.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
  </div>
</section>

<section class="bg-gray-50 py-24 px-6">
  <div class="max-w-screen-xl mx-auto">
    <div class="text-center mb-14">
      <h2 class="font-serif text-3xl md:text-4xl font-normal mb-3">{{ __('messages.phil_s2_title') }}</h2>
      <p class="text-sm text-gray-400 max-w-lg mx-auto">{{ __('messages.phil_s2_sub') }}</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
      <div class="col-span-2 overflow-hidden aspect-video">
        <img src="/IMAGE/MANGKOK.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
      </div>
      <div class="overflow-hidden aspect-square">
        <img src="/IMAGE/SUPER.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
      </div>
      <div class="overflow-hidden aspect-square">
        <img src="/IMAGE/PATAH BESAR.jpeg" class="w-full h-full object-cover hover:scale-105 transition duration-700">
      </div>
      <div class="bg-white p-6 flex flex-col justify-center">
        <div class="w-7 h-7 mb-3" style="color:#d1c7ba">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2">Ethical Balance</p>
        <p class="text-xs text-gray-500 leading-relaxed">{{ __('messages.phil_ethical') }}</p>
      </div>
    </div>
  </div>
</section>

<section style="background:#0D1F3C" class="py-24 px-6">
  <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div>
      <span class="block text-[10px] tracking-[.25em] uppercase mb-8" style="color:rgba(255,255,255,.35)">SCIENTIFIC PRECISION</span>
      <blockquote class="font-serif text-2xl md:text-3xl italic font-normal leading-relaxed mb-10" style="color:rgba(255,255,255,.9)">&ldquo;{{ __('messages.phil_quote') }}&rdquo;</blockquote>
      <ul class="space-y-5">
        <li>
          <span class="text-[10px] tracking-widest uppercase font-semibold block mb-1" style="color:rgba(255,255,255,.35)">01 {{ __('messages.phil_proc1_title') }}</span>
          <span class="text-sm" style="color:rgba(255,255,255,.6)">{{ __('messages.phil_proc1_desc') }}</span>
        </li>
        <li>
          <span class="text-[10px] tracking-widest uppercase font-semibold block mb-1" style="color:rgba(255,255,255,.35)">02 {{ __('messages.phil_proc2_title') }}</span>
          <span class="text-sm" style="color:rgba(255,255,255,.6)">{{ __('messages.phil_proc2_desc') }}</span>
        </li>
      </ul>
    </div>
    <div class="hidden md:block overflow-hidden aspect-[4/5]" style="opacity:.5">
      <img src="/IMAGE/PATAH BESAR.jpeg" class="w-full h-full object-cover">
    </div>
  </div>
</section>

<section style="background:#0A1628" class="py-28 px-6 text-center">
  <h2 class="font-serif text-3xl md:text-5xl font-normal text-white mb-8">{{ __('messages.phil_cta_title') }}</h2>
  <a href="{{ route('product') }}" class="inline-block border text-[10px] tracking-[.2em] uppercase px-10 py-4 font-semibold transition" style="border-color:rgba(255,255,255,.4);color:#fff" onmouseover="this.style.background='#fff';this.style.color='#0A1628'" onmouseout="this.style.background='transparent';this.style.color='#fff'">
    {{ __('messages.phil_cta_btn') }}
  </a>
</section>
@endsection
