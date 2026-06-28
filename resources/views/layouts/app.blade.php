<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sarang Burung')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: { cream:"#F9F8F4", "cream-dark":"#F0EDE6", charcoal:"#1A1A18", tan:"#C8965A", "warm-gray":"#6B6B6B" },
            fontFamily: { serif: ["Playfair Display", "Georgia", "serif"], sans: ["Inter", "system-ui", "sans-serif"] }
        }}}
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #F9F8F4; color: #1A1A18; }
        .nav-link { font-size:.7rem; letter-spacing:.12em; text-transform:uppercase; position:relative; transition:color .2s; }
        .nav-link.active::after { content:''; position:absolute; bottom:-4px; left:0; right:0; height:1.5px; background:#C8965A; }
        #toast { position:fixed; bottom:2rem; right:2rem; background:#1A1A18; color:#fff; padding:.8rem 1.4rem; border-radius:4px; font-size:.82rem; z-index:9999; display:none; }
        .product-img img { transition: transform .4s ease; }
        .product-card:hover .product-img img { transform: scale(1.05); }
    </style>
    @yield('head')
</head>
<body>

<!-- NAVBAR -->
<header class="sticky top-0 z-50 bg-cream border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-6 h-16 grid grid-cols-3 items-center">

    <!-- LEFT -->
    <div class="flex items-center">
      @hasSection('nav-centered')
        <nav class="flex gap-7">
          <a href="{{ route('home') }}" class="nav-link text-warm-gray {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a>
          <a href="{{ route('philosophy') }}" class="nav-link text-warm-gray {{ request()->routeIs('philosophy') ? 'active' : '' }}">{{ __('messages.nav_philosophy') }}</a>
        </nav>
      @else
        <a href="{{ route('home') }}" class="text-sm font-semibold tracking-widest uppercase">Sarang Burung</a>
      @endif
    </div>

    <!-- CENTER -->
    <div class="flex justify-center">
      @hasSection('nav-centered')
        <a href="{{ route('home') }}" class="font-serif text-lg font-bold tracking-[.2em] uppercase">SARANG BURUNG</a>
      @else
        <nav class="flex gap-7">
          <a href="{{ route('home') }}" class="nav-link text-warm-gray {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a>
          <a href="{{ route('philosophy') }}" class="nav-link text-warm-gray {{ request()->routeIs('philosophy') ? 'active' : '' }}">{{ __('messages.nav_philosophy') }}</a>
          <a href="{{ route('product') }}" class="nav-link text-warm-gray {{ request()->routeIs('product') ? 'active' : '' }}">{{ __('messages.nav_product') }}</a>
        </nav>
      @endif
    </div>

    <!-- RIGHT -->
    <div class="flex items-center justify-end gap-4">
      @php $locale = app()->getLocale(); @endphp
      <a href="{{ route('lang.switch', $locale === 'id' ? 'en' : 'id') }}"
         class="flex items-center gap-1 text-[11px] font-semibold tracking-widest border border-gray-300 rounded-full px-3 py-1 hover:bg-charcoal hover:text-cream transition">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/>
          <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
        </svg>
        {{ __('messages.lang_switch') }}
      </a>
      <a href="{{ route('cart.index') }}" class="relative" id="cart-icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        @if($cartCount > 0)
        <span id="cart-badge" style="position:absolute;top:-8px;right:-8px;background:#C8965A;color:white;font-size:10px;width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600">
          {{ $cartCount }}
        </span>
        @endif
      </a>
      <a href="/admin/login">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
      </a>
    </div>
  </div>
</header>

<div id="toast"></div>
@yield('content')

<footer class="bg-charcoal text-cream pt-14 pb-6">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10 border-b border-white/10">
      <div>
        <p class="font-serif text-lg mb-3">Sarang Burung</p>
        <p class="text-sm text-white/50 leading-relaxed">{{ __('messages.f_tagline') }}</p>
      </div>
      <div>
        <h4 class="text-[10px] tracking-[.2em] uppercase text-white/40 mb-4">{{ __('messages.f_shop') }}</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('product') }}?category=billfolds" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_billfolds') }}</a></li>
          <li><a href="{{ route('product') }}?category=cardholders" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_cards') }}</a></li>
          <li><a href="{{ route('product') }}?category=travel" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_travel') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_care') }}</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-[10px] tracking-[.2em] uppercase text-white/40 mb-4">{{ __('messages.f_help') }}</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_shipping') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_contact') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_privacy') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_terms') }}</a></li>
        </ul>
      </div>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center pt-5 text-xs text-white/30 gap-2">
      <span>{{ __('messages.f_copyright') }}</span>
      <div class="flex gap-5"><span>{{ __('messages.f_global') }}</span><span>{{ __('messages.f_warranty') }}</span></div>
    </div>
  </div>
</footer>

<script>
function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg; t.style.display = 'block';
  clearTimeout(window._t); window._t = setTimeout(() => t.style.display = 'none', 3000);
}
document.addEventListener('click', e => {
  const btn = e.target.closest('.btn-add-cart');
  if (!btn) return;
  fetch('{{ route('cart.add') }}', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
    body: JSON.stringify({ id: btn.dataset.id, name: btn.dataset.name, price: btn.dataset.price, image: btn.dataset.image })
  }).then(r => r.json()).then(res => {
    if (!res.success) return;
    showToast(res.message);
    let badge = document.getElementById('cart-badge');
    if (badge) { badge.textContent = res.count; }
    else {
      const icon = document.getElementById('cart-icon');
      badge = document.createElement('span'); badge.id = 'cart-badge';
      badge.style.cssText = 'position:absolute;top:-8px;right:-8px;background:#C8965A;color:white;font-size:10px;width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600';
      badge.textContent = res.count; icon.style.position = 'relative'; icon.appendChild(badge);
    }
  });
});
</script>
@yield('scripts')
</body>
</html>