@extends('admin.layout')
@section('title','Inventory')
@section('header','Manajemen Produk')
@section('topbar-actions')
  <a href="{{ route('admin.products.create') }}" style="display:flex;align-items:center;gap:6px;background:#2C1810;color:#fff;font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;padding:10px 20px;border-radius:8px;text-decoration:none;">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Tambah Produk
  </a>
@endsection
@section('content')

<!-- Table Card -->
<div style="background:#fff;border-radius:12px;border:1px solid #EDE5DC;overflow:hidden;margin-bottom:20px;">

  <!-- Card Header -->
  <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid #F0E9E0;">
    <h2 style="font-size:15px;font-weight:600;color:#2C1810;">Daftar Produk</h2>
    <div style="position:relative;">
      <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);" width="14" height="14" fill="none" stroke="#A08070" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input id="searchInput" oninput="filterProducts()" placeholder="Cari produk..." style="border:1px solid #EDE5DC;border-radius:8px;padding:8px 12px 8px 32px;font-size:13px;color:#2C1810;outline:none;width:220px;background:#FAF7F4;">
    </div>
  </div>

  <!-- Table -->
  <table style="width:100%;border-collapse:collapse;" id="productTable">
    <thead>
      <tr style="background:#FAF7F4;">
        <th style="padding:12px 24px;text-align:left;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Foto</th>
        <th style="padding:12px 16px;text-align:left;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Nama Produk</th>
        <th style="padding:12px 16px;text-align:left;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Harga</th>
        <th style="padding:12px 16px;text-align:left;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Badge</th>
        <th style="padding:12px 16px;text-align:left;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Status</th>
        <th style="padding:12px 24px;text-align:right;font-size:10.5px;font-weight:600;color:#A08070;letter-spacing:.1em;text-transform:uppercase;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($products as $p)
      <tr style="border-top:1px solid #F5EFE8;transition:background .1s;" onmouseover="this.style.background='#FAF7F4'" onmouseout="this.style.background='#fff'" class="product-row" data-name="{{ strtolower($p->name) }}">
        <td style="padding:14px 24px;">
          <img src="{{ $p->thumbnail }}" style="width:52px;height:52px;object-fit:cover;border-radius:8px;border:1px solid #EDE5DC;">
        </td>
        <td style="padding:14px 16px;">
          <p style="font-size:14px;font-weight:500;color:#2C1810;margin-bottom:2px;">{{ $p->name }}</p>
          <p style="font-size:12px;color:#A08070;max-width:320px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">{{ $p->description }}</p>
        </td>
        <td style="padding:14px 16px;">
          <p style="font-size:11px;color:#A08070;">Rp</p>
          <p style="font-size:14px;font-weight:600;color:#2C1810;">{{ number_format($p->price,0,',','.') }}</p>
        </td>
        <td style="padding:14px 16px;">
          @if($p->badge === 'new')
            <span class="badge-new">NEW</span>
          @elseif($p->badge === 'limited')
            <span class="badge-limited">LIMITED</span>
          @else
            <span style="color:#D0C4B8;font-size:13px;">&mdash;</span>
          @endif
        </td>
        <td style="padding:14px 16px;">
          @if($p->is_active)
            <span style="display:flex;align-items:center;gap:5px;font-size:13px;color:#2C1810;">
              <span style="width:7px;height:7px;border-radius:50%;background:#22C55E;display:inline-block;"></span>Aktif
            </span>
          @else
            <span style="display:flex;align-items:center;gap:5px;font-size:13px;color:#A08070;">
              <span style="width:7px;height:7px;border-radius:50%;background:#D1D5DB;display:inline-block;"></span>Nonaktif
            </span>
          @endif
        </td>
        <td style="padding:14px 24px;text-align:right;">
          <a href="{{ route('admin.products.edit',$p->id) }}" style="font-size:13px;font-weight:500;color:#6B5B4E;text-decoration:none;margin-right:12px;">Edit</a>
          <form method="POST" action="{{ route('admin.products.destroy',$p->id) }}" style="display:inline;" onsubmit="return confirm('Yakin hapus produk ini?')">
            @csrf @method('DELETE')
            <button style="font-size:13px;font-weight:500;color:#E53E3E;background:none;border:none;cursor:pointer;">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="padding:48px;text-align:center;color:#A08070;font-size:13px;">Belum ada produk.</td></tr>
      @endforelse
    </tbody>
  </table>

  <!-- Footer -->
  <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid #F0E9E0;">
    <p style="font-size:12px;color:#A08070;">Menampilkan {{ $products->count() }} dari {{ $products->total() }} Produk</p>
    <div style="display:flex;gap:4px;align-items:center;">
      {{ $products->previousPageUrl() ? '<a href='.json_encode($products->previousPageUrl())." style='display:flex;align-items:center;justify-content:center;width:30px;height:30px;border:1px solid #EDE5DC;border-radius:6px;color:#6B5B4E;text-decoration:none;'>&lsaquo;</a>" : '' }}
      @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
        <a href="{{ $url }}" style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border:1px solid #EDE5DC;border-radius:6px;font-size:13px;text-decoration:none;{{ $page == $products->currentPage() ? 'background:#2C1810;color:#fff;border-color:#2C1810;' : 'color:#6B5B4E;' }}">{{ $page }}</a>
      @endforeach
      {{ $products->nextPageUrl() ? '<a href='.json_encode($products->nextPageUrl())." style='display:flex;align-items:center;justify-content:center;width:30px;height:30px;border:1px solid #EDE5DC;border-radius:6px;color:#6B5B4E;text-decoration:none;'>&rsaquo;</a>" : '' }}
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
  <div style="background:#fff;border-radius:12px;border:1px solid #EDE5DC;padding:20px;display:flex;align-items:center;gap:14px;">
    <div style="width:40px;height:40px;background:#F5EFE8;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="18" height="18" fill="none" stroke="#8B6914" stroke-width="1.7" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
    </div>
    <div>
      <p style="font-size:11px;color:#A08070;font-weight:500;letter-spacing:.04em;">Total SKU</p>
      <p style="font-size:17px;font-weight:600;color:#2C1810;margin-top:2px;">{{ $totalProducts }} Produk</p>
    </div>
  </div>
  <div style="background:#fff;border-radius:12px;border:1px solid #EDE5DC;padding:20px;display:flex;align-items:center;gap:14px;">
    <div style="width:40px;height:40px;background:#F5EFE8;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="18" height="18" fill="none" stroke="#8B6914" stroke-width="1.7" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
    </div>
    <div>
      <p style="font-size:11px;color:#A08070;font-weight:500;letter-spacing:.04em;">Best Seller</p>
      <p style="font-size:17px;font-weight:600;color:#2C1810;margin-top:2px;">{{ $bestSeller ?? 'N/A' }}</p>
    </div>
  </div>
  <div style="background:#fff;border-radius:12px;border:1px solid #EDE5DC;padding:20px;display:flex;align-items:center;gap:14px;">
    <div style="width:40px;height:40px;background:#F5EFE8;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
      <svg width="18" height="18" fill="none" stroke="#8B6914" stroke-width="1.7" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
    </div>
    <div>
      <p style="font-size:11px;color:#A08070;font-weight:500;letter-spacing:.04em;">Average Value</p>
      <p style="font-size:17px;font-weight:600;color:#2C1810;margin-top:2px;">Rp {{ $avgPrice ?? '0' }}</p>
    </div>
  </div>
</div>

<script>
function filterProducts() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  document.querySelectorAll('.product-row').forEach(row => {
    row.style.display = row.dataset.name.includes(q) ? '' : 'none';
  });
}
</script>
@endsection
