@extends('layouts.app')
@section('title','Our Products - Sarang Burung')
@section('content')

<section class="max-w-screen-xl mx-auto px-6 md:px-16 pt-14 pb-6">
  <h1 class="font-serif text-4xl md:text-5xl font-normal mb-4">{{ __('messages.prod_title') }}</h1>
  <p class="text-sm text-gray-400 max-w-lg leading-relaxed mb-10">{{ __('messages.prod_sub') }}</p>
  <div class="flex border-b border-gray-200">
    <a href="{{ route('product') }}" class="text-[10px] tracking-[.15em] uppercase px-5 py-3 border-b-2 font-semibold {{ request('category') ? 'border-transparent text-gray-400' : 'border-gray-900 text-gray-900' }}">
      {{ __('messages.prod_all') }}
    </a>
    <a href="{{ route('product') }}?category=super" class="text-[10px] tracking-[.15em] uppercase px-5 py-3 border-b-2 font-semibold {{ request('category')==='super' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-400' }}">
      {{ __('messages.prod_cat1') }}
    </a>
    <a href="{{ route('product') }}?category=patahan" class="text-[10px] tracking-[.15em] uppercase px-5 py-3 border-b-2 font-semibold {{ request('category')==='patahan' ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-400' }}">
      {{ __('messages.prod_cat2') }}
    </a>
  </div>
</section>

<section class="max-w-screen-xl mx-auto px-6 md:px-16 pb-24">
@if($products->count())
  <div class="grid grid-cols-2 md:grid-cols-3 gap-x-5 md:gap-x-8 gap-y-12 md:gap-y-16 pt-10">
@foreach($products as $p)
    <div class="product-card group">
      <div class="relative overflow-hidden bg-gray-50 mb-3 md:mb-4">
        <div class="aspect-[3/4] overflow-hidden">
          <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700" onerror="this.src='/IMAGE/SUPER.jpeg'">
        </div>
        <div class="overlay-btn absolute bottom-0 left-0 right-0 p-3">
          <button class="btn-add-cart w-full bg-white text-gray-900 text-[9px] md:text-[10px] tracking-[.1em] uppercase py-2.5 md:py-3 font-semibold hover:bg-gray-900 hover:text-white transition"
            data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->price }}" data-image="{{ $p->thumbnail }}">
            {{ __('messages.add_cart') }}
          </button>
        </div>
      </div>
      <div class="flex justify-between items-start gap-1">
        <div class="min-w-0">
          <h3 class="font-serif text-sm md:text-base font-normal truncate">{{ $p->name }}</h3>
          <p class="text-[9px] tracking-widest uppercase text-gray-400">Sarang Burung</p>
        </div>
        <p class="text-sm text-gray-700 flex-shrink-0">Rp {{ number_format(\$p->price,0,'.',',') }}</p>
      </div>
    </div>
@endforeach
  </div>
@else
  <div class="py-32 md:py-40 text-center">
    <svg class="mx-auto mb-6" width="56" height="56" fill="none" stroke="#ddd" stroke-width="1" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
    <p class="font-serif text-2xl text-gray-300 mb-2">{{ __('messages.prod_empty_title') }}</p>
    <p class="text-sm text-gray-300 mb-8">{{ __('messages.prod_empty_sub') }}</p>
    <a href="{{ route('home') }}" class="text-[10px] tracking-[.2em] uppercase border-b border-gray-300 hover:text-gray-800 transition">{{ __('messages.prod_back_home') }}</a>
  </div>
@endif</section>

<section class="bg-gray-50 py-24 px-6 text-center">
  <div class="max-w-md mx-auto">
    <h2 class="font-serif text-2xl md:text-3xl font-normal mb-3">Stay Informed</h2>
    <p class="text-sm text-gray-400 leading-relaxed mb-8">Join our newsletter to receive exclusive updates on new collections and seasonal insights.</p>
    <form class="flex" onsubmit="return false">
      <input type="email" placeholder="YOUR EMAIL ADDRESS" class="flex-1 border border-gray-200 border-r-0 px-4 py-3.5 text-[10px] tracking-[.1em] outline-none focus:border-gray-800">
      <button style="background:#0D1F3C" class="text-white text-[10px] tracking-[.15em] uppercase px-6 py-3.5 font-semibold hover:opacity-80 transition">SUBSCRIBE</button>
    </form>
  </div>
</section>
@endsection
