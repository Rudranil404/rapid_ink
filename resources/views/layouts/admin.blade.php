<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Rapid Ink - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <style>
        :root {
            --sidebar-width-collapsed: 80px;
            --sidebar-width-expanded: 260px;
            --topbar-height: 70px;
            --brand-color: #000000;
            --bg-light: #f3f4f6;
            --border-color: #e5e7eb;
        }
        body {
            background-color: var(--bg-light);
            font-family: 'Inter', system-ui, sans-serif;
            color: #111827;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles (Desktop) */
        .sidebar {
            width: var(--sidebar-width-collapsed);
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100dvh; /* Dynamic viewport height fixes mobile cropping */
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-x: hidden;
            overflow-y: auto; /* Allow scrolling if screen is too small */
            white-space: nowrap;
        }
        .sidebar:hover { width: var(--sidebar-width-expanded); box-shadow: 4px 0 24px rgba(0,0,0,0.08); }
        .sidebar-brand { height: var(--topbar-height); min-height: var(--topbar-height); display: flex; align-items: center; padding-left: 12px; border-bottom: 1px solid var(--border-color); text-decoration: none; transition: padding-left 0.3s; overflow: hidden; flex-shrink: 0; }
        .sidebar:hover .sidebar-brand { padding-left: 24px; }
        .sidebar-brand img { width: 55px; max-height: 40px; object-fit: contain; object-position: left center; transition: width 0.3s; }
        .sidebar:hover .sidebar-brand img { width: 180px; }
        .nav-item-link { display: flex; align-items: center; padding: 12px 0; color: #4b5563; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s; min-width: var(--sidebar-width-expanded); border-right: 3px solid transparent; cursor: pointer; }
        .nav-item-link:hover, .nav-item-link.active { background-color: #f9fafb; color: var(--brand-color); border-right-color: var(--brand-color); }
        .nav-icon-wrap { width: var(--sidebar-width-collapsed); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .nav-text { opacity: 0; visibility: hidden; transform: translateX(-10px); transition: all 0.2s ease; }
        .sidebar:hover .nav-text { opacity: 1; visibility: visible; transform: translateX(0); transition-delay: 0.1s; }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width-collapsed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        
        .topbar { height: var(--topbar-height); background-color: #ffffff; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 1020; }
        .content-pad { padding: 32px; flex-grow: 1; }
        
        /* UI Elements */
        .btn-brand { background-color: var(--brand-color); color: #ffffff; font-weight: 600; border-radius: 6px; padding: 8px 16px; border: none; transition: 0.2s; }
        .btn-brand:hover { background-color: #333333; color: #ffffff; }

        /* --- MOBILE APP UI STYLES --- */
        .mobile-menu-toggle { display: none; background: none; border: none; font-size: 24px; color: #111827; padding: 0; cursor: pointer; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1030; backdrop-filter: blur(2px); opacity: 0; transition: opacity 0.3s; }
        .sidebar-overlay.show { display: block; opacity: 1; }
        
        /* Admin Bottom Nav (Mobile Only) */
        .admin-bottom-nav { display: none; position: fixed; bottom: 0; left: 0; width: 100%; background-color: #ffffff; border-top: 1px solid var(--border-color); z-index: 1020; padding-bottom: env(safe-area-inset-bottom); box-shadow: 0 -4px 12px rgba(0,0,0,0.05); }
        .admin-bottom-nav-inner { display: flex; justify-content: space-around; align-items: center; height: 64px; }
        .admin-nav-item { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; color: #9ca3af; text-decoration: none; width: 100%; height: 100%; transition: color 0.2s; background: none; border: none; padding: 0; cursor: pointer; }
        .admin-nav-item.active { color: var(--brand-color); }
        .admin-nav-item span { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; }
        .admin-nav-icon { font-size: 22px; }

        @media (max-width: 768px) {
            .mobile-menu-toggle { display: block; }
            .topbar { padding: 0 16px; }
            .content-pad { padding: 16px; }
            
            /* Enable Bottom Nav & Add Padding to body */
            .admin-bottom-nav { display: block; }
            body { padding-bottom: calc(64px + env(safe-area-inset-bottom)); }
            
            /* Turn sidebar into off-canvas drawer */
            .sidebar { transform: translateX(-100%); width: 260px !important; }
            .sidebar.show { transform: translateX(0); box-shadow: 4px 0 24px rgba(0,0,0,0.15); }
            
            /* Lock sidebar expanded state on mobile */
            .sidebar .nav-text { opacity: 1; visibility: visible; transform: translateX(0); }
            .sidebar .sidebar-brand { padding-left: 24px; }
            .sidebar .sidebar-brand img { width: 180px; }
            .sidebar .nav-icon-wrap { width: 60px; justify-content: flex-start; padding-left: 24px; }
            
            .main-content { margin-left: 0 !important; }
            .sidebar:hover ~ .main-content { margin-left: 0 !important; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar" id="adminSidebar">
        <div class="d-flex justify-content-between align-items-center w-100 pe-3 flex-shrink-0">
            <a href="/" class="sidebar-brand flex-grow-1">
                <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
            </a>
            <button class="d-md-none btn btn-sm border-0 text-muted p-0" id="closeSidebarBtn">
                <iconify-icon icon="lucide:x" style="font-size: 24px;"></iconify-icon>
            </button>
        </div>
        
        <div class="py-4 d-flex flex-column gap-1 flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:layout-dashboard" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.settings.homepage') }}" class="nav-item-link {{ request()->routeIs('admin.settings.homepage') ? 'active' : '' }}">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:home" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Home Page Editor</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="nav-item-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-bag" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Products</span>
            </a>
            
            <a href="/" class="nav-item-link mt-2 border-top pt-3">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:external-link" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">View Storefront</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="nav-item-link w-100 bg-transparent text-danger text-start border-0">
                    <div class="nav-icon-wrap"><iconify-icon icon="lucide:log-out" style="font-size: 18px; color: #dc3545;"></iconify-icon></div>
                    <span class="nav-text fw-bold text-danger">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-menu-toggle" id="openSidebarBtnTop">
                    <iconify-icon icon="lucide:menu"></iconify-icon>
                </button>
                <h5 class="mb-0 fw-bold text-dark d-none d-sm-block" style="font-size: 18px;">@yield('page_title', 'Admin Panel')</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold" style="font-size: 14px;">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.05em; font-weight: 700;">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color);">
                    <iconify-icon icon="lucide:user" style="font-size: 20px;"></iconify-icon>
                </div>
            </div>
        </header>

        <div class="content-pad">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:check-circle-2" style="font-size: 20px;"></iconify-icon>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <nav class="admin-bottom-nav">
        <div class="admin-bottom-nav-inner">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <iconify-icon icon="lucide:layout-dashboard" class="admin-nav-icon"></iconify-icon>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.products.index') }}" class="admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <iconify-icon icon="lucide:shopping-bag" class="admin-nav-icon"></iconify-icon>
                <span>Products</span>
            </a>
            
            <a href="{{ route('admin.settings.homepage') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.homepage') ? 'active' : '' }}">
                <iconify-icon icon="lucide:home" class="admin-nav-icon"></iconify-icon>
                <span>Storefront</span>
            </a>
            
            <button class="admin-nav-item" id="openSidebarBtnBottom">
                <iconify-icon icon="lucide:menu" class="admin-nav-icon"></iconify-icon>
                <span>Menu</span>
            </button>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtnTop = document.getElementById('openSidebarBtnTop');
            const openBtnBottom = document.getElementById('openSidebarBtnBottom');
            const closeBtn = document.getElementById('closeSidebarBtn');

            function openSidebar() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
                document.body.style.overflow = 'hidden'; 
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = '';
            }

            if(openBtnTop) openBtnTop.addEventListener('click', openSidebar);
            if(openBtnBottom) openBtnBottom.addEventListener('click', openSidebar);
            if(closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if(overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>