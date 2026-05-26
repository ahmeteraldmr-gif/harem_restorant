<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Harem Restaurant</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22 fill=%22%23C9A96E%22 font-weight=%22bold%22 font-family=%22serif%22>H</text></svg>">
    <link rel="stylesheet" href="{{ asset('css/harem.css') }}?v={{ time() }}">
</head>
<body style="background:#F1F5F9;">

<div class="admin-layout">
    {{-- Sidebar --}}
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <span class="admin-logo">Harem</span>
            <span class="admin-logo-sub">Yönetim Paneli</span>
        </div>

        <nav class="admin-nav" style="display:flex; flex-direction:column; padding: 1rem 0.75rem; gap: 0.25rem;">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="admin-nav-icon">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.menu.items') }}" class="admin-nav-link {{ request()->routeIs('admin.menu.items') ? 'active' : '' }}">
                <span class="admin-nav-icon">🍽️</span> Menü Ürünleri
            </a>
            <a href="{{ route('admin.menu.categories') }}" class="admin-nav-link {{ request()->routeIs('admin.menu.categories') ? 'active' : '' }}">
                <span class="admin-nav-icon">📂</span> Kategoriler
            </a>
            <a href="{{ route('admin.reservations') }}" class="admin-nav-link {{ request()->routeIs('admin.reservations') ? 'active' : '' }}">
                <span class="admin-nav-icon">🗓️</span> Rezervasyonlar
            </a>
            <a href="{{ route('admin.messages') }}" class="admin-nav-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                <span class="admin-nav-icon">✉️</span> Mesajlar
            </a>
            <a href="{{ route('admin.gallery') }}" class="admin-nav-link {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                <span class="admin-nav-icon">🖼️</span> Galeri
            </a>

            <div style="margin-top:auto; padding: 1rem 0.5rem 0; border-top: 1px solid rgba(255,255,255,0.08);">
                <a href="{{ route('home') }}" class="admin-nav-link" target="_blank" style="margin-bottom:0.5rem;">
                    <span class="admin-nav-icon">🌐</span> Siteyi Görüntüle
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="admin-nav-link" style="width:100%; text-align:left; background:transparent; border:none; color:rgba(255,255,255,0.45); cursor:pointer;">
                        <span class="admin-nav-icon">🚪</span> Çıkış Yap
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <button id="adminSidebarToggle" style="display:none; background:var(--gold); color:var(--navy-deep); border:none; font-size:1.2rem; cursor:pointer; padding:0.4rem 0.8rem; border-radius:6px; font-weight:bold; box-shadow:var(--shadow-sm);">☰ Menü</button>
                <h1 class="admin-page-title">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div style="display:flex; align-items:center; gap:1rem;">
                <span style="font-size:0.875rem; color:#64748B;">👤 {{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error" style="display:block; margin-bottom:1.5rem;">
                    <strong style="display:block; margin-bottom:0.25rem;">⚠️ Lütfen aşağıdaki hataları düzeltin:</strong>
                    <ul style="margin:0; padding-left:1.25rem; font-size:0.85rem; list-style-type:disc;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    #adminSidebarToggle {
        display: block !important;
    }
    .admin-sidebar {
        transition: transform 0.3s ease-in-out;
        box-shadow: 4px 0 15px rgba(0,0,0,0.15);
    }
    .admin-sidebar.open {
        transform: translateX(0) !important;
    }
}
</style>

<script>
document.getElementById('adminSidebarToggle')?.addEventListener('click', function(e) {
    e.stopPropagation();
    document.querySelector('.admin-sidebar')?.classList.toggle('open');
});

document.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.admin-sidebar');
    const toggleBtn = document.getElementById('adminSidebarToggle');
    if (sidebar && sidebar.classList.contains('open') && !sidebar.contains(event.target) && event.target !== toggleBtn) {
        sidebar.classList.remove('open');
    }
});
</script>
</body>
</html>
