<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','Admin') &mdash; Sarang Burung</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    *{font-family:"Inter",sans-serif;}
    .serif{font-family:"Playfair Display",serif;}
    body{background:#FAF7F4;}
    .sidebar{background:#F0E9E0; min-height:100vh; width:200px; display:flex; flex-direction:column; border-right:1px solid #E8DDD2;}
    .nav-item{display:flex; align-items:center; gap:10px; padding:10px 16px; border-radius:8px; font-size:13.5px; color:#6B5B4E; cursor:pointer; text-decoration:none; transition:all .15s; margin:1px 8px;}
    .nav-item:hover{background:#E8DDD2; color:#3D2B1F;}
    .nav-item.active{background:#E8DDD2; color:#3D2B1F; border-left:3px solid #8B6914; padding-left:13px; font-weight:500;}
    .nav-item svg{width:16px;height:16px;opacity:.7;flex-shrink:0;}
    .nav-item.active svg{opacity:1;}
    .badge-new{background:#D4A843; color:#fff; font-size:10px; font-weight:600; padding:2px 8px; border-radius:20px; letter-spacing:.05em;}
    .badge-limited{background:#E8E0D8; color:#6B5B4E; font-size:10px; font-weight:600; padding:2px 8px; border-radius:20px; letter-spacing:.05em;}
  </style>
</head>
<body>
<div style="display:flex;min-height:100vh;">

  <!-- SIDEBAR -->
  <aside class="sidebar" style="width:200px;flex-shrink:0;">
    <!-- Brand -->
    <div style="padding:24px 20px 20px;border-bottom:1px solid #E8DDD2;">
    <p class="serif" style="font-size:17px;font-weight:700;color:#2C1810;line-height:1.2;">Halo, {{ session('admin_name', 'Admin') }}
</p>
    </p>
    </div>

    <!-- Nav -->
    <nav style="flex:1;padding:16px 0;">
      <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
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
    <div style="padding:16px 0;border-top:1px solid #E8DDD2;">
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3"/></svg>
        Settings
      </a>
      <a href="#" class="nav-item">
        <svg fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3M12 17h.01"/></svg>
        Support
      </a>
      <!-- Admin Profile -->
      <div style="display:flex;align-items:center;gap:10px;padding:10px 16px;margin:1px 8px;">
        <div style="width:34px;height:34px;border-radius:50%;background:#6B5B4E;display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:600;flex-shrink:0;">
          {{ strtoupper(substr(session('admin_name','A'),0,1)) }}
        </div>
        <div style="min-width:0;">
          <p style="font-size:12.5px;font-weight:500;color:#2C1810;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ session('admin_name','Admin') }}</p>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button style="font-size:10px;color:#A08070;letter-spacing:.03em;text-transform:uppercase;background:none;border:none;cursor:pointer;padding:0;">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div style="flex:1;display:flex;flex-direction:column;min-width:0;">
    <!-- Topbar -->
    <header style="background:#FAF7F4;padding:20px 32px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #EDE5DC;">
      <h1 class="serif" style="font-size:22px;font-weight:600;color:#2C1810;">@yield('header','Dashboard')</h1>
      <div style="display:flex;align-items:center;gap:12px;">
        @yield('topbar-actions')
        <button style="width:36px;height:36px;border-radius:50%;background:#F0E9E0;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;">
          <svg width="16" height="16" fill="none" stroke="#6B5B4E" stroke-width="1.7" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>
        <button style="width:36px;height:36px;border-radius:50%;background:#F0E9E0;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;">
          <svg width="16" height="16" fill="none" stroke="#6B5B4E" stroke-width="1.7" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </button>
      </div>
    </header>

    <!-- Content -->
    <main style="flex:1;padding:28px 32px;">
      @if(session('success'))
        <div style="display:flex;align-items:center;gap:8px;background:#F0FAF0;border:1px solid #86EFAC;color:#166534;font-size:13px;padding:10px 16px;border-radius:8px;margin-bottom:20px;">
          <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @yield('content')
    </main>
  </div>
</div>
</body>
</html>
