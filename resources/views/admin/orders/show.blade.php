@extends('admin.layout')
@section('title','Detail Pesanan')
@section('content')
<div class="p-6 max-w-4xl">

  <div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-gray-700">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
    </a>
    <h1 class="text-xl font-bold text-gray-800">Pesanan ##{{ $order->id }}</h1>
  </div>

  @if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
    {{ session('success') }}
  </div>
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    -- Info Pelanggan --
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <h2 class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-4">Info Pelanggan</h2>
      <p class="font-semibold text-gray-800 mb-1">{{ $order->full_name }}</p>
      <p class="text-sm text-gray-500 mb-1">WhatsApp: {{ $order->whatsapp }}</p>
      <p class="text-sm text-gray-500 mb-1">{{ $order->address }}</p>
      <p class="text-sm text-gray-500">{{ $order->city }}, {{ $order->postal_code }}</p>
    </div>

    -- Update Status --
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
      <h2 class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-4">Update Status</h2>
      <form method="POST" action="{{ route('admin.orders.status', $order) }}">
        @csrf
        @method('PATCH')
        <select name="status" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-700 mb-3 focus:outline-none focus:border-[#0D1F3C]">
          @foreach([
            'pending'      => 'Pending (Menunggu)',
            'dikonfirmasi' => 'Dikonfirmasi',
            'dikemas'      => 'Sedang Dikemas',
            'diantar'      => 'Sedang Diantar',
            'selesai'      => 'Selesai',
            'dibatalkan'   => 'Dibatalkan',
          ] as $val => $label)
          <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        <button type="submit" class="w-full bg-[#0D1F3C] text-white text-xs font-semibold tracking-widest uppercase py-2.5 rounded-xl hover:opacity-80 transition">
          Simpan Status
        </button>
      </form>

      @php
      $steps = ['pending','dikonfirmasi','dikemas','diantar','selesai'];
      $currentIdx = array_search($order->status, $steps);
      @endphp
      <div class="mt-5 flex items-center gap-1">
        @foreach($steps as $i => $step)
        <div class="flex-1 h-1.5 rounded-full {{ $currentIdx !== false && $i <= $currentIdx ? 'bg-[#0D1F3C]' : 'bg-gray-100' }}"></div>
        @endforeach
      </div>
      <div class="flex justify-between mt-1">
        @foreach(['Pending','Konfirmasi','Dikemas','Diantar','Selesai'] as $lbl)
        <span class="text-[9px] text-gray-400">{{ $lbl }}</span>
        @endforeach
      </div>
    </div>
  </div>

  -- Items --
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
    <h2 class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-4">Item Pesanan</h2>
    <table class="w-full text-sm">
      <thead class="text-xs text-gray-400 border-b border-gray-100">
        <tr>
          <th class="pb-2 text-left">Produk</th>
          <th class="pb-2 text-center">Qty</th>
          <th class="pb-2 text-right">Harga</th>
          <th class="pb-2 text-right">Subtotal</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @foreach($order->items as $item)
        <tr>
          <td class="py-3 flex items-center gap-3">
            <img src="{{ $item['image'] ?? '/IMAGE/SUPER.jpeg' }}" class="w-10 h-10 object-cover rounded" onerror="this.src='/IMAGE/SUPER.jpeg'">
            <span class="font-medium text-gray-800">{{ $item['name'] }}</span>
          </td>
          <td class="py-3 text-center text-gray-600">{{ $item['qty'] }}</td>
          <td class="py-3 text-right text-gray-600">Rp {{ number_format($item['price'],0,',','.') }}</td>
          <td class="py-3 text-right font-semibold text-gray-800">Rp {{ number_format($item['price']*$item['qty'],0,',','.') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot class="border-t border-gray-100">
        <tr>
          <td colspan="3" class="pt-3 text-right font-semibold text-gray-700">Total</td>
          <td class="pt-3 text-right font-bold text-gray-900">Rp {{ number_format($order->total,0,',','.') }}</td>
        </tr>
      </tfoot>
    </table>
  </div>

  -- Payment --
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
    <h2 class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-3">Pembayaran</h2>
    <p class="text-sm text-gray-700">Metode: <span class="font-semibold">{{ ucfirst($order->payment_method) }}</span></p>
    <p class="text-sm text-gray-500 mt-1">Order dibuat: {{ $order->created_at->format('d M Y, H:i') }}</p>
  </div>

</div>
@endsection
