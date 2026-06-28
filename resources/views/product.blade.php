@extends('layouts.app')
@section('title', 'Produk Kami - Sarang Burung')
@section('content')

<section class="text-center py-16 px-6 bg-cream">
  <h1 class="font-serif text-4xl md:text-5xl font-normal mb-3">{{ __('messages.prod_title') }}</h1>
  <p class="text-sm text-warm-gray">{{ __('messages.prod_sub') }}</p>
</section>

<section class="max-w-7xl mx-auto px-6 pb-20 pt-10">
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
    <div class="flex gap-2 flex-wrap">
      @foreach(['all'=>__('messages.filter_all'),'premium'=>'Premium','reguler'=>'Reguler'] as $cat=>$label)
      <a href="{{ route('product') }}?category={{ $cat }}&sort={{ $sort }}"
         class="px-4 py-1.5 text-xs tracking-widest border rounded-full transition {{ $category===$cat ? 'bg-charcoal text-cream border-charcoal' : 'border-gray-300 text-warm-gray hover:border-charcoal hover:text-charcoal' }}">{{ $label }}</a>
      @endforeach
    </div>
    <div class="flex items-center gap-3 text-sm text-warm-gray">
      <span>{{ __('messages.sort_label') }}:</span>
      <select onchange="location='{{ route('product') }}?category={{ $category }}&sort='+this.value"
              class="border border-gray-200 rounded px-3 py-1 text-sm text-charcoal focus:outline-none">
        <option value="featured" {{ $sort==='featured'?'selected':'' }}>{{ __('messages.sort_feat') }}</option>
        <option value="price_asc" {{ $sort==='price_asc'?'selected':'' }}>{{ __('messages.sort_asc') }}</option>
        <option value="price_desc" {{ $sort==='price_desc'?'selected':'' }}>{{ __('messages.sort_desc') }}</option>
        <option value="newest" {{ $sort==='newest'?'selected':'' }}>{{ __('messages.sort_new') }}</option>
      </select>
    </div>
  </div>

  @if(session('cart_success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded">
      {{ session('cart_success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $p)
    <div class="product-card bg-white rounded shadow hover:shadow-lg transition-shadow">
      <div class="product-img relative overflow-hidden aspect-[4/3]">
        @if($p->badge === 'limited')
          <span class="absolute top-3 left-3 z-10 bg-gray-100 text-charcoal text-[10px] font-semibold tracking-widest uppercase px-2 py-1">{{ __('messages.limited') }}</span>
        @elseif($p->badge === 'new')
          <span class="absolute top-3 left-3 z-10 bg-tan text-white text-[10px] font-semibold tracking-widest uppercase px-2 py-1">{{ __('messages.new_badge') }}</span>
        @endif
        <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover" onerror="this.src='/IMAGE/SUPER.jpeg'">
      </div>
      <div class="p-5">
        <h3 class="font-serif text-lg mb-1">{{ $p->name }}</h3>
        <p class="text-xs text-warm-gray leading-relaxed mb-2">{{ $p->description }}</p>
        <p class="text-sm text-warm-gray mb-4">Rp {{ number_format($p->price, 0, ',', '.') }}</p>

        
        <form method="POST" action="{{ route('cart.add') }}">
          @csrf
          <input type="hidden" name="product_id" value="{{ $p->id }}">
          <button type="submit"
            class="w-full bg-charcoal text-cream text-[11px] tracking-[.1em] uppercase py-2.5 hover:opacity-80 transition">
            {{ __('messages.add_cart') }}
          </button>
        </form>

      </div>
    </div>
    @endforeach
  </div>
</section>

@endsection
