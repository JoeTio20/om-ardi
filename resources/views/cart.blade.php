@extends('layouts.app')
@section('title','Keranjang')
@section('content')
<div class="min-h-[80vh] bg-white px-4 md:px-16 py-10">

  <p class="text-[11px] text-gray-400 tracking-widest uppercase mb-6">
    <a href="/" class="hover:text-gray-700 transition">Home</a>
    <span class="mx-2">&rsaquo;</span>
    <span class="text-gray-700">Shopping Cart</span>
  </p>

  <h1 class="font-serif text-3xl md:text-4xl font-normal text-gray-900 mb-1">Your Selection</h1>
  <p class="text-sm text-gray-400 mb-8">Carefully curated pieces, ready for their journey.</p>
  <hr class="border-gray-100 mb-10">

  @if(empty($cart))
  <div class="text-center py-24">
    <p class="font-serif text-2xl text-gray-800 mb-2">Keranjang kosong</p>
    <p class="text-sm text-gray-400 mb-8">Temukan produk terbaik kami.</p>
    <a href="{{ route('product') }}" class="inline-block bg-[#0D1F3C] text-white text-[11px] font-semibold tracking-[.15em] uppercase px-10 py-4 hover:opacity-80 transition">VIEW PRODUCTS</a>
  </div>

  @else
  <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-8 items-start">
    <div class="space-y-4">
      @foreach($cart as $id => $item)
      <div class="flex gap-4 border border-gray-100 p-4 rounded">
        <img src="{{ $item['image'] }}" class="w-20 h-20 object-cover rounded flex-shrink-0" onerror="this.src='/IMAGE/SUPER.jpeg'">
        <div class="flex-1 min-w-0">
          <div class="flex justify-between items-start gap-2 mb-4">
            <p class="font-serif text-base text-gray-800">{{ $item['name'] }}</p>
            <p class="text-sm font-medium text-gray-900 whitespace-nowrap">Rp {{ number_format($item['price'],0,',','.') }}</p>
          </div>
          <div class="flex justify-between items-center">
            <form method="POST" action="{{ route('cart.update') }}" class="flex items-center border border-gray-200 rounded overflow-hidden">
              @csrf
              <input type="hidden" name="product_id" value="{{ $id }}">
              <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}" class="w-8 h-8 bg-transparent border-none text-gray-500 cursor-pointer hover:bg-gray-50 transition">&#8722;</button>
              <span class="w-8 text-center text-sm text-gray-700">{{ $item['qty'] }}</span>
              <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}" class="w-8 h-8 bg-transparent border-none text-gray-500 cursor-pointer hover:bg-gray-50 transition">&#43;</button>
            </form>
            <form method="POST" action="{{ route('cart.remove') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{ $id }}">
              <button class="text-[11px] text-gray-400 hover:text-gray-800 tracking-widest uppercase transition">Remove</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="border border-gray-100 rounded p-6 lg:sticky lg:top-20">
      <h3 class="font-serif text-lg text-gray-800 mb-6">Order Summary</h3>
      @php $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']); @endphp
      <div class="flex justify-between text-sm text-gray-500 mb-3">
        <span>Subtotal</span>
        <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
      </div>
      <div class="flex justify-between text-sm text-gray-400 mb-3">
        <span>Shipping</span><span>Calculated next</span>
      </div>
      <hr class="border-gray-100 my-4">
      <div class="flex justify-between font-bold text-gray-900 mb-6">
        <span>Total</span>
        <span>Rp {{ number_format($subtotal,0,',','.') }}</span>
      </div>
      <a href="{{ route('checkout.index') }}" class="block bg-[#0D1F3C] text-white text-center text-[11px] font-bold tracking-[.15em] uppercase py-4 mb-3 hover:opacity-80 transition">PROCEED TO CHECKOUT</a>
      <a href="{{ route('product') }}" class="block border border-gray-200 text-gray-700 text-center text-[11px] font-semibold uppercase py-4 hover:bg-gray-50 transition">CONTINUE SHOPPING</a>
      <p class="text-[10px] text-gray-300 text-center mt-4">&#x1F512; Secured with 256-bit SSL encryption</p>
    </div>
  </div>

  @if(isset($related) && $related->count())
  <div class="mt-20">
    <div class="flex justify-between items-baseline mb-6">
      <h2 class="font-serif text-2xl text-gray-800">Complete Your Order</h2>
      <a href="{{ route('product') }}" class="text-[11px] tracking-widest text-gray-400 hover:text-gray-700 uppercase transition">View All</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @foreach($related as $p)
      @php $rImg = is_array($p->images) ? ($p->images[0] ?? '/IMAGE/SUPER.jpeg') : '/IMAGE/SUPER.jpeg'; @endphp
      <div>
        <img src="{{ $rImg }}" class="w-full aspect-square object-cover mb-3" onerror="this.src='/IMAGE/SUPER.jpeg'">
        <p class="text-sm font-medium text-gray-800 truncate mb-1">{{ $p->name }}</p>
        <p class="text-xs text-gray-400 mb-3">Rp {{ number_format($p->price,0,',','.') }}</p>
        <button class="btn-add-cart w-full bg-[#0D1F3C] text-white text-[10px] font-semibold uppercase py-2.5 border-none cursor-pointer hover:opacity-80 transition"
          data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-price="{{ $p->price }}" data-image="{{ $rImg }}">ADD TO CART</button>
      </div>
      @endforeach
    </div>
  </div>
  @endif
  @endif
</div>
@endsection
