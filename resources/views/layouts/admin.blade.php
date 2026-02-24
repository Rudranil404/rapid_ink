<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width-collapsed);
            background-color: #ffffff;
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
            overflow-x: hidden;
            white-space: nowrap;
        }
        .sidebar:hover {
            width: var(--sidebar-width-expanded);
            box-shadow: 4px 0 24px rgba(0,0,0,0.08);
        }
        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 12px;
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .sidebar:hover .sidebar-brand {
            padding-left: 24px;
        }
        .sidebar-brand img {
            width: 55px;
            height: auto;
            max-height: 40px;
            object-fit: contain;
            object-position: left center;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar:hover .sidebar-brand img {
            width: 180px;
        }
        .nav-item-link {
            display: flex;
            align-items: center;
            padding: 12px 0;
            color: #4b5563;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            min-width: var(--sidebar-width-expanded);
            border-right: 3px solid transparent;
        }
        .nav-item-link:hover, .nav-item-link.active {
            background-color: #f9fafb;
            color: var(--brand-color);
            border-right-color: var(--brand-color);
        }
        .nav-icon-wrap {
            width: var(--sidebar-width-collapsed);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .nav-text {
            opacity: 0;
            visibility: hidden;
            transform: translateX(-10px);
            transition: all 0.2s ease;
        }
        .sidebar:hover .nav-text {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
            transition-delay: 0.1s;
        }
        .sidebar-bottom {
            min-width: var(--sidebar-width-expanded);
        }
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width-collapsed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar:hover ~ .main-content {
            margin-left: var(--sidebar-width-expanded);
        }
        .topbar {
            height: var(--topbar-height);
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .content-pad {
            padding: 32px;
            flex-grow: 1;
        }
        /* Custom UI Elements */
        .stat-card, .table-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .btn-brand { background-color: var(--brand-color); color: #ffffff; font-weight: 600; border-radius: 6px; padding: 8px 16px; }
        .btn-brand:hover { background-color: #333333; color: #ffffff; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="/" class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
        </a>
        <div class="py-4 d-flex flex-column gap-1">
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
        </div>
        
        <div class="sidebar-bottom mt-auto border-top py-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item-link w-100 bg-transparent text-danger text-start" style="border-top: none; border-left: none; border-bottom: none;">
                    <div class="nav-icon-wrap"><iconify-icon icon="lucide:log-out" style="font-size: 18px;"></iconify-icon></div>
                    <span class="nav-text">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0 fw-bold text-muted d-none d-sm-block">@yield('page_title', 'Admin Panel')</h5>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>