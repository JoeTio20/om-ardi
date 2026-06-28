@extends('layouts.app')
@section('title', 'Filosofi Kami - Sarang Burung')
@section('nav-centered') @endsection

@section('content')

<!-- HERO -->
<section class="flex flex-col items-center justify-center text-center py-24 px-6 min-h-[50vh]">
  <span class="block text-[11px] tracking-[.25em] uppercase text-tan mb-4">{{ __('messages.phil_label') }}</span>
  <h1 class="font-serif text-4xl md:text-6xl font-normal leading-tight max-w-xl mb-8">{{ __('messages.phil_title') }}</h1>
  <div class="w-px h-20 bg-gray-200"></div>
</section>

<!-- SWIFT SECTION -->
<section class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
  <div>
    <h2 class="font-serif text-3xl md:text-4xl font-normal mb-6">{{ __('messages.phil_s_title') }}</h2>
    <p class="text-sm text-warm-gray leading-relaxed mb-4">{{ __('messages.phil_p1') }}</p>
    <p class="text-sm text-warm-gray leading-relaxed mb-4">{{ __('messages.phil_p2') }}</p>
    <p class="text-sm text-warm-gray leading-relaxed mb-6">{{ __('messages.phil_p3') }}</p>
    <div class="text-tan tracking-[.3em] text-lg mt-6 mb-1">NEST_&#x25CE;</div>
    <div class="flex items-baseline gap-2">
      <span class="font-serif italic text-tan text-xl">Est.</span>
      <span class="text-xs tracking-[.15em] text-warm-gray">MCMXCV</span>
    </div>
  </div>
  <div class="overflow-hidden rounded shadow-2xl aspect-[3/4]">
    <img src="IMAGE/super.jpeg" alt="Craft" class="w-full h-full object-cover">
  </div>
</section>

<!-- BORN OF THE EARTH -->
<section class="bg-cream-dark py-20 px-6 text-center">
  <h2 class="font-serif text-3xl md:text-4xl font-normal mb-4">{{ __('messages.born_title') }}</h2>
  <p class="text-sm text-warm-gray max-w-md mx-auto mb-14">{{ __('messages.born_sub') }}</p>
  <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach([['icon'=>'🌿','t'=>'tan_title','d'=>'tan_desc'],['icon'=>'✂️','t'=>'cut_title','d'=>'cut_desc'],['icon'=>'🧵','t'=>'stitch_title','d'=>'stitch_desc']] as $c)
    <div class="bg-white rounded p-8 shadow">
      <div class="w-12 h-12 rounded-full bg-cream flex items-center justify-center text-xl mx-auto mb-4">{{ $c['icon'] }}</div>
      <h3 class="font-serif text-lg mb-3">{{ __('messages.'.$c['t']) }}</h3>
      <p class="text-sm text-warm-gray leading-relaxed">{{ __('messages.'.$c['d']) }}</p>
    </div>
    @endforeach
  </div>
</section>

<!-- BEAUTY OF TIME -->
<section class="bg-charcoal text-white py-28 px-6 text-center">
  <span class="block text-[11px] tracking-[.25em] uppercase text-tan mb-4">{{ __('messages.beauty_sub') }}</span>
  <h2 class="font-serif text-4xl md:text-6xl font-normal mb-6">{{ __('messages.beauty_title') }}</h2>
  <p class="text-sm text-white/65 max-w-xl mx-auto leading-relaxed">{{ __('messages.beauty_desc') }}</p>
</section>

@endsection