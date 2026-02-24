<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Home Page | Rapid Ink Admin</title>
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
        body { background-color: var(--bg-light); font-family: 'Inter', system-ui, sans-serif; color: #111827; }
        .sidebar { width: var(--sidebar-width-collapsed); background-color: #ffffff; border-right: 1px solid var(--border-color); position: fixed; top: 0; left: 0; height: 100vh; z-index: 1000; display: flex; flex-direction: column; transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease; overflow-x: hidden; white-space: nowrap; }
        .sidebar:hover { width: var(--sidebar-width-expanded); box-shadow: 4px 0 24px rgba(0,0,0,0.08); }
        .sidebar-brand { height: var(--topbar-height); display: flex; align-items: center; justify-content: flex-start; padding-left: 12px; border-bottom: 1px solid var(--border-color); text-decoration: none; transition: padding-left 0.3s ease; overflow: hidden; }
        .sidebar:hover .sidebar-brand { padding-left: 24px; }
        .sidebar-brand img { width: 55px; height: auto; max-height: 40px; object-fit: contain; object-position: left center; transition: width 0.3s ease; }
        .sidebar:hover .sidebar-brand img { width: 180px; }
        .nav-item-link { display: flex; align-items: center; padding: 12px 0; color: #4b5563; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s; min-width: var(--sidebar-width-expanded); border-right: 3px solid transparent; }
        .nav-item-link:hover, .nav-item-link.active { background-color: #f9fafb; color: var(--brand-color); border-right-color: var(--brand-color); }
        .nav-icon-wrap { width: var(--sidebar-width-collapsed); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .nav-text { opacity: 0; visibility: hidden; transform: translateX(-10px); transition: all 0.2s ease; }
        .sidebar:hover .nav-text { opacity: 1; visibility: visible; transform: translateX(0); transition-delay: 0.1s; }
        .sidebar-bottom { min-width: var(--sidebar-width-expanded); }
        .main-content { margin-left: var(--sidebar-width-collapsed); min-height: 100vh; display: flex; flex-direction: column; transition: margin-left 0.3s ease; }
        .sidebar:hover ~ .main-content { margin-left: var(--sidebar-width-expanded); }
        .topbar { height: var(--topbar-height); background-color: #ffffff; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 999; }
        .content-pad { padding: 32px; flex-grow: 1; }
        .form-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px; }
        .form-card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .btn-brand { background-color: var(--brand-color); color: #ffffff; font-weight: 600; border-radius: 6px; padding: 8px 16px; border: none; }
        .btn-brand:hover { background-color: #333333; color: #ffffff; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="/" class="sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
        </a>
        <div class="py-4 d-flex flex-column gap-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:layout-dashboard" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.settings.homepage') }}" class="nav-item-link active">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:home" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Home Page Editor</span>
            </a>
            <a href="{{ route('admin.products.create') }}" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-bag" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Products</span>
            </a>
            <a href="#" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:shopping-cart" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Orders</span>
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
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <h5 class="mb-0 fw-bold text-muted d-none d-sm-block">Storefront Editor</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold" style="font-size: 14px;">{{ auth()->user()->name ?? 'Admin User' }}</div>
                    <div class="text-muted text-uppercase" style="font-size: 11px; font-weight: 700;">Store Manager</div>
                </div>
            </div>
        </header>

        <div class="content-pad">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Home Page Content</h4>
                <button type="submit" form="homepageForm" class="btn btn-brand d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:save"></iconify-icon> Save Changes
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form id="homepageForm" action="{{ route('admin.settings.homepage.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-12 col-lg-8">
                        
                        <!-- Hero Carousel Settings -->
                        <div class="form-card">
                            <div class="form-card-title">
                                <span><iconify-icon icon="lucide:images" class="me-2"></iconify-icon> Hero Carousel Setup</span>
                                <span class="badge bg-dark">3 Slides</span>
                            </div>

                            <!-- Slide 1 -->
                            <div class="border rounded p-3 mb-4 bg-light">
                                <h6 class="fw-bold mb-3">Slide 1 (Primary)</h6>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                                    <input type="text" name="slide1_headline" class="form-control" value="{{ $settings['slide1_headline'] ?? 'Premium Threads for the Bold' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                                    <input type="text" name="slide1_subtext" class="form-control" value="{{ $settings['slide1_subtext'] ?? 'Discover the latest collection of high-quality tees.' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                                    @if(isset($settings['slide1_image']))
                                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide1_image']) }}" height="60" class="rounded"></div>
                                    @endif
                                    <input type="file" name="slide1_image" class="form-control bg-white" accept="image/*">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                        <input type="text" name="slide1_btn_text" class="form-control" value="{{ $settings['slide1_btn_text'] ?? 'Shop The Collection' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                        <input type="text" name="slide1_btn_link" class="form-control" value="{{ $settings['slide1_btn_link'] ?? '#trending' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="border rounded p-3 mb-4 bg-light">
                                <h6 class="fw-bold mb-3">Slide 2</h6>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                                    <input type="text" name="slide2_headline" class="form-control" value="{{ $settings['slide2_headline'] ?? 'Summer Essentials' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                                    <input type="text" name="slide2_subtext" class="form-control" value="{{ $settings['slide2_subtext'] ?? 'Stay cool with our breathable fabrics.' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                                    @if(isset($settings['slide2_image']))
                                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide2_image']) }}" height="60" class="rounded"></div>
                                    @endif
                                    <input type="file" name="slide2_image" class="form-control bg-white" accept="image/*">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                        <input type="text" name="slide2_btn_text" class="form-control" value="{{ $settings['slide2_btn_text'] ?? 'Explore Now' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                        <input type="text" name="slide2_btn_link" class="form-control" value="{{ $settings['slide2_btn_link'] ?? '#trending' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="border rounded p-3 bg-light">
                                <h6 class="fw-bold mb-3">Slide 3</h6>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                                    <input type="text" name="slide3_headline" class="form-control" value="{{ $settings['slide3_headline'] ?? 'Limited Edition Drops' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                                    <input type="text" name="slide3_subtext" class="form-control" value="{{ $settings['slide3_subtext'] ?? 'Once they\'re gone, they\'re gone forever.' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                                    @if(isset($settings['slide3_image']))
                                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide3_image']) }}" height="60" class="rounded"></div>
                                    @endif
                                    <input type="file" name="slide3_image" class="form-control bg-white" accept="image/*">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                        <input type="text" name="slide3_btn_text" class="form-control" value="{{ $settings['slide3_btn_text'] ?? 'Shop Limited' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                        <input type="text" name="slide3_btn_link" class="form-control" value="{{ $settings['slide3_btn_link'] ?? '#trending' }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-12 col-lg-4">
                        <div class="form-card">
                            <div class="form-card-title">Announcement Bar</div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Promo Text</label>
                                <input type="text" name="promo_text" class="form-control" value="{{ $settings['promo_text'] ?? '🔥 FREE Worldwide Shipping on Orders Over $75!' }}">
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>