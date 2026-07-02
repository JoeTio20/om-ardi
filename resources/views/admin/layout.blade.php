<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<title>@yield('title','Admin')</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
* { box-sizing:border-box; -webkit-tap-highlight-color:transparent; }
body { background:#EEF2F7; font-family:"Inter",system-ui,sans-serif; margin:0; color:#0D1F3C; }
@import url("https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap");
.serif { font-family:"Playfair Display",Georgia,serif; }
.card { background:#fff; border-radius:16px; padding:20px; box-shadow:0 1px 3px rgba(0,0,0,.06); }
.bnav-item { flex:1; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:8px 4px 10px; gap:3px; text-decoration:none; color:#94A3B8; font-size:9px; font-weight:600; letter-spacing:.08em; text-transform:uppercase; transition:color .15s; }
.bnav-item.active, .bnav-item:hover { color:#0D1F3C; }
.bnav-item svg { width:20px; height:20px; }
</style>
@yield('head')
</head>
<body>

<!-- TOP BAR -->
<div class="flex items-center justify-between px-5 py-4 bg-white sticky top-0 z-40 border-b border-gray-100">
  <div class="flex items-center gap-2">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0D1F3C" stroke-width="1.5"><path d="M2 20s3-3 7-3 7 3 12 3"/><circle cx="12" cy="7" r="3"/><path d="M12 10v7"/><path d="M9 20a4 4 0 01-4-4"/><path d="M15 20a4 4 0 004-4"/></svg>
    <span class="serif text-[16px] font-bold text-[#0D1F3C]">Sarang Burung</span>
  </div>
  <div class="flex items-center gap-3">
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 hover:text-red-500 transition px-3 py-2 rounded-lg hover:bg-red-50">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
        Logout
      </button>
    </form>
    <div class="w-8 h-8 rounded-full bg-[#0D1F3C] flex items-center justify-center text-white text-xs font-bold">
      {{ strtoupper(substr(optional(auth()->user())->name??'A',0,1)) }}
    </div>
  </div>
</div>

<!-- MAIN CONTENT -->
<main class="pb-20">
@yield('content')
</main>

<!-- BOTTOM NAV -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 flex z-40" style="padding-bottom:env(safe-area-inset-bottom)">
  <a href="{{ route('admin.dashboard') }}" class="bnav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    HOME
  </a>
  <a href="{{ route('admin.orders.index') }}" class="bnav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    ORDERS
  </a>
  <a href="{{ route('admin.products.index') }}" class="bnav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
    PRODUCT
  </a>
</nav>

<script>
function showToast(msg,type='success'){
  let t=document.getElementById('admin-toast');
  if(!t){t=document.createElement('div');t.id='admin-toast';t.style.cssText='position:fixed;top:4.5rem;right:1rem;padding:.6rem 1.1rem;border-radius:8px;font-size:.8rem;z-index:9999;display:none;font-weight:500';document.body.appendChild(t);}
  t.style.background=type==='success'?'#0D1F3C':'#dc2626';
  t.style.color='#fff'; t.textContent=msg; t.style.display='block';
  clearTimeout(window._at); window._at=setTimeout(()=>t.style.display='none',3000);
}
</script>
@yield('scripts')
</body>
</html>
