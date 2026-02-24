<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>{{ $settings['site_title'] ?? 'Rapid Ink | Premium Streetwear' }}</title>
    <meta name="description" content="{{ $settings['meta_description'] ?? 'Shop the latest premium streetwear and heavyweight tees at Rapid Ink.' }}">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100;200;300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <style id="base-reset">
        * { box-sizing: border-box; }
        body { margin: 0; padding: 0; background-color: var(--background); color: var(--foreground); line-height: 1.6; font-family: var(--font-family-body, system-ui, -apple-system, sans-serif); -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; margin: 0; padding: 0; }
        .container { max-width: 100%; width: 100%; margin: 0 auto; padding: 0 48px; }
        .section-padding { padding: 112px 0; }
        .site-logo { height: 40px; width: auto; transition: filter 0.3s ease; }
        [data-theme="dark"] .site-logo { filter: invert(1) brightness(2); }

        .announcement-bar { background-color: var(--foreground); color: var(--background); font-size: 12px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; text-align: center; height: 40px; display: flex; align-items: center; justify-content: center; position: relative; z-index: 1040; transition: opacity 0.2s; }
        a.announcement-bar:hover { opacity: 0.9; }
    </style>

    <style id="typography-styles">
        .heading-xl { font-size: 88px; font-weight: 900; text-transform: uppercase; letter-spacing: -0.04em; line-height: 0.95; margin: 0; }
        .heading-lg { font-size: 48px; font-weight: 800; text-transform: uppercase; letter-spacing: -0.03em; line-height: 1.1; margin: 0; }
        .heading-md { font-size: 24px; font-weight: 800; text-transform: uppercase; letter-spacing: -0.02em; margin: 0; }
        .text-muted { color: var(--muted-foreground); font-size: 16px; line-height: 1.6; margin: 0; }
        .text-accent { color: var(--primary); }
    </style>

    <style id="button-styles">
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 18px 36px; background-color: var(--primary); color: var(--primary-foreground); font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 0.06em; border: none; border-radius: var(--radius-sm); cursor: pointer; white-space: nowrap; transition: transform 0.2s, opacity 0.2s; }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }
        .btn-outline { background-color: transparent; border: 1px solid var(--border); color: var(--foreground); }
        .btn-link { display: inline-flex; align-items: center; background: none; border: none; padding: 0; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--foreground); cursor: pointer; }
    </style>

    <style id="nav-styles">
        .nav-wrapper { position: absolute; top: 40px; width: 100%; z-index: 50; background-color: transparent; border-bottom: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease; }
        .nav-wrapper.scrolled { position: fixed; top: 0; background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border); box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        [data-theme="dark"] .nav-wrapper.scrolled { background-color: rgba(0, 0, 0, 0.95); }
        .navbar { display: flex; align-items: center; justify-content: space-between; height: 88px; transition: height 0.3s; }
        .nav-wrapper.scrolled .navbar { height: 70px; }
        .nav-links { display: flex; gap: 40px; }
        .nav-link { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--muted-foreground); position: relative; white-space: nowrap; cursor: pointer; transition: color 0.3s; }
        .nav-link-active { color: var(--foreground); }
        .nav-link-active::after { content: ""; position: absolute; left: 0; bottom: -8px; width: 100%; height: 2px; background-color: var(--primary); transition: background-color 0.3s; }
        .nav-wrapper:not(.scrolled) .nav-link { color: rgba(255, 255, 255, 0.8); }
        .nav-wrapper:not(.scrolled) .nav-link:hover, .nav-wrapper:not(.scrolled) .nav-link-active { color: #ffffff; }
        .nav-wrapper:not(.scrolled) .nav-link-active::after { background-color: #ffffff; }
        .nav-wrapper:not(.scrolled) .nav-icon iconify-icon { color: #ffffff !important; }
        .nav-wrapper:not(.scrolled) .site-logo { filter: brightness(0) invert(1) !important; }
        .nav-actions { display: flex; align-items: center; gap: 24px; }
        .nav-icon { width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; position: relative; cursor: pointer; }
        .nav-icon iconify-icon { font-size: 20px; color: var(--foreground); transition: color 0.3s; }
        .nav-cart-badge { position: absolute; top: -6px; right: -6px; background-color: #ff4d4f; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800; }
    </style>

    <style id="hero-carousel-styles">
        .hero-carousel { position: relative; height: 100vh; min-height: 600px; overflow: hidden; background-color: #111; }
        .carousel-inner { width: 100%; height: 100%; position: relative; }
        .carousel-item { position: absolute; inset: 0; opacity: 0; transition: opacity 0.8s ease-in-out; z-index: 1; }
        .carousel-item.active { opacity: 1; z-index: 2; }
        .carousel-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%); z-index: 1; }
        .carousel-item img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; z-index: 0; }
        .hero-caption { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -40%); text-align: center; width: 100%; max-width: 800px; padding: 0 24px; z-index: 3; transition: transform 0.8s ease-out, opacity 0.8s ease-out; opacity: 0; }
        .carousel-item.active .hero-caption { transform: translate(-50%, -50%); opacity: 1; }
        .hero-headline { font-size: 72px; font-weight: 900; color: #ffffff; text-transform: uppercase; letter-spacing: -0.02em; line-height: 1; margin-bottom: 24px; }
        .hero-subtext { font-size: 18px; color: rgba(255, 255, 255, 0.9); margin-bottom: 40px; font-weight: 500; line-height: 1.6; }
        .carousel-indicators { position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px; z-index: 10; }
        .carousel-indicator { width: 40px; height: 4px; background-color: rgba(255,255,255,0.3); border: none; cursor: pointer; transition: background-color 0.3s; padding: 0; }
        .carousel-indicator.active { background-color: #ffffff; }
        .carousel-controls { position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); display: flex; justify-content: space-between; padding: 0 40px; z-index: 10; pointer-events: none; }
        .carousel-control { width: 48px; height: 48px; background: rgba(255,255,255,0.1); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.2); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; pointer-events: auto; transition: all 0.3s; }
        .carousel-control:hover { background: rgba(255,255,255,0.3); }
        @media (max-width: 768px) { .hero-headline { font-size: 40px; } .hero-carousel { height: 80vh; } .carousel-controls { display: none; } }
    </style>

    <style id="trending-grid-styles">
        .category-strip { background-color: var(--card); padding: 24px 0; border-bottom: 1px solid var(--border); }
        .category-row { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
        .category-label { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted-foreground); }
        .category-pills { display: flex; flex: 1; gap: 16px; overflow-x: auto; scrollbar-width: none; }
        .category-pills::-webkit-scrollbar { display: none; }
        .category-pill { padding: 10px 20px; border-radius: var(--radius-xl); background-color: var(--background); border: 1px solid var(--border); font-size: 13px; font-weight: 600; white-space: nowrap; cursor: pointer; transition: all 0.2s; }
        .category-pill:hover { border-color: var(--foreground); }
        .category-pill-active { background-color: var(--foreground); color: var(--background); border-color: var(--foreground); }

        .trending-grid-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; }
        .trending-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 32px; }
        .trend-card { cursor: pointer; display: block; text-decoration: none; color: inherit; transition: transform 0.3s; }
        .trend-card:hover { transform: translateY(-8px); }
        .trend-image-wrap { width: 100%; aspect-ratio: 3/4; background-color: var(--secondary); border-radius: var(--radius-md); border: 1px solid var(--border); overflow: hidden; margin-bottom: 20px; position: relative; }
        .trend-image-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s; }
        .trend-card:hover .trend-image-wrap img { transform: scale(1.05); }
        .trend-info { padding: 0 4px; }
        .trend-title { font-size: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.02em; margin-bottom: 6px; color: var(--foreground); }
        .trend-meta { font-size: 14px; font-weight: 600; color: var(--muted-foreground); }
        .badge-trend { position: absolute; top: 12px; left: 12px; background-color: var(--foreground); color: var(--background); font-size: 11px; font-weight: 800; padding: 6px 12px; text-transform: uppercase; z-index: 2; border-radius: var(--radius-sm); }
        @media (max-width: 1024px) { .trending-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) { .trending-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; } .container { padding: 0 24px; } }
    </style>

    <style id="custom-featured-styles">
        /* Replaces Promo Row with Dynamic Featured Categories */
        .featured-row { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 32px; }
        .cat-card { background-color: var(--card); border-radius: var(--radius-lg); border: 1px solid var(--border); display: flex; flex-direction: column; justify-content: flex-end; padding: 40px; position: relative; overflow: hidden; min-height: 350px; text-decoration: none; }
        .cat-card::before { content: ""; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.1) 100%); z-index: 1; transition: opacity 0.3s; }
        .cat-card img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; transition: transform 0.6s ease; }
        .cat-card:hover img { transform: scale(1.08); }
        .cat-card:hover::before { opacity: 0.9; }
        .cat-card-content { position: relative; z-index: 2; color: #ffffff; }
        .cat-title { font-size: 28px; font-weight: 800; line-height: 1.2; letter-spacing: -0.02em; margin: 0; text-transform: uppercase; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .cat-link { font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: var(--primary); margin-top: 12px; display: inline-flex; align-items: center; gap: 4px; }
        @media (max-width: 1024px) { .featured-row { grid-template-columns: 1fr; } }
    </style>

    <style id="masonry-section-styles">
        .masonry-section-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 56px; }
        .masonry-grid { column-count: 3; column-gap: 32px; }
        .masonry-item { break-inside: avoid; margin-bottom: 40px; cursor: pointer; }
        .masonry-image-wrap { background-color: var(--secondary); border-radius: var(--radius-md); border: 1px solid var(--border); overflow: hidden; margin-bottom: 20px; position: relative; }
        .masonry-image-wrap img { width: 100%; display: block; object-fit: cover; }
        .masonry-cart-btn { position: absolute; bottom: 20px; right: 20px; width: 48px; height: 48px; border-radius: var(--radius-sm); background-color: var(--primary); display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); }
        .masonry-info { padding: 0 4px; display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; }
        .masonry-text { display: flex; flex-direction: column; gap: 6px; }
        .masonry-name { font-size: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.02em; }
        .masonry-price { font-size: 15px; font-weight: 600; color: var(--muted-foreground); }
        @media (max-width: 768px) { .masonry-grid { column-count: 2; } }
    </style>

    <style>
        :root { --background: #ffffff; --foreground: #000000; --border: #00000014; --primary: #000000; --primary-foreground: #ffffff; --secondary: #f5f5f5; --muted-foreground: #888888; --card: #ffffff; --radius-sm: 4px; --radius-md: 6px; --radius-lg: 8px; --radius-xl: 12px; --font-family-body: 'Inter', sans-serif; }
        [data-theme="dark"] { --background: #000000; --foreground: #ffffff; --border: #ffffff14; --primary: #fff5b8; --primary-foreground: #000000; --secondary: #141414; --muted-foreground: #9b9b9b; --card: #0b0b0b; }
    </style>
    <style id="footer-styles">
        .footer { border-top: 1px solid var(--border); padding: 96px 0 48px 0; background-color: var(--background); }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 64px; margin-bottom: 64px; }
        .footer-brand { display: flex; flex-direction: column; gap: 24px; }
        .footer-desc { color: var(--muted-foreground); font-size: 15px; line-height: 1.6; max-width: 380px; margin: 0; }
        .footer-title { font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 24px 0; color: var(--foreground); }
        .footer-links { display: flex; flex-direction: column; gap: 16px; }
        .footer-link { font-size: 14px; font-weight: 500; color: var(--muted-foreground); cursor: pointer; transition: color 0.2s; }
        .footer-link:hover { color: var(--foreground); }
        .footer-bottom { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 32px; font-size: 13px; font-weight: 500; color: var(--muted-foreground); }
        @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr 1fr; gap: 40px; } .footer-brand { grid-column: 1 / -1; } .footer-bottom { flex-direction: column; gap: 16px; text-align: center; } }
    </style>
  </head>

  <body>
    @if(!empty($settings['promo_link']))
        <a href="{{ $settings['promo_link'] }}" class="announcement-bar">
            {{ $settings['promo_text'] ?? '🔥 FREE Worldwide Shipping on Orders Over $75!' }}
        </a>
    @else
        <div class="announcement-bar">
            {{ $settings['promo_text'] ?? '🔥 FREE Worldwide Shipping on Orders Over $75!' }}
        </div>
    @endif

    <header class="nav-wrapper" id="storeNavbar">
        <div class="navbar container">
            <a href="/" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo" class="site-logo">
            </a>
            <nav class="nav-links d-none-mobile">
                <div class="nav-link nav-link-active">New Arrivals</div>
                <div class="nav-link">Tees</div>
                <div class="nav-link">Hoodies</div>
                <div class="nav-link">About Us</div>
            </nav>
            <div class="nav-actions">
                <div class="nav-icon"><iconify-icon icon="lucide:search" style="font-size: 20px; color: var(--foreground)"></iconify-icon></div>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-icon"><iconify-icon icon="lucide:user" style="font-size: 20px; color: var(--foreground)"></iconify-icon></a>
                @else
                    <a href="{{ route('login') }}" class="nav-icon"><iconify-icon icon="lucide:user" style="font-size: 20px; color: var(--foreground)"></iconify-icon></a>
                @endauth
                <div class="nav-icon">
                    <iconify-icon icon="lucide:shopping-bag" style="font-size: 20px; color: var(--foreground)"></iconify-icon>
                    <div class="nav-cart-badge">0</div>
                </div>
                <div class="nav-icon" id="theme-toggle">
                    <iconify-icon icon="lucide:moon" style="font-size:20px; color:var(--foreground)"></iconify-icon>
                </div>
            </div>
        </div>
    </header>

    <main>
        @php
            // Extract and sort slides dynamically from database settings
            $slides = [];
            foreach($settings as $key => $val) {
                if (preg_match('/^slide(\d+)_headline$/', $key, $matches)) {
                    $idx = (int)$matches[1];
                    $slides[$idx] = [
                        'headline' => $settings["slide{$idx}_headline"] ?? '',
                        'subtext'  => $settings["slide{$idx}_subtext"] ?? '',
                        'image'    => $settings["slide{$idx}_image"] ?? null,
                        'btn_text' => $settings["slide{$idx}_btn_text"] ?? 'Shop Now',
                        'btn_link' => $settings["slide{$idx}_btn_link"] ?? '#',
                    ];
                }
            }
            ksort($slides); // Ensure they are in order (1, 2, 3, 4...)
            
            // Re-index array to start at 0 for the loop
            $slides = array_values($slides); 

            // Fallback default slides if database is entirely empty
            if (empty($slides)) {
                $slides = [
                    [
                        'headline' => 'Premium Threads for the Bold',
                        'subtext' => 'Discover the latest collection of high-quality tees.',
                        'image' => null,
                        'btn_text' => 'Shop The Collection',
                        'btn_link' => '#trending'
                    ]
                ];
            }
        @endphp

        <section class="hero-carousel">
            <div class="carousel-inner" id="heroInner">
                @foreach($slides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="carousel-overlay"></div>
                        <img src="{{ $slide['image'] ? asset('storage/'.$slide['image']) : 'https://storage.googleapis.com/banani-generated-images/generated-images/eeab8140-ce1a-498f-8057-0719f228e595.jpg' }}" alt="Slide {{ $index + 1 }}">
                        <div class="hero-caption">
                            <h1 class="hero-headline">{{ $slide['headline'] }}</h1>
                            <p class="hero-subtext">{{ $slide['subtext'] }}</p>
                            <a href="{{ $slide['btn_link'] }}" class="btn" style="background-color: #ffffff; color: #000000;">
                                {{ $slide['btn_text'] }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="carousel-controls">
                <div class="carousel-control prev" id="carouselPrev"><iconify-icon icon="lucide:chevron-left" style="font-size: 24px;"></iconify-icon></div>
                <div class="carousel-control next" id="carouselNext"><iconify-icon icon="lucide:chevron-right" style="font-size: 24px;"></iconify-icon></div>
            </div>
            
            <div class="carousel-indicators" id="carouselIndicators">
                @foreach($slides as $index => $slide)
                    <div class="carousel-indicator {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
                @endforeach
            </div>
        </section>

        <section class="category-strip">
            <div class="container category-row">
                <div class="category-label">Browse Rapid Ink</div>
                <div class="category-pills">
                    <div class="category-pill category-pill-active">All Tees</div>
                    <div class="category-pill">Oversized</div>
                    <div class="category-pill">Graphic Packs</div>
                    <div class="category-pill">New This Week</div>
                    <div class="category-pill">Under $50</div>
                </div>
                <button class="btn-link">View All <iconify-icon icon="lucide:arrow-right" style="font-size: 16px; margin-left: 6px"></iconify-icon></button>
            </div>
        </section>

        <section id="trending" class="section-padding">
            <div class="container">
                <div class="trending-grid-header">
                    <div>
                        <h2 class="heading-lg">{{ $settings['trending_title'] ?? 'Trending Now' }}</h2>
                        <p class="text-muted" style="margin-top: 12px">Pieces the community is spinning on repeat this week.</p>
                    </div>
                    <button class="btn btn-outline">View Full Drop</button>
                </div>
                
                <div class="trending-grid">
                    @if(isset($products) && $products->count() > 0)
                        @foreach($products->take(8) as $product)
                            <article class="trend-card">
                                <a href="#" style="display: block;">
                                    <div class="trend-image-wrap">
                                        @if($product->is_trending)
                                            <span class="badge-trend">Hot</span>
                                        @endif
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:var(--secondary); color:var(--muted-foreground);">
                                                <iconify-icon icon="lucide:image" style="font-size: 40px; opacity: 0.3;"></iconify-icon>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="trend-info">
                                        <div class="trend-title">{{ $product->name }}</div>
                                        <div class="trend-meta">${{ number_format($product->price, 2) }}</div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    @else
                        <div style="grid-column: 1 / -1; text-align: center; padding: 80px 0; color: var(--muted-foreground);">
                            <iconify-icon icon="lucide:package-open" style="font-size: 48px; margin-bottom: 16px;"></iconify-icon>
                            <p style="font-size: 16px; font-weight: 500;">No products available yet. Check back soon!</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @php
            $cats = [];
            foreach($settings as $key => $val) {
                if (preg_match('/^cat(\d+)_title$/', $key, $matches)) {
                    $idx = (int)$matches[1];
                    $cats[$idx] = [
                        'title' => $settings["cat{$idx}_title"] ?? '',
                        'image' => $settings["cat{$idx}_image"] ?? null,
                        'link'  => $settings["cat{$idx}_link"] ?? '#',
                    ];
                }
            }
            ksort($cats);
            $cats = array_values($cats);
            
            // Default fallbacks if empty
            if (empty($cats)) {
                $cats = [
                    ['title' => 'Heavyweight Tees', 'image' => null, 'link' => '#'],
                    ['title' => 'Premium Hoodies', 'image' => null, 'link' => '#'],
                    ['title' => 'Accessories', 'image' => null, 'link' => '#'],
                ];
            }
        @endphp

        <section class="section-padding" style="padding-top: 0">
            <div class="container featured-row" style="grid-template-columns: repeat({{ count($cats) > 4 ? 4 : count($cats) }}, minmax(0, 1fr));">
                @foreach($cats as $cat)
                    <a href="{{ $cat['link'] }}" class="cat-card">
                        @if($cat['image'])
                            <img src="{{ asset('storage/'.$cat['image']) }}" alt="{{ $cat['title'] }}">
                        @else
                            <div style="position: absolute; inset:0; background-color: var(--secondary);"></div>
                        @endif
                        <div class="cat-card-content">
                            <h3 class="cat-title">{{ $cat['title'] }}</h3>
                            <span class="cat-link">Shop Collection <iconify-icon icon="lucide:arrow-right"></iconify-icon></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="section-padding" style="background-color: var(--secondary); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
            <div class="container">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 64px; align-items: center;">
                    <div>
                        <h2 class="heading-lg" style="margin-bottom: 24px;">{{ $settings['brand_heading'] ?? 'Crafted for the Culture' }}</h2>
                        <p class="text-muted" style="font-size: 18px; line-height: 1.8;">
                            {{ $settings['brand_text'] ?? 'Rapid Ink was born out of a desire to blend street culture with premium quality fabrics. Every piece is designed with intention.' }}
                        </p>
                    </div>
                    <div style="border-radius: var(--radius-xl); overflow: hidden; border: 1px solid var(--border); aspect-ratio: 4/3;">
                        <img src="{{ isset($settings['brand_image']) ? asset('storage/'.$settings['brand_image']) : 'https://storage.googleapis.com/banani-generated-images/generated-images/2011c442-1c48-49ae-9e54-c48254fd0843.jpg' }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Brand Story">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <div class="container">
                <div class="masonry-section-header">
                    <div>
                        <h2 class="heading-lg">{{ $settings['new_arrivals_title'] ?? 'Latest Drops' }}</h2>
                        <p class="text-muted" style="margin-top: 12px; max-width: 600px">
                            Curated tees infused with digital ink splatters and high-voltage lightning motifs. Grab them before they fade into the static.
                        </p>
                    </div>
                    <button class="btn btn-outline">View Collection</button>
                </div>

                <div class="masonry-grid">
                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/9209bf26-eaac-48d7-a530-5355c6803043.jpg" alt="Thunder Glyph Tee" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Thunder Glyph Tee</div><div class="masonry-price">$45.00</div></div>
                        </div>
                    </article>

                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/580e94b4-4285-4625-b6ff-7d95ce1bb630.jpg" alt="Voltage Leap Tee" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Voltage Leap Tee</div><div class="masonry-price">$52.00</div></div>
                        </div>
                    </article>

                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/2011c442-1c48-49ae-9e54-c48254fd0843.jpg" alt="Brush Chaos Tee" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Brush Chaos Tee</div><div class="masonry-price">$40.00</div></div>
                        </div>
                    </article>

                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/f39be664-98ba-4195-9b7f-e5c395cc0e6d.jpg" alt="Signal Line Tee" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Signal Line Tee</div><div class="masonry-price">$38.00</div></div>
                        </div>
                    </article>

                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/43fc10f1-9bea-4109-9163-db7ef97c7741.jpg" alt="Static Stack Pack" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Static Stack Pack</div><div class="masonry-price">$110.00</div></div>
                        </div>
                    </article>

                    <article class="masonry-item">
                        <div class="masonry-image-wrap">
                            <img src="https://storage.googleapis.com/banani-generated-images/generated-images/8ec35f28-990c-46ed-918f-16703ddc7257.jpg" alt="Neon Rail Tee" />
                            <div class="masonry-cart-btn"><iconify-icon icon="lucide:shopping-cart" style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon></div>
                        </div>
                        <div class="masonry-info">
                            <div class="masonry-text"><div class="masonry-name">Neon Rail Tee</div><div class="masonry-price">$55.00</div></div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <footer class="footer">
        <div class="container">
          <div class="footer-grid">
            
            <div class="footer-brand">
                <a href="/" class="nav-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo" class="site-logo">
                </a>
              <p class="footer-desc">
                Rapid Ink blends digital artistry with premium fabrics to deliver tees that feel as sharp as they look. Built for city nights and everyday motion.
              </p>
              <div style="display: flex; gap: 20px; margin-top: 8px">
                <div class="nav-icon" data-media-type="banani-button">
                  <iconify-icon icon="lucide:instagram" style="font-size: 24px; color: var(--foreground)"></iconify-icon>
                </div>
                <div class="nav-icon" data-media-type="banani-button">
                  <iconify-icon icon="lucide:twitter" style="font-size: 24px; color: var(--foreground)"></iconify-icon>
                </div>
              </div>
            </div>

            <div>
              <h4 class="footer-title">Shop</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">All Tees</div>
                <div class="footer-link" data-media-type="banani-button">Oversized Fits</div>
                <div class="footer-link" data-media-type="banani-button">Artist Collabs</div>
                <div class="footer-link" data-media-type="banani-button">Bundles</div>
              </div>
            </div>

            <div>
              <h4 class="footer-title">Help</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">Shipping &amp; Returns</div>
                <div class="footer-link" data-media-type="banani-button">Size Guide</div>
                <div class="footer-link" data-media-type="banani-button">Track Order</div>
                <div class="footer-link" data-media-type="banani-button">FAQ</div>
              </div>
            </div>

            <div>
              <h4 class="footer-title">About</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">Our Story</div>
                <div class="footer-link" data-media-type="banani-button">Careers</div>
                <div class="footer-link" data-media-type="banani-button">Contact</div>
                <div class="footer-link" data-media-type="banani-button">Legal</div>
              </div>
            </div>

          </div>

          <div class="footer-bottom">
            <span>© {{ date('Y') }} {{ $settings['site_title'] ?? 'Rapid Ink' }}. All rights reserved.</span>
            <span>High-voltage apparel · Designed for motion.</span>
          </div>
        </div>
      </footer>
    </main>

    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    <script>
        // Theme Toggle Logic
        (function () {
            const stored = localStorage.getItem('theme');
            let theme = stored || 'light';
            document.documentElement.setAttribute('data-theme', theme);

            const toggle = document.getElementById('theme-toggle');
            function updateIcon(current) {
                if (!toggle) return;
                toggle.innerHTML = current === 'dark' 
                    ? '<iconify-icon icon="lucide:sun" style="font-size:20px; color:var(--foreground)"></iconify-icon>' 
                    : '<iconify-icon icon="lucide:moon" style="font-size:20px; color:var(--foreground)"></iconify-icon>';
            }
            updateIcon(theme);

            if (toggle) {
                toggle.addEventListener('click', () => {
                    const current = document.documentElement.getAttribute('data-theme');
                    const next = current === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', next);
                    localStorage.setItem('theme', next);
                    updateIcon(next);
                });
            }
        })();

        // Navbar Scroll Logic
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('storeNavbar');
            const annBar = document.querySelector('.announcement-bar');
            const annHeight = annBar ? annBar.offsetHeight : 40;
            
            if (window.scrollY > annHeight) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Vanilla JS Carousel Logic
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.carousel-item');
            const indicators = document.querySelectorAll('.carousel-indicator');
            const prevBtn = document.getElementById('carouselPrev');
            const nextBtn = document.getElementById('carouselNext');
            
            if(items.length === 0) return;

            let currentIndex = 0;
            let interval;

            function showSlide(index) {
                items.forEach(item => item.classList.remove('active'));
                indicators.forEach(ind => ind.classList.remove('active'));

                currentIndex = index;
                if (currentIndex >= items.length) currentIndex = 0;
                if (currentIndex < 0) currentIndex = items.length - 1;

                items[currentIndex].classList.add('active');
                indicators[currentIndex].classList.add('active');
            }

            function nextSlide() { showSlide(currentIndex + 1); }
            function prevSlide() { showSlide(currentIndex - 1); }

            if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetInterval(); });
            if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetInterval(); });

            indicators.forEach((ind, idx) => {
                ind.addEventListener('click', () => { showSlide(idx); resetInterval(); });
            });

            function startInterval() { interval = setInterval(nextSlide, 6000); }
            function resetInterval() { clearInterval(interval); startInterval(); }

            startInterval();
        });
    </script>
</body>
</html>