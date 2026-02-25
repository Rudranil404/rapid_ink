<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Your Cart | Rapid Ink</title>
    
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>

    <style>
        :root { --background: #ffffff; --foreground: #000000; --border-color: #e5e7eb; --primary: #000000; --secondary: #f9fafb; --muted-foreground: #6b7280; }
        [data-theme="dark"] { --background: #000000; --foreground: #ffffff; --border-color: #333333; --primary: #ffffff; --secondary: #141414; --muted-foreground: #9ca3af; }
        
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background-color: var(--background); color: var(--foreground); font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; padding-top: 70px; }
        a { text-decoration: none; color: inherit; }
        
        /* Navbar */
        .nav-wrapper { position: fixed; top: 0; width: 100%; z-index: 50; background-color: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-color); height: 70px; display: flex; align-items: center; padding: 0 48px; justify-content: space-between; }
        [data-theme="dark"] .nav-wrapper { background-color: rgba(0,0,0,0.95); }
        .site-logo { height: 32px; }
        [data-theme="dark"] .site-logo { filter: invert(1); }
        .nav-actions { display: flex; gap: 24px; align-items: center; }
        .nav-icon { font-size: 20px; cursor: pointer; color: var(--foreground); position: relative; }
        .badge-cart { position: absolute; top: -6px; right: -8px; background: #ff4d4f; color: white; border-radius: 50%; width: 16px; height: 16px; font-size: 9px; font-weight: bold; display: flex; align-items: center; justify-content: center; }

        /* Cart Layout */
        .cart-container { max-width: 1200px; margin: 0 auto; padding: 60px 48px; display: grid; grid-template-columns: 2fr 1fr; gap: 64px; }
        .cart-header { font-size: 32px; font-weight: 800; text-transform: uppercase; letter-spacing: -0.02em; margin-bottom: 32px; border-bottom: 2px solid var(--foreground); padding-bottom: 16px; }
        
        .cart-item { display: flex; gap: 24px; padding: 24px 0; border-bottom: 1px solid var(--border-color); }
        .cart-item-img { width: 120px; aspect-ratio: 3/4; background: var(--secondary); border-radius: 8px; object-fit: cover; }
        .cart-item-details { flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .cart-item-title { font-size: 16px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px 0; }
        .cart-item-meta { font-size: 13px; color: var(--muted-foreground); margin-bottom: 4px; font-weight: 600; }
        .cart-item-price { font-size: 16px; font-weight: 700; }
        
        .qty-controls { display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 6px; width: fit-content; overflow: hidden; margin-top: 16px; }
        .qty-btn { background: transparent; border: none; padding: 8px 12px; cursor: pointer; color: var(--foreground); transition: background 0.2s; }
        .qty-btn:hover { background: var(--secondary); }
        .qty-input { width: 40px; text-align: center; border: none; background: transparent; font-weight: 700; color: var(--foreground); pointer-events: none; }
        
        .remove-btn { background: none; border: none; color: #ff4d4f; font-size: 13px; font-weight: 700; text-transform: uppercase; cursor: pointer; text-decoration: underline; padding: 0; margin-top: 16px; }

        /* Summary Panel */
        .summary-panel { background: var(--secondary); padding: 32px; border-radius: 12px; height: fit-content; position: sticky; top: 100px; }
        .summary-title { font-size: 20px; font-weight: 800; text-transform: uppercase; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 16px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 14px; font-weight: 600; color: var(--muted-foreground); }
        .summary-total { display: flex; justify-content: space-between; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--border-color); font-size: 20px; font-weight: 800; color: var(--foreground); }
        
        .checkout-btn { width: 100%; background: var(--primary); color: var(--background); border: none; padding: 18px; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; border-radius: 6px; margin-top: 32px; cursor: pointer; transition: transform 0.2s, opacity 0.2s; }
        .checkout-btn:hover { transform: translateY(-2px); opacity: 0.9; }

        /* Mobile Bottom Nav */
        .mobile-bottom-nav { display: none; position: fixed; bottom: 0; left: 0; width: 100%; background: var(--background); border-top: 1px solid var(--border-color); z-index: 1020; padding-bottom: env(safe-area-inset-bottom); }
        .mobile-bottom-nav-inner { display: flex; justify-content: space-around; align-items: center; height: 64px; }
        .mobile-nav-item { display: flex; flex-direction: column; align-items: center; gap: 4px; color: var(--muted-foreground); font-size: 10px; font-weight: 800; text-transform: uppercase; }
        .mobile-nav-item.active { color: var(--primary); }

        @media (max-width: 768px) {
            .nav-wrapper { padding: 0 24px; }
            .d-none-mobile { display: none !important; }
            .mobile-bottom-nav { display: flex; flex-direction: column; }
            body { padding-bottom: calc(64px + env(safe-area-inset-bottom)); }
            .cart-container { grid-template-columns: 1fr; padding: 32px 24px; gap: 40px; }
            .cart-header { font-size: 24px; }
            .cart-item-img { width: 90px; }
            .summary-panel { padding: 24px; border-radius: 8px; }
        }
    </style>
</head>
<body>

    <header class="nav-wrapper">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="site-logo">
        </a>
        <div class="nav-actions">
            <a href="{{ route('login') }}" class="d-none-mobile"><iconify-icon icon="lucide:user" class="nav-icon"></iconify-icon></a>
            <a href="{{ route('cart.index') }}" class="nav-icon">
                <iconify-icon icon="lucide:shopping-bag"></iconify-icon>
                <div class="badge-cart">{{ collect(session('cart', []))->sum('quantity') }}</div>
            </a>
        </div>
    </header>

    <main class="cart-container">
        <div>
            <h1 class="cart-header">Your Cart</h1>
            
            @if(session('cart_success'))
                <div style="background: #10b981; color: white; padding: 12px 16px; border-radius: 6px; font-weight: bold; margin-bottom: 24px; font-size: 14px;">
                    <iconify-icon icon="lucide:check-circle" style="vertical-align: middle; margin-right: 8px;"></iconify-icon> {{ session('cart_success') }}
                </div>
            @endif

            @if(count($cart) > 0)
                @foreach($cart as $key => $item)
                    <div class="cart-item">
                        @if($item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="cart-item-img">
                        @else
                            <div class="cart-item-img" style="display:flex; align-items:center; justify-content:center;">
                                <iconify-icon icon="lucide:image" style="font-size:32px; color:var(--muted-foreground)"></iconify-icon>
                            </div>
                        @endif
                        
                        <div class="cart-item-details">
                            <div>
                                <h3 class="cart-item-title">{{ $item['name'] }}</h3>
                                <div class="cart-item-meta">Size: {{ $item['size'] }} | Color: {{ $item['color'] }}</div>
                                <div class="cart-item-price">${{ number_format($item['price'], 2) }}</div>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $key }}">
                                    <div class="qty-controls">
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="qty-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                        <input type="text" class="qty-input" value="{{ $item['quantity'] }}" readonly>
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="qty-btn">+</button>
                                    </div>
                                </form>

                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $key }}">
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 60px 0;">
                    <iconify-icon icon="lucide:shopping-cart" style="font-size: 64px; color: var(--border-color); margin-bottom: 16px;"></iconify-icon>
                    <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">Your cart is empty</h3>
                    <p style="color: var(--muted-foreground); margin-bottom: 24px;">Looks like you haven't added anything to your cart yet.</p>
                    <a href="/products" style="background: var(--primary); color: var(--background); padding: 12px 24px; font-weight: bold; border-radius: 6px; text-transform: uppercase;">Continue Shopping</a>
                </div>
            @endif
        </div>

        @if(count($cart) > 0)
            <div class="summary-panel">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Calculated at checkout</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                
                <button class="checkout-btn" onclick="alert('Checkout integration coming next!')">
                    <iconify-icon icon="lucide:lock" style="vertical-align: middle; margin-right: 8px;"></iconify-icon> Proceed to Checkout
                </button>
            </div>
        @endif
    </main>

    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav-inner">
            <a href="/" class="mobile-nav-item">
                <iconify-icon icon="lucide:home" style="font-size: 22px;"></iconify-icon>
                <span>Home</span>
            </a>
            <a href="/products" class="mobile-nav-item">
                <iconify-icon icon="lucide:layout-grid" style="font-size: 22px;"></iconify-icon>
                <span>Shop</span>
            </a>
            <a href="{{ route('cart.index') }}" class="mobile-nav-item active">
                <div style="position: relative;">
                    <iconify-icon icon="lucide:shopping-bag" style="font-size: 22px;"></iconify-icon>
                    <div class="badge-cart" style="right: -4px; top: -2px;">{{ collect(session('cart', []))->sum('quantity') }}</div>
                </div>
                <span>Cart</span>
            </a>
        </div>
    </nav>
</body>
</html>