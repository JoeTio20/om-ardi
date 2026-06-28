@extends('layouts.app')
@section('title', 'Sarang Burung')
@section('content')

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-16 min-h-[calc(100vh-64px)] grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
  <div>
    <span class="block text-[11px] tracking-[.25em] uppercase text-warm-gray mb-5">{{ __("messages.hero_label") }}</span>
    <h1 class="font-serif text-4xl md:text-6xl font-normal leading-tight mb-8">{{ __("messages.hero_title") }}</h1>
    <div class="flex gap-4 flex-wrap">
      <a href="{{ route('product') }}" class="bg-charcoal text-cream text-[11px] tracking-[.12em] uppercase px-7 py-3 hover:opacity-80 transition">{{ __("messages.hero_shop") }}</a>
      <a href="{{ route('philosophy') }}" class="border border-charcoal text-charcoal text-[11px] tracking-[.12em] uppercase px-7 py-3 hover:bg-charcoal hover:text-cream transition">{{ __("messages.hero_phil") }}</a>
    </div>
  </div>
  <div class="overflow-hidden rounded shadow-2xl aspect-[4/3]">
    <img src="/IMAGE/SUPER.jpeg" alt="Sarang Burung" class="w-full h-full object-cover">
  </div>
</section>

<!-- MASTERWORK -->
<section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
  <div>
    <h2 class="font-serif text-3xl md:text-4xl font-normal mb-6">{{ __("messages.master_title") }}</h2>
    <p class="text-sm text-warm-gray leading-relaxed mb-4">{{ __("messages.master_p1") }}</p>
    <p class="text-sm text-warm-gray leading-relaxed mb-8">{{ __("messages.master_p2") }}</p>
    <a href="{{ route('philosophy') }}" class="text-[11px] font-semibold tracking-[.2em] uppercase border-b border-tan pb-1 hover:text-tan transition">&mdash; {{ __("messages.master_link") }}</a>
  </div>
  <div class="overflow-hidden rounded shadow-2xl aspect-[3/4]">
    <img src="/IMAGE/MANGKOK.jpeg" alt="Crafting" class="w-full h-full object-cover">
  </div>
</section>

<!-- FEATURED COLLECTIONS -->
<section class="bg-cream-dark py-20 px-6">
  <div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-10">
      <div>
        <span class="block text-[10px] tracking-[.2em] uppercase text-warm-gray mb-2">{{ __("messages.feat_label") }}</span>
        <h2 class="font-serif text-3xl font-normal">{{ __("messages.feat_title") }}</h2>
      </div>
      <a href="{{ route('product') }}" class="text-[11px] tracking-[.15em] uppercase text-warm-gray border-b border-warm-gray/50 hover:text-charcoal transition">{{ __("messages.feat_all") }}</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      @foreach($featured as $p)
      <div class="product-card bg-white rounded shadow hover:shadow-lg transition-shadow">
        <div class="product-img relative overflow-hidden aspect-[4/3]">
          @if($p->badge === 'limited')
            <span class="absolute top-3 left-3 z-10 bg-gray-100 text-charcoal text-[10px] font-semibold tracking-widest uppercase px-2 py-1">{{ __("messages.limited") }}</span>
          @elseif($p->badge === 'new')
            <span class="absolute top-3 left-3 z-10 bg-tan text-white text-[10px] font-semibold tracking-widest uppercase px-2 py-1">{{ __("messages.new_badge") }}</span>
          @endif
          <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover" onerror="this.src='/IMAGE/SUPER.jpeg'">
        </div>
        <div class="p-5">
          <h3 class="font-serif text-lg mb-1">{{ $p->name }}</h3>
          <p class="text-sm text-warm-gray mb-4">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
          <button class="btn-add-cart w-full bg-charcoal text-cream text-[11px] tracking-[.1em] uppercase py-2.5 hover:opacity-80 transition"
            data-id="{{ $p->id }}"
            data-name="{{ $p->name }}"
            data-price="{{ $p->price }}"
            data-image="{{ $p->thumbnail }}">
            {{ __("messages.add_cart") }}
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- BANNER -->
<section class="relative min-h-[380px] flex items-center justify-center text-center bg-cover bg-center"
         style="background-image:url('/IMAGE/PATAH BESAR.jpeg')">
  <div class="absolute inset-0 bg-black/65"></div>
  <div class="relative z-10 px-6">
    <h2 class="font-serif text-white text-3xl md:text-5xl font-normal leading-tight mb-8">{{ __("messages.banner_title") }}</h2>
    <a href="{{ route('philosophy') }}" class="border border-white text-white text-[11px] tracking-[.15em] uppercase px-8 py-3 hover:bg-white hover:text-charcoal transition">{{ __("messages.banner_cta") }}</a>
  </div>
</section>

@endsection
