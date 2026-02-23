<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product | Rapid Ink Admin</title>
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
        
        /* Form & Card Styles specific to Create Product */
        .form-card {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            margin-bottom: 24px;
        }
        .form-card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .form-control, .form-select {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            padding: 12px 16px;
            font-size: 14px;
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: var(--brand-color);
            box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
        }
        /* Drag & Drop Upload Zone */
        .upload-zone {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            background-color: #f9fafb;
            cursor: pointer;
            transition: all 0.2s;
        }
        .upload-zone:hover {
            border-color: var(--brand-color);
            background-color: #f3f4f6;
        }
        .upload-icon {
            font-size: 40px;
            color: #9ca3af;
            margin-bottom: 12px;
        }
        /* Custom Buttons */
        .btn-brand {
            background-color: var(--brand-color);
            color: #ffffff;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 24px;
            border: none;
            transition: all 0.2s;
        }
        .btn-brand:hover {
            background-color: #333333;
            color: #ffffff;
        }
        .btn-light-custom {
            background-color: #ffffff;
            color: #4b5563;
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 24px;
            border: 1px solid #d1d5db;
            transition: all 0.2s;
        }
        .btn-light-custom:hover {
            background-color: #f3f4f6;
            color: #111827;
        }
        /* Checkbox styling for variants */
        .variant-checkbox {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .variant-checkbox input[type="checkbox"] {
            display: none;
        }
        .variant-checkbox label {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
            background-color: #ffffff;
        }
        .variant-checkbox input[type="checkbox"]:checked + label {
            background-color: #000000;
            color: #ffffff;
            border-color: #000000;
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item-link">
                <div class="nav-icon-wrap"><iconify-icon icon="lucide:layout-dashboard" style="font-size: 18px;"></iconify-icon></div>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="#" class="nav-item-link active">
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
                <h5 class="mb-0 fw-bold text-muted d-none d-sm-block">Products</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
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
            
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light border p-2" title="Go Back">
                        <iconify-icon icon="lucide:arrow-left" style="font-size: 18px;"></iconify-icon>
                    </a>
                    <h4 class="fw-bold mb-0">Add New Product</h4>
                </div>
                <div>
                    <!-- Form submit button will trigger the form below -->
                    <button type="submit" form="productForm" class="btn btn-brand d-flex align-items-center gap-2">
                        <iconify-icon icon="lucide:save"></iconify-icon> Save Product
                    </button>
                </div>
            </div>

            <!-- Validation Errors Display -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4 rounded-3 border-0 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add Product Form -->
            <form id="productForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    <!-- Left Column (Main Info & Media) -->
                    <div class="col-12 col-lg-8">
                        
                        <!-- Basic Info Card -->
                        <div class="form-card">
                            <div class="form-card-title">Basic Information</div>
                            
                            <div class="mb-4">
                                <label class="form-label">Product Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Thunder Glyph Heavyweight Tee" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="Write a detailed description of the product..."></textarea>
                            </div>
                        </div>

                        <!-- Media / Images Card -->
                        <div class="form-card">
                            <div class="form-card-title d-flex justify-content-between align-items-center">
                                <span>Media Gallery</span>
                                <span class="badge bg-light text-muted border">Max 10 Images</span>
                            </div>
                            
                            <!-- Notice the name="images[]" array and multiple attribute -->
                            <div class="upload-zone" onclick="document.getElementById('fileInput').click()">
                                <iconify-icon icon="lucide:image-plus" class="upload-icon"></iconify-icon>
                                <h6 class="fw-bold">Click to upload or drag and drop</h6>
                                <p class="text-muted small mb-0">SVG, PNG, JPG or WEBP (max. 800x800px)</p>
                                <input type="file" id="fileInput" name="images[]" multiple accept="image/*" class="d-none" max="10">
                            </div>
                            <!-- Future JS can display image previews here -->
                            <div id="imagePreviewContainer" class="d-flex gap-2 mt-3 flex-wrap"></div>
                        </div>

                        <!-- Variants (Sizes & Colors) Card -->
                        <div class="form-card">
                            <div class="form-card-title">Variants & Attributes</div>
                            
                            <div class="mb-4">
                                <label class="form-label d-block mb-3">Available Sizes</label>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-xs" name="sizes[]" value="XS">
                                    <label for="size-xs">XS</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-s" name="sizes[]" value="S">
                                    <label for="size-s">S</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-m" name="sizes[]" value="M">
                                    <label for="size-m">M</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-l" name="sizes[]" value="L" checked>
                                    <label for="size-l">L</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-xl" name="sizes[]" value="XL">
                                    <label for="size-xl">XL</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="size-xxl" name="sizes[]" value="XXL">
                                    <label for="size-xxl">XXL</label>
                                </div>
                            </div>

                            <div>
                                <label class="form-label d-block mb-3">Available Colors</label>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="color-black" name="colors[]" value="Black" checked>
                                    <label for="color-black"><span style="display:inline-block; width:12px; height:12px; background:#000; border-radius:50%; margin-right:6px;"></span>Black</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="color-white" name="colors[]" value="White">
                                    <label for="color-white"><span style="display:inline-block; width:12px; height:12px; background:#fff; border:1px solid #ccc; border-radius:50%; margin-right:6px;"></span>White</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="color-gray" name="colors[]" value="Heather Gray">
                                    <label for="color-gray"><span style="display:inline-block; width:12px; height:12px; background:#9ca3af; border-radius:50%; margin-right:6px;"></span>Gray</label>
                                </div>
                                <div class="variant-checkbox">
                                    <input type="checkbox" id="color-custom" name="colors[]" value="Custom">
                                    <label for="color-custom">Custom +</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column (Pricing, Inventory, Organization) -->
                    <div class="col-12 col-lg-4">
                        
                        <!-- Pricing Card -->
                        <div class="form-card">
                            <div class="form-card-title">Pricing</div>
                            
                            <div class="mb-0">
                                <label class="form-label">Base Price ($) *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 fw-bold">$</span>
                                    <input type="number" name="price" class="form-control border-start-0 ps-0" step="0.01" min="0" placeholder="0.00" required>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory Card -->
                        <div class="form-card">
                            <div class="form-card-title">Inventory</div>
                            
                            <div class="mb-0">
                                <label class="form-label">Quantity in Stock *</label>
                                <input type="number" name="stock" class="form-control" placeholder="0" min="0" required>
                            </div>
                        </div>

                        <!-- Organization Card -->
                        <div class="form-card">
                            <div class="form-card-title">Organization</div>
                            
                            <div class="mb-4">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="T-Shirts">T-Shirts</option>
                                    <option value="Hoodies">Hoodies</option>
                                    <option value="Accessories">Accessories</option>
                                    <option value="Bottoms">Bottoms</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Product Status</label>
                                <select name="status" class="form-select">
                                    <option value="active">Active (Visible)</option>
                                    <option value="draft">Draft (Hidden)</option>
                                </select>
                            </div>

                            <!-- Trending Toggle -->
                            <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-light">
                                <div>
                                    <div class="fw-bold" style="font-size: 14px;">Trending Product</div>
                                    <div class="text-muted" style="font-size: 12px;">Highlight on homepage</div>
                                </div>
                                <div class="form-check form-switch fs-4 mb-0">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_trending" value="1">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
            
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Simple JS to show selected file count -->
    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ''; // Clear existing
            
            const files = e.target.files;
            if(files.length > 10) {
                alert('You can only upload a maximum of 10 images.');
                this.value = ''; // Reset input
                return;
            }
            
            if(files.length > 0) {
                const badge = document.createElement('span');
                badge.className = 'badge bg-dark px-3 py-2 mt-2';
                badge.textContent = files.length + ' file(s) selected for upload.';
                container.appendChild(badge);
            }
        });
    </script>
</body>
</html>