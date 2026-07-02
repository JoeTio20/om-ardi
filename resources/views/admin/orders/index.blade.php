@extends('admin.layout')
@section('title','Daftar Pesanan')
@section('content')
<div class="p-6">

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-bold text-gray-800">Daftar Pesanan</h1>
    <span class="text-sm text-gray-500">{{ $orders->total() }} pesanan</span>
  </div>

  @if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
    {{ session('success') }}
  </div>
  @endif

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
        <tr>
          <th class="px-4 py-3 text-left">#</th>
          <th class="px-4 py-3 text-left">Pelanggan</th>
          <th class="px-4 py-3 text-left">WhatsApp</th>
          <th class="px-4 py-3 text-left">Total</th>
          <th class="px-4 py-3 text-left">Pembayaran</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Tanggal</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-50">
        @forelse($orders as $order)
        @php
        $statusMap = [
            'pending'      => ['label'=>'Pending',      'class'=>'bg-yellow-100 text-yellow-700'],
            'dikonfirmasi' => ['label'=>'Dikonfirmasi', 'class'=>'bg-blue-100 text-blue-700'],
            'dikemas'      => ['label'=>'Dikemas',      'class'=>'bg-purple-100 text-purple-700'],
            'diantar'      => ['label'=>'Diantar',      'class'=>'bg-indigo-100 text-indigo-700'],
            'selesai'      => ['label'=>'Selesai',      'class'=>'bg-green-100 text-green-700'],
            'dibatalkan'   => ['label'=>'Dibatalkan',   'class'=>'bg-red-100 text-red-700'],
        ];
        $s = $statusMap[$order->status] ?? ['label'=>$order->status,'class'=>'bg-gray-100 text-gray-700'];
        @endphp
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-3 font-mono text-gray-400">##{{ $order->id }}</td>
          <td class="px-4 py-3 font-medium text-gray-800">{{ $order->full_name }}</td>
          <td class="px-4 py-3 text-gray-500">{{ $order->whatsapp }}</td>
          <td class="px-4 py-3 font-semibold text-gray-800">Rp {{ number_format($order->total,0,',','.') }}</td>
          <td class="px-4 py-3 text-gray-500">{{ ucfirst($order->payment_method) }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $s['class'] }}">
              {{ $s['label'] }}
            </span>
          </td>
          <td class="px-4 py-3 text-gray-400 text-xs">{{ $order->created_at->format('d M Y H:i') }}</td>
          <td class="px-4 py-3">
            <a href="{{ route('admin.orders.show', $order) }}" class="text-[#0D1F3C] font-semibold text-xs hover:underline">Detail &rarr;</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="px-4 py-12 text-center text-gray-400">Belum ada pesanan masuk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $orders->links() }}
  </div>
</div>
@endsection
