@extends('admin.layout')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('header', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('content')

<div class="max-w-2xl">

  @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg mb-6">
      <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form method="POST"
        action="{{ isset($product) ? route('admin.products.update',$product->id) : route('admin.products.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if(isset($product)) @method('PUT') @endif

    <!-- Informasi Produk -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5 shadow-sm">
      <h3 class="text-sm font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">Informasi Produk</h3>
      <div class="space-y-4">
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Judul Produk <span class="text-red-400">*</span></label>
          <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                 class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-300 transition">
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
          <textarea name="description" rows="3"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-300 transition resize-none">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Harga (Rp) <span class="text-red-400">*</span></label>
          <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required min="0"
                 class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-300 transition">
        </div>
      </div>
    </div>

    <!-- Kategori & Badge -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5 shadow-sm">
      <h3 class="text-sm font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">Kategori & Label</h3>
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Kategori</label>
          <select name="category" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 bg-white">
            <option value="premium" {{ old('category',$product->category??'')==='premium'?'selected':'' }}>Premium</option>
            <option value="reguler" {{ old('category',$product->category??'')==='reguler'?'selected':'' }}>Reguler</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Badge</label>
          <select name="badge" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 bg-white">
            <option value="" {{ empty(old('badge',$product->badge??null))?'selected':'' }}>Tidak ada</option>
            <option value="new" {{ old('badge',$product->badge??'')==='new'?'selected':'' }}>NEW</option>
            <option value="limited" {{ old('badge',$product->badge??'')==='limited'?'selected':'' }}>LIMITED</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1.5">Status</label>
          <select name="is_active" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-gray-400 bg-white">
            <option value="1" {{ (old('is_active', $product->is_active ?? 1) == 1) ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ (old('is_active', $product->is_active ?? 1) == 0) ? 'selected' : '' }}>Nonaktif</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Foto Produk -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5 shadow-sm">
      <h3 class="text-sm font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">Foto Produk</h3>
      @if(isset($product) && !empty($product->images))
        <div class="flex gap-3 flex-wrap mb-4">
          @foreach($product->images as $img)
            <img src="{{ $img }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200">
          @endforeach
        </div>
        <p class="text-xs text-gray-400 mb-3">Upload baru akan mengganti semua foto di atas.</p>
      @endif
      <label class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-200 rounded-lg py-8 cursor-pointer hover:border-gray-400 hover:bg-gray-50 transition">
        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="text-sm text-gray-400">Klik untuk pilih foto</span>
        <span class="text-xs text-gray-300 mt-1">JPG, PNG, WEBP &bull; Maks 10MB per foto</span>
        <input type="file" name="images[]" multiple accept="image/*" class="hidden" onchange="showFileNames(this,'foto-label')">
      </label>
      <p id="foto-label" class="text-xs text-gray-500 mt-2 text-center"></p>
    </div>

    <!-- Video Produk -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6 shadow-sm">
      <h3 class="text-sm font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">Video Produk</h3>
      @if(isset($product) && $product->video)
        <video src="{{ $product->video }}" class="w-full max-h-40 object-cover rounded-lg mb-3 border border-gray-200" controls></video>
        <p class="text-xs text-gray-400 mb-3">Upload baru akan mengganti video di atas.</p>
      @endif
      <label class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-200 rounded-lg py-8 cursor-pointer hover:border-gray-400 hover:bg-gray-50 transition">
        <svg class="w-8 h-8 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="text-sm text-gray-400">Klik untuk pilih video</span>
        <span class="text-xs text-gray-300 mt-1">MP4, MOV, AVI &bull; Maks 50MB</span>
        <input type="file" name="video" accept="video/*" class="hidden" onchange="showFileNames(this,'video-label')">
      </label>
      <p id="video-label" class="text-xs text-gray-500 mt-2 text-center"></p>
    </div>

    <!-- Buttons -->
    <div class="flex items-center gap-3">
      @if(isset($product))
        <button type="submit"
                class="px-7 py-2.5 text-sm font-medium text-gray-800 border-2 border-green-500 rounded-lg hover:bg-green-50 transition">
          Simpan Perubahan
        </button>
      @else
        <button type="submit"
                class="px-7 py-2.5 text-sm font-medium text-white rounded-lg transition" style="background:#1c1917;">
          Tambah Produk
        </button>
      @endif
      <a href="{{ route('admin.products.index') }}"
         class="px-7 py-2.5 text-sm font-medium text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition">Batal</a>
    </div>

  </form>
</div>

<script>
function showFileNames(input, labelId) {
  const label = document.getElementById(labelId);
  if (input.files && input.files.length > 0) 
    const names = Array.from(input.files).map(f => f.name).join(', ');
    label.textContent = '✅ ' + names;
  
}
</script>
@endsection
