<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $currentCategory }} | {{ $settings['site_title'] ?? 'Rapid Ink' }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <style>
        /* Shared Base Styles */
        :root { --background: #ffffff; --foreground: #000000; --border-color: #e5e7eb; --primary: #000000; --secondary: #f5f5f5; --muted-foreground: #6b7280; }
        [data-theme="dark"] { --background: #000000; --foreground: #ffffff; --border-color: #333333; --primary: #ffffff; --secondary: #141414; --muted-foreground: #9ca3af; }
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background-color: var(--background); color: var(--foreground); font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; }
        
        /* Navbars (Copied perfectly from your Homepage) */
        .nav-wrapper { position: fixed; top: 0; width: 100%; z-index: 50; background-color: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-color); }
        [data-theme="dark"] .nav-wrapper { background-color: rgba(0,0,0,0.95); }
        .navbar { display: flex; align-items: center; justify-content: space-between; height: 70px; max-width: 100%; margin: 0 auto; padding: 0 48px; }
        .site-logo { height: 32px; transition: filter 0.3s; }
        [data-theme="dark"] .site-logo { filter: invert(1) brightness(2); }
        .nav-links { display: flex; gap: 40px; }
        .nav-link { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--muted-foreground); position: relative; transition: color 0.3s; }
        .nav-link:hover, .nav-link-active { color: var(--foreground); }
        .nav-link-active::after { content: ""; position: absolute; left: 0; bottom: -8px; width: 100%; height: 2px; background-color: var(--primary); }
        .nav-actions { display: flex; gap: 24px; align-items: center; }
        .nav-icon { font-size: 20px; cursor: pointer; color: var(--foreground); position: relative; }
        .badge-cart { position: absolute; top: -6px; right: -8px; background: #ff4d4f; color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 9px; font-weight: bold; display: flex; align-items: center; justify-content: center; }

        /* Catalog Layout Styles */
        .page-header { padding: 40px 48px; margin-top: 70px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: flex-end; }
        .page-title { font-size: 40px; font-weight: 800; text-transform: uppercase; letter-spacing: -0.02em; margin: 0; }
        .product-count { color: var(--muted-foreground); font-weight: 600; font-size: 14px; }
        
        .catalog-container { padding: 40px 48px; }
        .catalog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 40px 32px; }
        
        /* Product Card UI (Matches your uploaded image) */
        .product-card { display: flex; flex-direction: column; cursor: pointer; }
        .img-wrap { position: relative; aspect-ratio: 3/4; background: var(--secondary); border-radius: 8px; overflow: hidden; margin-bottom: 16px; }
        .img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; display: block; }
        .product-card:hover .img-wrap img { transform: scale(1.05); }
        
        /* Floating Cart Button inside image */
        .add-cart-btn { position: absolute; bottom: 12px; right: 12px; width: 40px; height: 40px; background-color: var(--primary); color: var(--background); border: none; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; opacity: 0; transform: translateY(10px); transition: all 0.3s ease; z-index: 2; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .product-card:hover .add-cart-btn { opacity: 1; transform: translateY(0); }
        .add-cart-btn:hover { transform: scale(1.1); }
        
        .p-title { font-size: 15px; font-weight: 800; text-transform: uppercase; margin: 0 0 6px 0; letter-spacing: 0.02em; }
        .p-price { font-size: 14px; font-weight: 600; color: var(--muted-foreground); margin: 0; }

        /* Mobile Bottom Nav & Responsive Adjustments */
        .mobile-bottom-nav { display: none; position: fixed; bottom: 0; left: 0; width: 100%; background: var(--background); border-top: 1px solid var(--border-color); z-index: 1020; padding-bottom: env(safe-area-inset-bottom); box-shadow: 0 -4px 12px rgba(0,0,0,0.05); }
        .mobile-bottom-nav-inner { display: flex; justify-content: space-around; align-items: center; height: 64px; }
        .mobile-nav-item { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; color: var(--muted-foreground); width: 100%; font-size: 10px; font-weight: 800; text-transform: uppercase; }
        .mobile-nav-item.active { color: var(--primary); }
        
        @media (max-width: 768px) {
            body { padding-bottom: calc(64px + env(safe-area-inset-bottom)); }
            .navbar { padding: 0 24px; }
            .d-none-mobile { display: none !important; }
            .mobile-bottom-nav { display: block; }
            .page-header { padding: 24px; flex-direction: column; align-items: flex-start; gap: 12px; }
            .page-title { font-size: 28px; }
            .catalog-container { padding: 24px; }
            .catalog-grid { grid-template-columns: repeat(2, 1fr); gap: 24px 16px; }
            .img-wrap { border-radius: 6px; }
            /* Always show cart button on mobile since there is no hover */
            .add-cart-btn { opacity: 1; transform: translateY(0); width: 32px; height: 32px; bottom: 8px; right: 8px; }
            .add-cart-btn iconify-icon { font-size: 16px !important; }
            .p-title { font-size: 13px; }
            .p-price { font-size: 13px; }
        }
    </style>
</head>
<body>

    <header class="nav-wrapper">
        <div class="navbar">
            <div style="display: flex; align-items: center; gap: 16px;">
                <iconify-icon icon="lucide:menu" class="nav-icon d-none-mobile" style="display: none;"></iconify-icon>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="site-logo">
                </a>
            </div>
            
            <nav class="nav-links d-none-mobile">
                <a href="/products" class="nav-link {{ !request('category') ? 'nav-link-active' : '' }}">All</a>
                <a href="/products?category=T-Shirts" class="nav-link {{ request('category') == 'T-Shirts' ? 'nav-link-active' : '' }}">Tees</a>
                <a href="/products?category=Hoodies" class="nav-link {{ request('category') == 'Hoodies' ? 'nav-link-active' : '' }}">Hoodies</a>
                <a href="/products?category=Bottoms" class="nav-link {{ request('category') == 'Bottoms' ? 'nav-link-active' : '' }}">Bottoms</a>
            </nav>
            
            <div class="nav-actions">
                <iconify-icon icon="lucide:search" class="nav-icon"></iconify-icon>
                <a href="{{ route('login') }}" class="d-none-mobile"><iconify-icon icon="lucide:user" class="nav-icon"></iconify-icon></a>
                <div class="nav-icon d-none-mobile">
                    <iconify-icon icon="lucide:shopping-bag"></iconify-icon>
                    <div class="badge-cart">0</div>
                </div>
            </div>
        </div>
    </header>

    <div class="page-header">
        <h1 class="page-title">{{ $currentCategory }}</h1>
        <div class="product-count">{{ $products->total() }} Products</div>
    </div>

    <main class="catalog-container">
        @if($products->count() > 0)
            <div class="catalog-grid">
                @foreach($products as $product)
                    <a href="#" class="product-card">
                        <div class="img-wrap">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color: var(--muted-foreground);">
                                    <iconify-icon icon="lucide:image" style="font-size: 40px; opacity: 0.3;"></iconify-icon>
                                </div>
                            @endif
                            
                            <button class="add-cart-btn" onclick="event.preventDefault(); alert('Added to cart!');">
                                <iconify-icon icon="lucide:shopping-cart" style="font-size: 18px;"></iconify-icon>
                            </button>
                        </div>
                        <div>
                            <h3 class="p-title">{{ $product->name }}</h3>
                            <p class="p-price">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div style="margin-top: 48px; display: flex; justify-content: center;">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div style="text-align: center; padding: 100px 0; color: var(--muted-foreground);">
                <iconify-icon icon="lucide:package-open" style="font-size: 64px; margin-bottom: 24px; opacity: 0.5;"></iconify-icon>
                <h3 style="font-size: 24px; font-weight: 800; color: var(--foreground); margin-bottom: 8px;">No products found</h3>
                <p>We couldn't find any items in this category right now.</p>
                <a href="/products" style="display: inline-block; margin-top: 16px; background: var(--primary); color: var(--background); padding: 12px 24px; font-weight: bold; border-radius: 6px;">Clear Filters</a>
            </div>
        @endif
    </main>

    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav-inner">
            <a href="/" class="mobile-nav-item">
                <iconify-icon icon="lucide:home" style="font-size: 22px;"></iconify-icon>
                <span>Home</span>
            </a>
            <a href="/products" class="mobile-nav-item active">
                <iconify-icon icon="lucide:layout-grid" style="font-size: 22px;"></iconify-icon>
                <span>Shop</span>
            </a>
            <a href="#" class="mobile-nav-item position-relative">
                <div style="position: relative;">
                    <iconify-icon icon="lucide:shopping-bag" style="font-size: 22px;"></iconify-icon>
                    <div class="badge-cart" style="right: -4px; top: -2px;">0</div>
                </div>
                <span>Cart</span>
            </a>
            <a href="{{ route('login') }}" class="mobile-nav-item">
                <iconify-icon icon="lucide:user" style="font-size: 22px;"></iconify-icon>
                <span>Profile</span>
            </a>
        </div>
    </nav>

    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    <script>
        // Copy user's theme preference from homepage
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    </script>
</body>
</html>