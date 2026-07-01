@extends('admin.layout')
@section('title','Inventory - Admin')
@section('content')

<div class="px-5 pt-6 pb-3 flex items-center justify-between">
  <div>
    <h1 class="serif text-2xl font-bold text-[#0D1F3C]">Inventory</h1>
    <p class="text-[10px] tracking-widest uppercase text-[#94A3B8] font-semibold">Maritime Admin</p>
  </div>
  <div class="flex gap-2">
    <button onclick="document.getElementById('srch').classList.toggle('hidden')" class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
      <svg width="18" height="18" fill="none" stroke="#0D1F3C" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
    </button>
    <a href="{{ route('admin.products.create') }}" class="w-10 h-10 bg-[#0D1F3C] rounded-xl flex items-center justify-center shadow-sm">
      <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    </a>
  </div>
</div>
<div id="srch" class="hidden px-5 pb-3">
  <input type="text" placeholder="Cari nama produk atau SKU..." class="w-full bg-white border border-gray-100 rounded-xl px-4 py-3 text-sm outline-none shadow-sm focus:border-[#0D1F3C]" oninput="filterCards(this.value)">
</div>
@if(session("success"))<div class="mx-5 mb-3 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>{{ session("success") }}</div>@endif
<!-- DARK STATS BANNER -->
<div class="mx-5 mb-5 rounded-2xl overflow-hidden" style="background:#0D1F3C">
  <div class="relative p-5">
    <div class="absolute right-4 top-3 opacity-10">
      <svg width="80" height="80" viewBox="0 0 24 24" fill="white"><path d="M2 20s3-3 7-3 7 3 12 3"/><circle cx="12" cy="7" r="3" fill="white"/><path d="M12 10v7" stroke="white" stroke-width="2"/><path d="M9 20a4 4 0 01-4-4" stroke="white" stroke-width="2"/><path d="M15 20a4 4 0 004-4" stroke="white" stroke-width="2"/></svg>
    </div>
    <p class="text-[10px] tracking-widest font-bold uppercase mb-1" style="color:rgba(255,255,255,.5)">AVERAGE VALUE</p>
    <p class="text-3xl font-bold text-white mb-2">Rp {{ number_format(\$avgPrice,0,'.',',') }}</p>
    <p class="text-xs mb-4" style="color:rgba(255,255,255,.5)">Rata-rata harga produk aktif</p>
    <div class="grid grid-cols-2 gap-3 pt-4" style="border-top:1px solid rgba(255,255,255,.1)">
      <div>
        <p class="text-[9px] tracking-widest font-bold uppercase mb-1" style="color:rgba(255,255,255,.4)">TOTAL SKU</p>
        <p class="text-base font-bold text-white">{{ $totalProducts }} Items</p>
      </div>
      <div>
        <p class="text-[9px] tracking-widest font-bold uppercase mb-1" style="color:rgba(255,255,255,.4)">AKTIF</p>
        <p class="text-base font-bold text-white">{{ $activeProducts }} Produk</p>
      </div>
    </div>
  </div>
</div>

<!-- PRODUCT LIST -->
<div class="px-5">
  <div class="flex justify-between items-center mb-4">
    <h2 class="serif text-xl font-bold text-[#0D1F3C]">Katalog Produk</h2>
  </div>
  <div class="space-y-3" id="product-list">
@foreach($products as $p)
    <div class="card product-item" data-name="{{ strtolower($p->name) }}">
      <div class="flex gap-4 items-start mb-3">
        <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#F1F5F9] flex-shrink-0">
          <img src="{{ $p->thumbnail }}" alt="{{ $p->name }}" class="w-full h-full object-cover" onerror="this.src='/IMAGE/SUPER.jpeg'">
        </div>
        <div class="flex-1 min-w-0">
          <div class="flex justify-between items-start gap-2 mb-1">
            <p class="serif text-base font-bold text-[#0D1F3C] leading-tight">{{ $p->name }}</p>
            <span class="text-[9px] font-bold tracking-widest uppercase px-2 py-0.5 rounded flex-shrink-0 {{ \$p->is_active ? 'bg-amber-50 text-amber-600' : 'bg-gray-100 text-gray-400' }}">
              {{ \$p->is_active ? 'AKTIF' : 'NON-AKTIF' }}
            </span>
          </div>
          <p class="text-xs text-[#94A3B8] mb-1">{{ \$p->sku??'#SB-'.str_pad(\$p->id,3,'0',STR_PAD_LEFT) }}</p>
          <p class="text-base font-bold text-[#0D1F3C]">Rp {{ number_format(\$p->price,0,'.',',') }}</p>
        </div>
      </div>

      <div class="flex gap-3 pt-3" style="border-top:1px solid #F1F5F9">
        <a href="{{ route('admin.products.edit') }}/{{'.'$p->id.'.'}" class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl bg-[#F8FAFC] text-[#0D1F3C] text-[11px] font-semibold tracking-wide uppercase hover:bg-[#EEF2F7] transition">
          <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          EDIT
        </a>
        <form method="POST" action="{{ route('admin.products.destroy') }}/{{'.'$p->id.''}" onsubmit="return confirm('Hapus produk ini?')"> @csrf @method('DELETE')
          <button type="submit" class="w-11 h-10 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
          </button>
        </form>
      </div>
    </div>
@endforeach
  </div>
</div>

<!-- FAB -->
<a href="{{ route('admin.products.create') }}" class="fixed bottom-20 right-5 w-14 h-14 bg-[#0D1F3C] text-white rounded-full flex items-center justify-center shadow-xl z-30 hover:opacity-90 transition">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
</a>
@section('scripts')
<script>
function filterCards(q){
  document.querySelectorAll('.product-item').forEach(card=>{
    card.style.display = card.dataset.name.includes(q.toLowerCase()) ? 'block' : 'none';
  });
}
</script>
@endsection@endsection
