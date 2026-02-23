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
            <a href="{{ route('admin.dashboard') }}" class="nav-item-link active">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:layout-dashboard" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ url('/admin/products') }}" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-bag" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Add Products</span>
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
                <h5 class="mb-0 fw-bold text-muted d-none d-sm-block">Dashboard</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <!-- Dynamically pull the logged in Admin's name -->
                    <div class="fw-bold" style="font-size: 14px;">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.05em; font-weight: 700;">
                        {{ auth()->user()->role ?? 'Store Manager' }}
                    </div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color);">
                    <iconify-icon icon="lucide:user" style="font-size: 20px;"></iconify-icon>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-pad">
            <!-- Success Message Notification -->
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:check-circle-2" style="font-size: 20px;"></iconify-icon>
                    {{ session('success') }}
                </div>
            @endif

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
                            <div class="stat-value">{{ $products->count() ?? 124 }}</div>
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
                <a href="{{ route('admin.products.create') }}" class="btn btn-brand d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:plus"></iconify-icon> Add New Product
                </a>
            </div>

            <div class="table-card">
                <table class="table mb-0 table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Date Added</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                                        @else
                                            <div class="product-img d-flex align-items-center justify-content-center text-muted">
                                                <iconify-icon icon="lucide:image"></iconify-icon>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                                            <div class="text-muted small">ID: #PRD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                                <td class="fw-bold">${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->is_trending)
                                        <span class="badge-trending">Trending</span>
                                    @else
                                        <span class="badge bg-light text-dark border">Standard</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light border me-1"><iconify-icon icon="lucide:edit-2"></iconify-icon></a>
                                    
                                    <!-- FIX IS HERE: The action attribute properly sends DELETE request to the destroy route! -->
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <iconify-icon icon="lucide:trash-2"></iconify-icon>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <iconify-icon icon="lucide:package-open" style="font-size: 32px; margin-bottom: 10px;"></iconify-icon>
                                    <p class="mb-0">No products found. Start by adding your first product!</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>