<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapid Ink - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconify for Icons -->
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
            justify-content: flex-start; /* Lock to flex-start to prevent snapping */
            padding-left: 12px; /* Centers the 55px logo inside the 80px collapsed width */ 
            border-bottom: 1px solid var(--border-color);
            text-decoration: none;
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        .sidebar:hover .sidebar-brand {
            padding-left: 24px; /* Restore padding smoothly on hover */
        }
        .sidebar-brand img {
            width: 55px; /* Shrink width to fit entire logo in collapsed sidebar */
            height: auto;
            max-height: 40px;
            object-fit: contain;
            object-position: left center; /* Anchor scaling to the left */
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar:hover .sidebar-brand img {
            width: 180px; /* Expand to original readable size */
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
        /* Shift main content when sidebar is hovered */
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
        /* Card Styles */
        .stat-card {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--brand-color);
        }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
        }
        .stat-label {
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        /* Table Styles */
        .table-card {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .table thead th {
            background-color: #f9fafb;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
        }
        .table tbody td {
            padding: 16px 24px;
            vertical-align: middle;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid var(--border-color);
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .product-img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            object-fit: cover;
            background-color: #f3f4f6;
        }
        .badge-trending {
            background-color: #fef08a; /* Yellow */
            color: #854d0e;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
        }
        .btn-brand {
            background-color: var(--brand-color);
            color: #ffffff;
            font-weight: 600;
            border-radius: 6px;
            padding: 8px 16px;
        }
        .btn-brand:hover {
            background-color: #333333;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="/" class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
        </a>
        <div class="py-4 d-flex flex-column gap-1">
            <a href="#" class="nav-item-link active">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:layout-dashboard" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="#" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-bag" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Products</span>
            </a>
            <a href="#" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-cart" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Orders</span>
            </a>
            <a href="#" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:users" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Customers</span>
            </a>
            <a href="#" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:settings" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Settings</span>
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navigation -->
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <!-- Logo in the horizontal Nav-bar (Clickable) -->
                <!-- <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo" style="max-height: 45px; width: auto; object-fit: contain;">
                </a> -->
                <h5 class="mb-0 fw-bold  text-muted d-none d-sm-block">Dashboard</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold" style="font-size: 14px;">Admin User</div>
                    <div class="text-muted" style="font-size: 12px;">Store Manager</div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color);">
                    <iconify-icon icon="lucide:user" style="font-size: 20px;"></iconify-icon>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-pad">
            <!-- Stats Row -->
            <div class="row g-4 mb-5">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><iconify-icon icon="lucide:dollar-sign"></iconify-icon></div>
                        <div>
                            <div class="stat-label">Total Revenue</div>
                            <div class="stat-value">$12,450</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><iconify-icon icon="lucide:shopping-cart"></iconify-icon></div>
                        <div>
                            <div class="stat-label">Active Orders</div>
                            <div class="stat-value">84</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><iconify-icon icon="lucide:shirt"></iconify-icon></div>
                        <div>
                            <div class="stat-label">Total Products</div>
                            <div class="stat-value">124</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-icon"><iconify-icon icon="lucide:users"></iconify-icon></div>
                        <div>
                            <div class="stat-label">New Customers</div>
                            <div class="stat-value">32</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Recent Products</h5>
                <!-- Example Add Product button targeting a modal or new route -->
                <a href="#" class="btn btn-brand d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:plus"></iconify-icon> Add New Product
                </a>
            </div>

            <div class="table-card">
                <table class="table mb-0 table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Static Data (Replace with your Laravel $products loop) -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-img"></div> <!-- Placeholder for actual image -->
                                    <div>
                                        <div class="fw-bold text-dark">Thunder Glyph Tee</div>
                                        <div class="text-muted small">ID: #PRD-001</div>
                                    </div>
                                </div>
                            </td>
                            <td>Oversized</td>
                            <td class="fw-bold">$45.00</td>
                            <td><span class="badge-trending">Trending</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-light border me-1"><iconify-icon icon="lucide:edit-2"></iconify-icon></button>
                                <button class="btn btn-sm btn-light border text-danger"><iconify-icon icon="lucide:trash-2"></iconify-icon></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-img"></div>
                                    <div>
                                        <div class="fw-bold text-dark">Voltage Leap Tee</div>
                                        <div class="text-muted small">ID: #PRD-002</div>
                                    </div>
                                </div>
                            </td>
                            <td>Graphic Packs</td>
                            <td class="fw-bold">$52.00</td>
                            <td><span class="badge bg-light text-dark border">Standard</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-light border me-1"><iconify-icon icon="lucide:edit-2"></iconify-icon></button>
                                <button class="btn btn-sm btn-light border text-danger"><iconify-icon icon="lucide:trash-2"></iconify-icon></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-img"></div>
                                    <div>
                                        <div class="fw-bold text-dark">Brush Chaos Tee</div>
                                        <div class="text-muted small">ID: #PRD-003</div>
                                    </div>
                                </div>
                            </td>
                            <td>All Tees</td>
                            <td class="fw-bold">$40.00</td>
                            <td><span class="badge bg-light text-dark border">Standard</span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-light border me-1"><iconify-icon icon="lucide:edit-2"></iconify-icon></button>
                                <button class="btn btn-sm btn-light border text-danger"><iconify-icon icon="lucide:trash-2"></iconify-icon></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>

    <!-- Bootstrap JS (Optional if you need modals/dropdowns later) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>