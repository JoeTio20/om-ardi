@extends('layouts.app')
@section('title','Checkout')
@section('content')
<div class="min-h-[80vh] bg-white px-4 md:px-16 py-10">

  <p class="text-[11px] text-gray-400 tracking-widest uppercase mb-6">
    <a href=" route('cart.index') " class="hover:text-gray-700 transition">Cart</a>
    <span class="mx-2">&rsaquo;</span>
    <span class="text-gray-700">Information &amp; Payment</span>
  </p>

  <h1 class="font-serif text-3xl md:text-4xl font-normal text-gray-900 mb-1">Checkout</h1>
  <hr class="border-gray-100 mt-6 mb-10">

  @if($errors->any())
  <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded mb-6">
    <ul class="list-disc pl-4">@foreach($errors->all() as $e)<li> $e </li>@endforeach</ul>
  </div>
  @endif

  <form method="POST" action=" route('checkout.store') ">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-12 items-start">

      <div>
        <h2 class="flex items-center gap-3 text-[13px] font-semibold tracking-widest uppercase text-gray-700 mb-6">
          <span class="w-6 h-6 rounded-full border border-gray-300 flex items-center justify-center text-[11px] text-gray-500">1</span>
          Shipping Details
        </h2>

        <div class="mb-5">
          <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">WhatsApp Number</label>
          <input type="text" name="whatsapp" value=" old('whatsapp') " placeholder="+62 812..."
            class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition placeholder-gray-300">
        </div>

        <div class="grid grid-cols-2 gap-5 mb-5">
          <div>
            <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">First Name</label>
            <input type="text" name="first_name" value=" old('first_name') " required
              class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition">
          </div>
          <div>
            <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">Last Name</label>
            <input type="text" name="last_name" value=" old('last_name') " required
              class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition">
          </div>
        </div>

        <div class="mb-5">
          <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">Shipping Address</label>
          <input type="text" name="address" value=" old('address') " placeholder="Street name and house number" required
            class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition placeholder-gray-300">
        </div>

        <div class="grid grid-cols-2 gap-5 mb-10">
          <div>
            <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">City</label>
            <input type="text" name="city" value=" old('city') " required
              class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition">
          </div>
          <div>
            <label class="block text-[11px] tracking-widest uppercase text-gray-400 mb-2">Postal Code</label>
            <input type="text" name="postal_code" value=" old('postal_code') "
              class="w-full border-b border-gray-200 pb-2 text-sm text-gray-800 bg-transparent outline-none focus:border-[#0D1F3C] transition">
          </div>
        </div>

        <h2 class="flex items-center gap-3 text-[13px] font-semibold tracking-widest uppercase text-gray-700 mb-6">
          <span class="w-6 h-6 rounded-full border border-gray-300 flex items-center justify-center text-[11px] text-gray-500">2</span>
          Payment Method
        </h2>

        <label id="lbl-midtrans" class="flex justify-between items-center border border-[#0D1F3C] rounded px-4 py-3.5 cursor-pointer mb-3 transition">
          <div class="flex items-center gap-3">
            <input type="radio" name="payment_method" value="midtrans" checked style="accent-color:#0D1F3C;" class="w-4 h-4">
            <span class="text-sm font-medium text-gray-800">Credit / Debit Card &amp; E-Wallet</span>
          </div>
          <svg width="18" height="18" fill="none" stroke="#999" stroke-width="1.5" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        </label>

        <label id="lbl-transfer" class="flex justify-between items-center border border-gray-200 rounded px-4 py-3.5 cursor-pointer mb-4 transition">
          <div class="flex items-center gap-3">
            <input type="radio" name="payment_method" value="transfer" style="accent-color:#0D1F3C;" class="w-4 h-4">
            <span class="text-sm font-medium text-gray-800">Manual Bank Transfer</span>
          </div>
          <svg width="18" height="18" fill="none" stroke="#999" stroke-width="1.5" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </label>

        <div id="bank-info" class="hidden bg-gray-50 border border-gray-100 rounded px-5 py-4 mb-6">
          <p class="text-[11px] font-semibold tracking-widest uppercase text-gray-500 mb-2">Transfer ke rekening:</p>
          <p class="text-sm text-gray-600">Bank BCA</p>
          <p class="text-xl font-bold text-gray-900 tracking-wider my-1">1234 5678 90</p>
          <p class="text-sm text-gray-500">a.n. Sarang Burung Walet</p>
          <p class="text-[11px] text-gray-400 mt-2">Konfirmasi pembayaran via WhatsApp setelah transfer.</p>
        </div>

        <button type="submit" class="flex items-center gap-3 bg-[#0D1F3C] text-white text-[11px] font-bold tracking-[.15em] uppercase px-10 py-4 border-none cursor-pointer hover:opacity-80 transition">
          COMPLETE ORDER
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        </button>
        <p class="text-[11px] text-gray-400 mt-3">Taxes and shipping calculated at checkout. Secure SSL encrypted.</p>
      </div>

      <div class="border border-gray-100 rounded p-6 lg:sticky lg:top-20">
        <h3 class="font-serif text-lg text-gray-800 mb-6">Order Summary</h3>
        @foreach($cart as $item)
        <div class="flex gap-3 items-center mb-4">
          <div class="relative flex-shrink-0">
            <img src=" $item['image'] ?? '/IMAGE/SUPER.jpeg' " class="w-14 h-14 object-cover rounded" onerror="this.src='/IMAGE/SUPER.jpeg'">
            <span class="absolute -top-1.5 -right-1.5 bg-[#0D1F3C] text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center"> $item['qty'] </span>
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-800 truncate"> $item['name'] </p>
            <p class="text-xs text-gray-400">Rp  number_format($item['price'],0,',','.') </p>
          </div>
          <p class="text-sm font-medium text-gray-800 whitespace-nowrap">Rp  number_format($item['price'] * $item['qty'],0,',','.') </p>
        </div>
        @endforeach
        <hr class="border-gray-100 my-4">
        @php $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']); @endphp
        <div class="flex justify-between text-sm text-gray-500 mb-2">
          <span>Subtotal</span><span>Rp  number_format($subtotal,0,',','.') </span>
        </div>
        <div class="flex justify-between text-sm text-gray-400 mb-4">
          <span>Shipping</span><span>Calculated later</span>
        </div>
        <div class="flex justify-between font-bold text-gray-900">
          <span>Total</span><span>Rp  number_format($subtotal,0,',','.') </span>
        </div>
      </div>

    </div>
  </form>
</div>

<script>
document.querySelectorAll('input[name="payment_method"]').forEach(function(r) {
  r.addEventListener('change', function() {
    var isTrans = this.value === 'transfer';
    document.getElementById('bank-info').classList.toggle('hidden', !isTrans);
    document.getElementById('lbl-midtrans').style.borderColor = isTrans ? '#e5e7eb' : '#0D1F3C';
    document.getElementById('lbl-transfer').style.borderColor = isTrans ? '#0D1F3C' : '#e5e7eb';
  });
});
</script>
@endsection
