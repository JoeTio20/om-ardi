@extends('admin.layout')
@section('title','Dashboard - Admin')
@section('content')

<div class="px-5 pt-6 pb-4">
  <h1 class="serif text-3xl font-bold text-[#0D1F3C] mb-1">Inventory Dashboard</h1>
  <p class="text-sm text-[#64748B]">Real-time status of your artisanal collections.</p>
</div>
@if(session("success"))
<div class="mx-5 mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl">
  <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
  {{ session("success") }}
</div>
@endif
<!-- STAT CARDS -->
<div class="px-5 grid grid-cols-2 gap-3 mb-3">
  <div class="card">
    <div class="flex justify-between items-start mb-3">
      <div class="w-10 h-10 bg-[#EEF2F7] rounded-xl flex items-center justify-center">
        <svg width="20" height="20" fill="none" stroke="#0D1F3C" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2M9 12l2 2 4-4"/></svg>
      </div>
      <span class="text-[9px] tracking-widest font-bold uppercase text-[#94A3B8]">TOTAL</span>
    </div>
    <p class="text-3xl font-bold text-[#0D1F3C] mb-0.5">{{ $totalProducts }}</p>
    <p class="text-xs text-[#64748B]">Total Products</p>
  </div>
  <div class="card">
    <div class="flex justify-between items-start mb-3">
      <div class="w-10 h-10 bg-[#EEF2F7] rounded-xl flex items-center justify-center">
        <svg width="20" height="20" fill="none" stroke="#0D1F3C" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <span class="text-[9px] tracking-widest font-bold uppercase text-[#94A3B8]">ACTIVE</span>
    </div>
    <p class="text-3xl font-bold text-[#0D1F3C] mb-0.5">{{ $activeProducts }}</p>
    <p class="text-xs text-[#64748B]">In Production</p>
  </div>
</div>
<div class="px-5 mb-5">
  <div class="card">
    <div class="flex justify-between items-center">
      <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-[#F1F5F9] rounded-xl flex items-center justify-center">
          <svg width="22" height="22" fill="none" stroke="#94A3B8" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="10" y1="15" x2="10" y2="9"/><line x1="14" y1="15" x2="14" y2="9"/></svg>
        </div>
        <div>
          <p class="text-3xl font-bold text-[#0D1F3C]">{{ $inactiveProducts }}</p>
          <p class="text-xs text-[#64748B]">Archived Items</p>
        </div>
      </div>
      <span class="text-[9px] tracking-widest font-bold uppercase text-[#94A3B8]">INACTIVE</span>
    </div>
  </div>
</div>

<!-- LATEST CATALOG -->
<div class="px-5">
  <div class="flex justify-between items-center mb-4">
    <h2 class="serif text-xl font-bold text-[#0D1F3C]">Latest Catalog Updates</h2>
    <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-[#0D1F3C] underline">View All</a>
  </div>
  <div class="space-y-3">
@foreach($latestProducts as $p)
    <div class="card flex items-center gap-4">
      <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#F1F5F9] flex-shrink-0">
        <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover" onerror="this.src='/IMAGE/SUPER.jpeg'">
      </div>
      <div class="flex-1 min-w-0">
        <p class="serif text-[15px] font-bold text-[#0D1F3C] truncate">{{ $p->name }}</p>
        <p class="text-xs text-[#94A3B8] truncate">{{ Str::limit(\$p->description??'Sarang Burung',28) }}</p>
      </div>
      <div class="flex flex-col items-end gap-1.5">
        <span class="text-[9px] font-bold tracking-widest uppercase px-2 py-1 rounded {{ \$p->is_active ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-400' }}">
          {{ \$p->is_active ? 'ACTIVE' : 'INACTIVE' }}
        </span>
        <p class="text-sm font-semibold text-[#0D1F3C]">Rp {{ number_format(\$p->price,0,'.',',') }}</p>
      </div>
    </div>
@endforeach
  </div>
</div>

<!-- FAB -->
<a href="{{ route('admin.products.create') }}" class="fixed bottom-20 right-5 w-14 h-14 bg-[#0D1F3C] text-white rounded-full flex items-center justify-center shadow-lg z-30 hover:opacity-90 transition">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
</a>
@endsection
