@extends('layouts.app')
@section('title','Keranjang Belanja')
@section('content')

<div class="min-h-[80vh] px-4 md:px-16 py-8 md:py-10" style="background:#FAF8F5;">

  <p class="text-xs text-[#A08070] mb-5">
    <a href="/" class="text-[#A08070] no-underline hover:text-[#2C1810]">Home</a>
    <span class="mx-2">&rsaquo;</span>
    <span class="text-[#2C1810]">Shopping Cart</span>
  </p>

  <h1 style="font-family:'Playfair Display',serif;" class="text-3xl md:text-4xl font-normal text-[#1A1009] mb-1">Your Selection</h1>
  <p class="text-sm text-[#A08070] mb-6">Carefully curated pieces, ready for their journey.</p>
  <hr class="border-[#E8DDD2] mb-8">

  @if(session('cart_success'))
    <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded mb-5">
       session('cart_success') 
    </div>
  @endif

  @if(empty($cart))
    <div class="text-center py-20 px-4">
      <svg class="mx-auto mb-4" width="48" height="48" fill="none" stroke="#C4B5A5" stroke-width="1.3" viewBox="0 0 24 24">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 01-8 0"/>
      </svg>
      <p style="font-family:'Playfair Display',serif;" class="text-2xl text-[#2C1810] mb-2">Keranjang kosong</p>
      <p class="text-sm text-[#A08070] mb-6">Temukan produk terbaik kami.</p>
      <a href=" route('product') "
         class="inline-block bg-[#2C1810] text-white text-[11px] font-semibold tracking-[.15em] uppercase px-8 py-4 hover:opacity-80 transition no-underline">
        VIEW PRODUCTS
      </a>
    </div>

  @else
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-6 items-start">

      <!-- LEFT: Items -->
      <div>
        @foreach($cart as $id => $item)
        <div class="bg-white border border-[#EDE5DC] rounded p-4 md:p-5 flex gap-4 mb-4">
          <img src=" $item['image'] ?? '/IMAGE/SUPER.jpeg' "
               class="w-20 h-20 md:w-24 md:h-24 object-cover rounded flex-shrink-0"
               onerror="this.src='/IMAGE/SUPER.jpeg'">
          <div class="flex-1 min-w-0">
            <div class="flex justify-between items-start gap-2">
              <div class="min-w-0">
                <p style="font-family:'Playfair Display',serif;" class="text-base text-[#2C1810]"> $item['name'] </p>
                <p class="text-[11px] text-[#A08070] uppercase tracking-wider line-clamp-2"> Str::limit($item['desc'] ?? '', 60) </p>
              </div>
              <p class="text-sm font-medium text-[#2C1810] whitespace-nowrap">Rp  number_format($item['price'], 0, ',', '.') </p>
            </div>
            <div class="flex justify-between items-center mt-4">
              <form method="POST" action=" route('cart.update') " class="flex items-center border border-[#E8DDD2] rounded overflow-hidden">
                @csrf
                <input type="hidden" name="product_id" value=" $id ">
                <button type="submit" name="qty" value=" $item['qty'] - 1 "
                        class="w-8 h-8 bg-transparent border-none text-lg cursor-pointer text-[#6B5B4E] hover:bg-[#F5F0EB] transition">&#8722;</button>
                <span class="w-8 text-center text-sm text-[#2C1810]"> $item['qty'] </span>
                <button type="submit" name="qty" value=" $item['qty'] + 1 "
                        class="w-8 h-8 bg-transparent border-none text-lg cursor-pointer text-[#6B5B4E] hover:bg-[#F5F0EB] transition">&#43;</button>
              </form>
              <form method="POST" action=" route('cart.remove') ">
                @csrf
                <input type="hidden" name="product_id" value=" $id ">
                <button class="bg-transparent border-none text-xs text-[#A08070] cursor-pointer flex items-center gap-1 hover:text-[#2C1810] transition">
                  <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6M9 6V4h6v2"/>
                  </svg>
                  Remove
                </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach

        <div class="bg-[#FBF6EE] border border-[#EDE5DC] rounded p-4 flex justify-between items-center">
          <div class="flex items-center gap-3">
            <svg width="20" height="20" fill="none" stroke="#8B6914" stroke-width="1.5" viewBox="0 0 24 24">
              <polyline points="20 12 20 22 4 22 4 12"/><rect x="2" y="7" width="20" height="5"/>
              <line x1="12" y1="22" x2="12" y2="7"/>
              <path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/>
              <path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/>
            </svg>
            <div>
              <p class="text-sm font-medium text-[#2C1810]">This is a gift</p>
              <p class="text-xs text-[#A08070]">Complimentary gift wrapping and a personalized note.</p>
            </div>
          </div>
          <svg width="16" height="16" fill="none" stroke="#A08070" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="bg-white border border-[#EDE5DC] rounded p-6 lg:sticky lg:top-20">
        <h3 style="font-family:'Playfair Display',serif;" class="text-lg text-[#2C1810] mb-5">Order Summary</h3>
        @php $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']); @endphp
        <div class="flex justify-between text-sm text-[#6B5B4E] mb-3">
          <span>Subtotal</span>
          <span>Rp  number_format($subtotal, 0, ',', '.') </span>
        </div>
        <div class="flex justify-between text-sm text-[#6B5B4E] mb-3">
          <span>Standard Shipping</span>
          <span class="text-[#A08070]">Calculated next</span>
        </div>
        <hr class="border-[#F0E9E0] my-4">
        <div class="flex justify-between text-base font-bold text-[#2C1810] mb-5">
          <span>Total</span>
          <span>Rp  number_format($subtotal, 0, ',', '.') </span>
        </div>
        <a href=" route('checkout.index') "
           class="block bg-[#2C1810] text-white text-center text-[11px] font-bold tracking-[.15em] uppercase py-4 mb-3 no-underline hover:opacity-80 transition">
          PROCEED TO CHECKOUT
        </a>
        <a href=" route('product') "
           class="block bg-white text-[#2C1810] text-center text-[11px] font-semibold tracking-[.12em] uppercase py-4 no-underline border border-[#2C1810] hover:bg-[#2C1810] hover:text-white transition">
          CONTINUE SHOPPING
        </a>
        <p class="text-[10px] text-[#C4B5A5] text-center mt-4">&#x1F512; Secured with 256-bit SSL encryption</p>
      </div>
    </div>

    @if(isset($related) && $related->count())
    <div class="mt-16">
      <div class="flex justify-between items-baseline mb-5">
        <h2 style="font-family:'Playfair Display',serif;" class="text-2xl md:text-3xl text-[#1A1009]">Complete Your Order</h2>
        <a href=" route('product') " class="text-xs text-[#8B6914] border-b border-[#8B6914] no-underline hover:opacity-70">View All</a>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($related as $p)
        <div>
          <img src=" $p->images[0] ?? '/IMAGE/SUPER.jpeg' "
               class="w-full aspect-square object-cover mb-2 rounded"
               onerror="this.src='/IMAGE/SUPER.jpeg'">
          <p class="text-sm font-medium text-[#2C1810] truncate"> $p->name </p>
          <p class="text-xs text-[#A08070] mb-2">Rp  number_format($p->price, 0, ',', '.') </p>
          <form method="POST" action=" route('cart.add') ">
            @csrf
            <input type="hidden" name="product_id" value=" $p->id ">
            <input type="hidden" name="name" value=" $p->name ">
            <input type="hidden" name="price" value=" $p->price ">
            <input type="hidden" name="image" value=" $p->images[0] ?? '/IMAGE/SUPER.jpeg' ">
            <button type="submit"
                    class="w-full bg-[#2C1810] text-white text-[10px] font-semibold tracking-[.1em] uppercase py-2.5 border-none cursor-pointer hover:opacity-80 transition">
              ADD TO CART
            </button>
          </form>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  @endif
</div>
@endsection
