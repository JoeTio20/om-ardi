<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sarang Burung')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: { cream:"#F9F8F4", "cream-dark":"#F0EDE6", charcoal:"#1A1A18", tan:"#C8965A", "warm-gray":"#6B6B6B" },
            fontFamily: { serif: ["Playfair Display","Georgia","serif"], sans: ["Inter","system-ui","sans-serif"] }
        }}}
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family:'Inter',sans-serif; background:#F9F8F4; color:#1A1A18; }
        .nav-link { font-size:.7rem; letter-spacing:.12em; text-transform:uppercase; position:relative; transition:color .2s; }
        .nav-link.active::after { content:''; position:absolute; bottom:-4px; left:0; right:0; height:1.5px; background:#C8965A; }
        #toast { position:fixed; bottom:2rem; right:2rem; background:#1A1A18; color:#fff; padding:.8rem 1.4rem; border-radius:4px; font-size:.82rem; z-index:9999; display:none; }
        .product-img img { transition:transform .4s ease; }
        .product-card:hover .product-img img { transform:scale(1.05); }
        #mobile-menu { display:none; }
        #mobile-menu.open { display:block; }
    </style>
    @yield('head')
</head>
<body>

<!-- NAVBAR -->
<header class="sticky top-0 z-50 bg-cream border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 md:px-6 h-16 flex items-center justify-between">

    <!-- LEFT: Hamburger + Brand -->
    <div class="flex items-center gap-4">
      <button class="md:hidden flex flex-col gap-1.5 p-1" onclick="document.getElementById('mobile-menu').classList.toggle('open')"> 
        <span class="block w-5 h-0.5 bg-charcoal"></span>
        <span class="block w-5 h-0.5 bg-charcoal"></span>
        <span class="block w-5 h-0.5 bg-charcoal"></span>
      </button>
      <a href="{{ route('home') }}" class="font-serif text-base font-bold tracking-[.15em] uppercase">SARANG BURUNG</a>
    </div>

    <!-- CENTER: Nav desktop -->
    <nav class="hidden md:flex gap-7">
      <a href="{{ route('home') }}" class="nav-link text-warm-gray {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav_home') }}</a>
      <a href="{{ route('philosophy') }}" class="nav-link text-warm-gray {{ request()->routeIs('philosophy') ? 'active' : '' }}">{{ __('messages.nav_philosophy') }}</a>
      <a href="{{ route('product') }}" class="nav-link text-warm-gray {{ request()->routeIs('product') ? 'active' : '' }}">{{ __('messages.nav_product') }}</a>
    </nav>

    <!-- RIGHT: lang + cart + admin -->
    <div class="flex items-center gap-3">
      <a href="{{ route('lang.switch', app()->getLocale() === 'en' ? 'id' : 'en') }}" class="hidden sm:flex items-center gap-1 text-[11px] font-semibold tracking-widest border border-gray-300 rounded-full px-3 py-1 hover:bg-charcoal hover:text-cream transition">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
        {{ app()->getLocale() === 'en' ? 'ID' : 'EN' }}
      </a>
      <a href="{{ route('cart.index') }}" class="relative" id="cart-icon">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
        @if($cartCount > 0)
        <span id="cart-badge" style="position:absolute;top:-8px;right:-8px;background:#C8965A;color:white;font-size:10px;width:17px;height:17px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600">{{ $cartCount }}</span>
        @endif
      </a>
      <a href="/admin/login">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </a>
    </div>
  </div>

  <!-- MOBILE MENU -->
  <div id="mobile-menu" class="md:hidden bg-cream border-t border-gray-100 px-6 py-5">
    <nav class="flex flex-col gap-5">
      <a href="{{ route('home') }}" class="text-sm tracking-widest uppercase text-charcoal">{{ __('messages.nav_home') }}</a>
      <a href="{{ route('philosophy') }}" class="text-sm tracking-widest uppercase text-charcoal">{{ __('messages.nav_philosophy') }}</a>
      <a href="{{ route('product') }}" class="text-sm tracking-widest uppercase text-charcoal">{{ __('messages.nav_product') }}</a>
      <hr class="border-gray-200">
      <a href="{{ route('lang.switch', app()->getLocale() === 'en' ? 'id' : 'en') }}" class="text-sm text-warm-gray">{{ app()->getLocale() === 'en' ? 'Switch to ID' : 'Switch to EN' }}</a>
    </nav>
  </div>
</header>

<div id="toast"></div>
@yield('content')

<footer class="bg-charcoal text-cream pt-14 pb-6">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10 border-b border-white/10">
      <div>
        <p class="font-serif text-lg mb-3">Sarang Burung</p>
        <p class="text-sm text-white/50 leading-relaxed">{{ __('messages.f_tagline') }}</p>
      </div>
      <div>
        <h4 class="text-[10px] tracking-[.2em] uppercase text-white/40 mb-4">{{ __('messages.f_shop') }}</h4>
        <ul class="space-y-2">
          <li><a href="{{ route('product') }}" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_billfolds') }}</a></li>
          <li><a href="{{ route('product') }}" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_cards') }}</a></li>
          <li><a href="{{ route('product') }}" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_travel') }}</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-[10px] tracking-[.2em] uppercase text-white/40 mb-4">{{ __('messages.f_help') }}</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_care') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_privacy') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_terms') }}</a></li>
          <li><a href="#" class="text-sm text-white/60 hover:text-white transition">{{ __('messages.f_contact') }}</a></li>
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
</script>
@yield('scripts')
</body>
</html>