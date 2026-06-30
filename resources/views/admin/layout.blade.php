<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<title>@yield('title','Admin')</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{font-family:"Inter",sans-serif;-webkit-tap-highlight-color:transparent;}
.serif{font-family:"Playfair Display",serif;}
body{background:#FAF7F4;overscroll-behavior:none;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:8px;font-size:13px;color:#6B5B4E;cursor:pointer;text-decoration:none;transition:all .15s;margin:1px 6px;}
.nav-item:hover,.nav-item.active{background:#E8DDD2;color:#3D2B1F;}
.nav-item.active{border-left:3px solid #8B6914;padding-left:11px;font-weight:600;}
.nav-item svg{width:16px;height:16px;opacity:.65;flex-shrink:0;}
.nav-item.active svg{opacity:1;}
/* BOTTOM NAV mobile */
#bottom-nav{display:none;}
@media(max-width:767px){
  #bottom-nav{display:flex;position:fixed;bottom:0;left:0;right:0;background:#fff;border-top:1px solid #EDE5DC;z-index:50;padding-bottom:env(safe-area-inset-bottom);}
  .bnav-item{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:8px 4px;gap:3px;text-decoration:none;color:#A08070;font-size:9px;font-weight:500;letter-spacing:.04em;text-transform:uppercase;transition:color .15s;}
  .bnav-item.active,.bnav-item:hover{color:#2C1810;}
  .bnav-item svg{width:20px;height:20px;}
  #main-content{padding-bottom:70px;}
  #desktop-sidebar{display:none!important;}
  #mobile-topbar{display:flex!important;}
}
@media(min-width:768px){
  #mobile-topbar{display:none;}
  #desktop-sidebar{display:flex;}
}
#mobile-topbar{display:none;align-items:center;justify-content:space-between;padding:12px 16px;background:#FAF7F4;border-bottom:1px solid #EDE5DC;position:sticky;top:0;z-index:40;}
.card{background:#fff;border-radius:12px;padding:16px;box-shadow:0 1px 4px rgba(0,0,0,.06);}
</style>
</head>
<body>
<!-- MOBILE TOP BAR -->
<div id="mobile-topbar">
  <div class="flex items-center gap-2">
    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><rect width="12" height="12" rx="2" fill="#2C1810"/><rect x="16" width="12" height="12" rx="2" fill="#C8965A"/><rect y="16" width="12" height="12" rx="2" fill="#C8965A"/><rect x="16" y="16" width="12" height="12" rx="2" fill="#2C1810"/></svg>
    <span class="serif text-[15px] font-bold text-[#2C1810]">{{ optional(auth()->user())->name ?? 'Sarang Burung' }} Admin</span>
  </div>
  <div class="flex items-center gap-3">
    <button class="relative w-8 h-8 flex items-center justify-center">
      <svg width="20" height="20" fill="none" stroke="#6B5B4E" stroke-width="1.7" viewBox="0 0 24 24"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/></svg>
    </button>
    <div class="w-8 h-8 rounded-full bg-[#2C1810] flex items-center justify-center text-white text-xs font-bold">
      {{ strtoupper(substr(optional(auth()->user())->name ?? 'A', 0, 1)) }}
    </div>
  </div>
</div>
<div class="flex min-h-screen">
<!-- DESKTOP SIDEBAR -->
<aside id="desktop-sidebar" class="hidden md:flex flex-col border-r border-[#E8DDD2]" style="width:220px;background:#F0E9E0;min-height:100vh;flex-shrink:0;">
  <div class="px-5 py-6 border-b border-[#E8DDD2]">
    <div class="flex items-center gap-2 mb-1">
      <svg width="24" height="24" viewBox="0 0 28 28" fill="none"><rect width="12" height="12" rx="2" fill="#2C1810"/><rect x="16" width="12" height="12" rx="2" fill="#C8965A"/><rect y="16" width="12" height="12" rx="2" fill="#C8965A"/><rect x="16" y="16" width="12" height="12" rx="2" fill="#2C1810"/></svg>
      <p class="serif text-[16px] font-bold text-[#2C1810]">Admin Panel</p>
    </div>
    <p class="text-[12px] text-[#A08070]">Halo, {{ optional(auth()->user())->name ?? 'Admin' }} 👋</p>
  </div>
  <nav class="flex-1 py-4">
    <a href="{{ route('admin.dashboard') }} " class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
      Dashboard
    </a>
    <a href="{{ route('admin.products.index') }} " class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
      <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
      Inventory
    </a>
    <a href="#" class="nav-item">
      <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      Orders
    </a>
    <a href="#" class="nav-item">
      <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
      Customers
    </a>
  </nav>
  <div class="py-4 border-t border-[#E8DDD2]">
    <div class="flex items-center gap-3 px-4 py-3 mx-2 rounded-xl bg-white/60">
      <div class="w-9 h-9 rounded-full bg-[#2C1810] flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
        {{ strtoupper(substr(optional(auth()->user())->name ?? 'A', 0, 1)) }}
      </div>
      <div class="min-w-0 flex-1">
        <p class="text-[12.5px] font-semibold text-[#2C1810] truncate">{{ optional(auth()->user())->name ?? 'Admin' }} </p>
        <form method="POST" action="{{ route('admin.logout') }}" >@csrf
        <button type="submit" class="text-[10px] text-[#C8965A] font-semibold uppercase tracking-wide bg-transparent border-none cursor-pointer p-0 hover:opacity-70">Logout</button>
        </form>
      </div>
    </div>
  </div>
</aside>
<!-- MAIN -->
<div class="flex-1 flex flex-col min-w-0" id="main-content">
  <header class="hidden md:flex items-center justify-between px-8 py-5 bg-[#FAF7F4] border-b border-[#EDE5DC]">
    <h1 class="serif text-[22px] font-semibold text-[#2C1810]">@yield('header','Dashboard')</h1>
    <div class="flex items-center gap-3">@yield('topbar-actions')</div>
  </header>
  <main class="flex-1 p-4 md:p-8">
    <div class="md:hidden mb-4">
      <h1 class="serif text-xl font-semibold text-[#2C1810]">@yield('header','Dashboard')</h1>
    </div>
@if(session("success"))
    <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-4">
      <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
      {{ session("success") }}
    </div>
@endif
@yield('content')
  </main>
</div>
</div>
<!-- MOBILE BOTTOM NAV -->
<nav id="bottom-nav">
  <a href="{{ route('admin.dashboard') }} " class="bnav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    Dashboard
  </a>
  <a href="{{ route('admin.products.index') }} " class="bnav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
    Inventory
  </a>
  <a href="#" class="bnav-item">
    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    Orders
  </a>
  <a href="#" class="bnav-item">
    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Customers
  </a>
  <a href="#" class="bnav-item">
    <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
    Settings
  </a>
</nav>
</body></html>