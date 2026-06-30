<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Admin') &mdash; Sarang Burung</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * { font-family: "Inter", sans-serif; }
    .serif { font-family: "Playfair Display", serif; }
    body { background: #FAF7F4; }
    .nav-item { display:flex; align-items:center; gap:10px; padding:10px 16px; border-radius:8px; font-size:13.5px; color:#6B5B4E; cursor:pointer; text-decoration:none; transition:all .15s; margin:1px 8px; }
    .nav-item:hover { background:#E8DDD2; color:#3D2B1F; }
    .nav-item.active { background:#E8DDD2; color:#3D2B1F; border-left:3px solid #8B6914; padding-left:13px; font-weight:500; }
    .nav-item svg { width:16px; height:16px; opacity:.7; flex-shrink:0; }
    .nav-item.active svg { opacity:1; }

    /* Sidebar overlay mobile */
    #sidebar-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); z-index:40; }
    #sidebar-overlay.open { display:block; }
    #sidebar { transform: translateX(-100%); transition: transform .25s ease; }
    #sidebar.open { transform: translateX(0); }

    @media(min-width:768px) {
      #sidebar { transform: translateX(0) !important; position:relative !important; }
      #mobile-topbar { display:none !important; }
      #sidebar-overlay { display:none !important; }
    }
  </style>
</head>
<body>

<!-- MOBILE TOPBAR -->
<div id="mobile-topbar" class="md:hidden flex items-center justify-between px-4 py-3 bg-[#F0E9E0] border-b border-[#E8DDD2] sticky top-0 z-30">
  <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-[#E8DDD2] transition">
    <svg width="20" height="20" fill="none" stroke="#3D2B1F" stroke-width="2" viewBox="0 0 24 24">
      <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
  </button>
  <p class="serif font-bold text-[#2C1810] text-base tracking-wide">Sarang Burung</p>
  <div class="w-8 h-8 rounded-full bg-[#6B5B4E] flex items-center justify-center text-white text-xs font-semibold">
     strtoupper(substr(session('admin_name','A'),0,1)) 
  </div>
</div>

<!-- SIDEBAR OVERLAY (mobile) -->
<div id="sidebar-overlay" onclick="toggleSidebar()"></div>

<div class="flex min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar" class="fixed md:relative top-0 left-0 z-50 md:z-auto h-full md:h-auto flex flex-col border-r border-[#E8DDD2]" style="width:220px; background:#F0E9E0; min-height:100vh; flex-shrink:0;">

    <!-- Brand (desktop) -->
    <div class="hidden md:block px-5 py-6 border-b border-[#E8DDD2]">
      <p class="serif text-[17px] font-bold text-[#2C1810] leading-snug">
        Halo,  session('admin_name','Admin') 
      </p>
    </div>

    <!-- Close btn (mobile) -->
    <div class="md:hidden flex items-center justify-between px-5 py-4 border-b border-[#E8DDD2]">
      <p class="serif text-[15px] font-bold text-[#2C1810]">Menu</p>
      <button onclick="toggleSidebar()" class="p-1 rounded hover:bg-[#E8DDD2]">
        <svg width="18" height="18" fill="none" stroke="#3D2B1F" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <!-- Nav -->
    <nav class="flex-1 py-4">
      <a href=" route('admin.dashboard') " onclick="closeSidebar()"
         class="nav-item  request()->routeIs('admin.dashboard') ? 'active' : '' ">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href=" route('admin.products.index') " onclick="closeSidebar()"
         class="nav-item  request()->routeIs('admin.products*') ? 'active' : '' ">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
        Inventory
      </a>
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Orders
      </a>
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m7-5a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0zM3 17a3 3 0 110-6 3 3 0 010 6z"/></svg>
        Customers
      </a>
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Analytics
      </a>
    </nav>

    <!-- Bottom -->
    <div class="py-4 border-t border-[#E8DDD2]">
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
        Settings
      </a>
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"/></svg>
        Support
      </a>
      <!-- Admin Profile -->
      <div class="flex items-center gap-3 px-4 py-3 mx-2 rounded-lg">
        <div class="w-8 h-8 rounded-full bg-[#6B5B4E] flex items-center justify-center text-white text-xs font-semibold flex-shrink-0">
           strtoupper(substr(session('admin_name','A'),0,1)) 
        </div>
        <div class="min-w-0">
          <p class="text-[12.5px] font-medium text-[#2C1810] truncate"> session('admin_name','Admin') </p>
          <form method="POST" action=" route('admin.logout') ">
            @csrf
            <button class="text-[10px] text-[#A08070] uppercase tracking-wide bg-transparent border-none cursor-pointer p-0 hover:text-[#3D2B1F] transition">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="flex-1 flex flex-col min-w-0">

    <!-- Topbar (desktop only) -->
    <header class="hidden md:flex items-center justify-between px-8 py-5 bg-[#FAF7F4] border-b border-[#EDE5DC]">
      <h1 class="serif text-[22px] font-semibold text-[#2C1810]">@yield('header','Dashboard')</h1>
      <div class="flex items-center gap-3">
        @yield('topbar-actions')
      </div>
    </header>

    <!-- Mobile page title -->
    <div class="md:hidden px-4 py-3 border-b border-[#EDE5DC]">
      <h1 class="serif text-lg font-semibold text-[#2C1810]">@yield('header','Dashboard')</h1>
    </div>

    <!-- Content -->
    <main class="flex-1 p-4 md:p-8">
      @if(session('success'))
        <div class="flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg mb-5">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
           session('success') 
        </div>
      @endif
      @yield('content')
    </main>
  </div>

</div>

<script>
function toggleSidebar() {
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('sidebar-overlay').classList.toggle('open');
}
function closeSidebar() {
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('sidebar-overlay').classList.remove('open');
}
</script>

</body>
</html>
