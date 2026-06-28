@extends('admin.layout')
@section('title','Dashboard')
@section('header','Dashboard')
@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <div class="bg-white rounded shadow-sm border border-gray-100 p-6">
    <p class="text-xs tracking-widest uppercase text-gray-400 mb-2">Total Produk</p>
    <p class="text-4xl font-semibold">{{ $totalProducts }}</p>
  </div>
  <div class="bg-white rounded shadow-sm border border-gray-100 p-6">
    <p class="text-xs tracking-widest uppercase text-gray-400 mb-2">Produk Aktif</p>
    <p class="text-4xl font-semibold text-green-600">{{ $activeProducts }}</p>
  </div>
  <div class="bg-white rounded shadow-sm border border-gray-100 p-6">
    <p class="text-xs tracking-widest uppercase text-gray-400 mb-2">Produk Nonaktif</p>
    <p class="text-4xl font-semibold text-red-400">{{ $totalProducts - $activeProducts }}</p>
  </div>
</div>

<div class="bg-white rounded shadow-sm border border-gray-100 p-6">
  <div class="flex justify-between items-center mb-4">
    <h3 class="font-medium">Produk Terbaru</h3>
    <a href="{{ route('admin.products.index') }}" class="text-xs text-amber-700 hover:underline">Lihat semua</a>
  </div>
  <table class="w-full text-sm">
    <thead class="text-xs uppercase text-gray-400 border-b">
      <tr>
        <th class="pb-3 text-left">Nama</th>
        <th class="pb-3 text-left">Harga</th>
        <th class="pb-3 text-left">Status</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
      @foreach($latestProducts as $p)
      <tr>
        <td class="py-3">{{ $p->name }}</td>
        <td class="py-3">Rp {{ number_format($p->price,0,',','.') }}</td>
        <td class="py-3">
          <span class="px-2 py-1 text-xs rounded-full {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
