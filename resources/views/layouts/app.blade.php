<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Sarang Burung')</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config={theme:{extend:{colors:{
  navy:"#0D1F3C",cream:"#F8F6F2",charcoal:"#1A1A18",tan:"#C8965A"},
fontFamily:{serif:["Playfair Display","Georgia","serif"],sans:["Inter","system-ui"]}}}}
</script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; }
body { font-family: "Inter", sans-serif; background:#fff; color:#1A1A18; margin:0; }
.nav-link { font-size:11px; letter-spacing:.1em; text-transform:uppercase; color:#777; text-decoration:none; transition:color .2s; position:relative; }
.nav-link:hover { color:#1A1A18; }
.nav-link.active { color:#1A1A18; font-weight:600; }
.nav-link.active::after { content:""; position:absolute; bottom:-4px; left:0; right:0; height:1px; background:#1A1A18; }
#toast { position:fixed; bottom:2rem; right:2rem; background:#0D1F3C; color:#fff; padding:.75rem 1.5rem; border-radius:2px; font-size:.8rem; z-index:9999; display:none; letter-spacing:.05em; }
.product-card .overlay-btn { opacity:0; transform:translateY(8px); transition:all .3s; }
.product-card:hover .overlay-btn { opacity:1; transform:translateY(0); }
#mobile-menu { display:none; }
#mobile-menu.open { display:block; }
</style>
@yield('head')
</head>
<body>
<div id="toast"></div>

<header class="sticky top-0 z-50 bg-white border-b border-gray-100">
  <div class="max-w-screen-xl mx-auto px-6 h-14 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-serif text-sm font-bold tracking-[.2em] uppercase">SARANG BURUNG</a>
    <nav class="hidden md:flex items-center gap-8">
      <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
        {{ __('messages.nav_home') }}
      </a>
      <a href="{{ route('philosophy') }}" class="nav-link {{ request()->routeIs('philosophy') ? 'active' : '' }}">
        {{ __('messages.nav_philosophy') }}
      </a>
      <a href="{{ route('product') }}" class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}">
        {{ __('messages.nav_product') }}
      </a>
    </nav>
    <div class="flex items-center gap-4">
      <a href="{{ route('lang.switch', app()->getLocale()=='en'?'id':'en') }}" class="text-[10px] tracking-widest font-semibold text-gray-400 hover:text-gray-800 transition">
        {{ app()->getLocale()=='en'?'ID':'EN' }}
      </a>
      <a href="{{ route('cart.index') }}" class="relative" id="cart-icon">
        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
        @php $cartCount=collect(session('cart',[])) ->sum('qty'); @endphp
        @if($cartCount>0)
        <span id="cart-badge" style="position:absolute;top:-7px;right:-7px;background:#0D1F3C;color:#fff;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700">
          {{ $cartCount }}
        </span>
        @endif
      </a>
      <a href="/admin" class="text-gray-400 hover:text-gray-900 transition">
        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </a>
      <button class="md:hidden" onclick="document.getElementById('mobile-menu').classList.toggle('open')"
              aria-label="Menu">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>
  </div>
  <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-100">
    <nav class="flex flex-col px-6 py-5 gap-5">
      <a href="{{ route('home') }}" class="nav-link text-sm" onclick="document.getElementById('mobile-menu').classList.remove('open')">{{ __('messages.nav_home') }}</a>
      <a href="{{ route('philosophy') }}" class="nav-link text-sm" onclick="document.getElementById('mobile-menu').classList.remove('open')">{{ __('messages.nav_philosophy') }}</a>
      <a href="{{ route('product') }}" class="nav-link text-sm" onclick="document.getElementById('mobile-menu').classList.remove('open')">{{ __('messages.nav_product') }}</a>
    </nav>
  </div>
</header>

@yield('content')

<footer class="bg-white border-t border-gray-100 py-16">
  <div class="max-w-screen-xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
    <div>
      <p class="font-serif text-sm font-bold tracking-[.2em] uppercase mb-3">SARANG BURUNG</p>
      <p class="text-xs text-gray-400 leading-relaxed max-w-xs">{{ __('messages.f_tagline') }}</p>
    </div>
    <div>
      <p class="text-[10px] tracking-[.2em] uppercase text-gray-400 mb-4">NAVIGATION</p>
      <ul class="space-y-2">
        <li><a href="{{ route('philosophy') }}" class="text-xs text-gray-500 hover:text-gray-900 transition">{{ __('messages.nav_philosophy') }}</a></li>
        <li><a href="{{ route('product') }}" class="text-xs text-gray-500 hover:text-gray-900 transition">{{ __('messages.nav_product') }}</a></li>
        <li><a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-900 transition">Heritage</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[10px] tracking-[.2em] uppercase text-gray-400 mb-4">LEGAL</p>
      <ul class="space-y-2">
        <li><a href="#" class="text-xs text-gray-500 hover:text-gray-900 transition">{{ __('messages.f_privacy') }}</a></li>
        <li><a href="#" class="text-xs text-gray-500 hover:text-gray-900 transition">{{ __('messages.f_terms') }}</a></li>
        <li><a href="#" class="text-xs text-gray-500 hover:text-gray-900 transition">{{ __('messages.f_contact') }}</a></li>
      </ul>
    </div>
    <div>
      <p class="text-[10px] tracking-[.2em] uppercase text-gray-400 mb-4">STATUS</p>
      <p class="text-xs text-gray-400">{{ __('messages.f_global') }}</p>
    </div>
  </div>
  <div class="max-w-screen-xl mx-auto px-6 mt-10 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-2">
    <p class="text-[10px] text-gray-300 tracking-wide">{{ __('messages.f_copyright') }}</p>
  </div>
</footer>

<script>
function showToast(msg){const t=document.getElementById("toast");t.textContent=msg;t.style.display="block";clearTimeout(window._tt);window._tt=setTimeout(()=>t.style.display="none",3000);}
document.addEventListener("click",function(e){
  const btn=e.target.closest(".btn-add-cart"); if(!btn) return; e.preventDefault();
  fetch("{{ route('cart.add') }}",{
    method:"POST",
    headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector("meta[name=csrf-token]").content},
    body:JSON.stringify({product_id:btn.dataset.id,name:btn.dataset.name,price:btn.dataset.price,image:btn.dataset.image})
  }).then(r=>r.json()).then(res=>{
    if(!res.success) return;
    showToast(res.message||"Ditambahkan ke keranjang!");
    let badge=document.getElementById("cart-badge");
    if(badge){ badge.textContent=res.count; }
    else{
      const icon=document.getElementById("cart-icon");
      badge=document.createElement("span");
      badge.id="cart-badge";
      badge.style.cssText="position:absolute;top:-7px;right:-7px;background:#0D1F3C;color:#fff;font-size:9px;width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700";
      badge.textContent=res.count;
      icon.style.position="relative";
      icon.appendChild(badge);
    }
  }).catch(()=>showToast("Gagal menambahkan."));
});
</script>
@yield('scripts')
</body>
</html>
