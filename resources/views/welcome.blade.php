<div class="export-wrapper" style="
    width: 100%;
    min-height: 812px;
    position: relative;
    font-family: var(--font-family-body);
    background-color: var(--background);
  ">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100;200;300;400;500;600;700;800;900&family=Geist:wght@100;200;300;400;500;600;700;800;900&family=IBM+Plex+Mono:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:wght@100;200;300;400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&family=PT+Serif:wght@400;700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Shantell+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <html>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rapid Ink - High Fidelity Storefront</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style id="base-reset">
      * {
        box-sizing: border-box;
      }
        /* Add this inside your <style id="base-reset"> or anywhere in the head */
        .site-logo {
        height: 50px; /* Adjust this to make it bigger or smaller */
        width: auto;
        transition: filter 0.3s ease;
        }

        /* Inverts the black logo to white when dark mode is active */
        [data-theme="dark"] .site-logo {
        filter: invert(1) brightness(2); 
        }
      .export-wrapper {
        margin: 0;
        padding: 0;
        background-color: var(--background);
        color: var(--foreground);
        line-height: 1.6;
        font-family: var(--font-family-body,
            system-ui,
            -apple-system,
            sans-serif);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      a {
        text-decoration: none;
        color: inherit;
      }

      ul {
        list-style: none;
        margin: 0;
        padding: 0;
      }

      .container {
        max-width: 100%;
        width: 100%;
        margin: 0 auto;
        padding: 0 48px;
      }

      .section-padding {
        padding: 112px 0;
      }
    </style>

    <style id="typography-styles">
      .heading-xl {
        font-size: 88px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.04em;
        line-height: 0.95;
        margin: 0;
      }

      .heading-lg {
        font-size: 48px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -0.03em;
        line-height: 1.1;
        margin: 0;
      }

      .heading-md {
        font-size: 24px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        margin: 0;
      }

      .text-muted {
        color: var(--muted-foreground);
        font-size: 16px;
        line-height: 1.6;
        margin: 0;
      }

      .text-accent {
        color: var(--primary);
      }
    </style>

    <style id="button-styles">
      .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 18px 36px;
        background-color: var(--primary);
        color: var(--primary-foreground);
        font-weight: 800;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        white-space: nowrap;
      }

      .btn-outline {
        background-color: transparent;
        border: 1px solid var(--border);
        color: var(--foreground);
      }

      .btn-link {
        display: inline-flex;
        align-items: center;
        background: none;
        border: none;
        padding: 0;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--foreground);
        cursor: pointer;
      }
    </style>

    <style id="nav-styles">
      .nav-wrapper {
        position: sticky;
        top: 0;
        z-index: 50;
        background-color: var(--background);
        border-bottom: 1px solid var(--border);
      }

      .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 88px;
      }

      .nav-logo {
        font-size: 26px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -0.04em;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .nav-logo-icon {
        color: var(--primary);
        display: flex;
      }

      .nav-links {
        display: flex;
        gap: 40px;
      }

      .nav-link {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--muted-foreground);
        position: relative;
        white-space: nowrap;
        cursor: pointer;
      }

      .nav-link-active {
        color: var(--foreground);
      }

      .nav-link-active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 100%;
        height: 2px;
        background-color: var(--primary);
      }

      .nav-actions {
        display: flex;
        align-items: center;
        gap: 24px;
      }

      .nav-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
      }

      .nav-cart-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background-color: var(--primary);
        color: var(--primary-foreground);
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
      }
    </style>

    <style id="hero-styles">
      .hero {
        position: relative;
        padding: 100px 0 80px 0;
        overflow: hidden;
        background-image: radial-gradient(circle at 50% -20%,
            rgba(254, 240, 138, 0.05) 0%,
            transparent 60%);
      }

      .hero-inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
      }

      .hero-content {
        padding-right: 24px;
      }

      .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        background-color: var(--secondary);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 32px;
      }

      .hero-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: var(--primary);
        box-shadow: 0 0 10px var(--primary);
      }

      .hero-title-accent span {
        color: var(--primary);
      }

      .hero-desc {
        margin-top: 32px;
        font-size: 18px;
        color: var(--muted-foreground);
        max-width: 520px;
        line-height: 1.6;
      }

      .hero-actions {
        display: flex;
        gap: 16px;
        margin-top: 48px;
        align-items: center;
      }

      .hero-metrics {
        display: flex;
        gap: 56px;
        margin-top: 56px;
        padding-top: 40px;
        border-top: 1px solid var(--border);
      }

      .metric {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .metric-value {
        font-size: 28px;
        font-weight: 900;
        color: var(--foreground);
        letter-spacing: -0.02em;
        line-height: 1;
      }

      .metric-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--muted-foreground);
      }

      .hero-visual {
        position: relative;
        height: 680px;
      }

      .hero-image-frame {
        position: relative;
        width: 100%;
        height: 100%;
        background-color: var(--secondary);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        overflow: hidden;
      }

      .hero-image-frame::after {
        content: "";
        position: absolute;
        inset: 0;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        pointer-events: none;
      }

      .hero-image-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .hero-tagline {
        position: absolute;
        bottom: 32px;
        left: -24px;
        background-color: var(--primary);
        color: var(--primary-foreground);
        padding: 14px 28px;
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-radius: var(--radius-sm);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
      }

      .hero-floating-card {
        position: absolute;
        top: 40px;
        right: -32px;
        background-color: var(--card);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
      }

      .hero-floating-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--muted-foreground);
      }

      .hero-floating-value {
        font-size: 16px;
        font-weight: 800;
        color: var(--foreground);
      }
    </style>

    <style id="category-strip-styles">
      .category-strip {
        background-color: var(--card);
        padding: 24px 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
      }

      .category-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
      }
      /* responsive adjustments */
      @media (max-width: 768px) {
        .container { padding: 0 16px; }
        .nav-logo { font-size: 20px; }
        .nav-links { gap: 20px; flex-wrap: wrap; justify-content: center; }
        .nav-link { font-size: 12px; }
        .hero { padding: 60px 0 40px 0; }
        .hero-inner { grid-template-columns: 1fr; gap: 40px; }
        .hero-content { padding-right: 0; }
        .hero-desc { font-size: 16px; max-width: 100%; }
        .hero-actions { flex-direction: column; gap: 16px; align-items: stretch; }
        .hero-metrics { flex-direction: column; gap: 24px; padding-top: 24px; }
        .hero-visual { height: auto; }
        .hero-image-frame { height: 400px; }
        .hero-badge { margin-bottom: 24px; }
        .metric-value { font-size: 24px; }
        .metric-label { font-size: 11px; }
      }

      .category-label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--muted-foreground);
      }

      .category-pills {
        display: flex;
        flex: 1;
        gap: 16px;
        overflow: hidden;
      }

      .category-pill {
        padding: 10px 20px;
        border-radius: var(--radius-xl);
        background-color: var(--background);
        border: 1px solid var(--border);
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        cursor: pointer;
      }

      .category-pill-active {
        background-color: var(--foreground);
        color: var(--background);
        border-color: var(--foreground);
      }
    </style>

    <style id="trending-grid-styles">
      .trending-grid-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 48px;
      }

      .trending-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 32px;
      }

      .trend-card {
        cursor: pointer;
      }

      .trend-image-wrap {
        width: 100%;
        aspect-ratio: 3/4;
        background-color: var(--secondary);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 20px;
        position: relative;
      }

      .trend-image-wrap::after {
        content: "";
        position: absolute;
        inset: 0;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-md);
        pointer-events: none;
      }

      .trend-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
      }

      .trend-info {
        padding: 0 4px;
      }

      .trend-title {
        font-size: 16px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin-bottom: 6px;
      }

      .trend-meta {
        font-size: 13px;
        font-weight: 500;
        color: var(--muted-foreground);
      }
    </style>

    <style id="promo-row-styles">
      .promo-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 32px;
      }

      .promo-card {
        background-color: var(--card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        padding: 48px 40px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        position: relative;
        overflow: hidden;
      }

      .promo-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, var(--primary), transparent);
        opacity: 0.7;
      }

      .promo-tag {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--primary);
      }

      .promo-title {
        font-size: 24px;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin: 0;
      }
    </style>

    <style id="masonry-section-styles">
      .masonry-section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 56px;
      }

      .masonry-grid {
        column-count: 3;
        column-gap: 32px;
      }

      .masonry-item {
        break-inside: avoid;
        margin-bottom: 40px;
        cursor: pointer;
      }

      .masonry-image-wrap {
        background-color: var(--secondary);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 20px;
        position: relative;
      }

      .masonry-image-wrap::after {
        content: "";
        position: absolute;
        inset: 0;
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-md);
        pointer-events: none;
      }

      .masonry-image-wrap img {
        width: 100%;
        display: block;
        object-fit: cover;
      }

      .masonry-cart-btn {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
        border-radius: var(--radius-sm);
        background-color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      }

      .masonry-info {
        padding: 0 4px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
      }

      .masonry-text {
        display: flex;
        flex-direction: column;
        gap: 6px;
      }

      .masonry-name {
        font-size: 16px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.02em;
      }

      .masonry-price {
        font-size: 15px;
        font-weight: 600;
        color: var(--muted-foreground);
      }
    </style>

    <style id="footer-styles">
      .footer {
        border-top: 1px solid var(--border);
        padding: 96px 0 48px 0;
        background-color: var(--background);
      }

      .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 64px;
        margin-bottom: 64px;
      }

      .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 24px;
      }

      .footer-desc {
        color: var(--muted-foreground);
        font-size: 15px;
        line-height: 1.6;
        max-width: 380px;
        margin: 0;
      }

      .footer-title {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin: 0 0 24px 0;
        color: var(--foreground);
      }

      .footer-links {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .footer-link {
        font-size: 14px;
        font-weight: 500;
        color: var(--muted-foreground);
        cursor: pointer;
      }

      .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid var(--border);
        padding-top: 32px;
        font-size: 13px;
        font-weight: 500;
        color: var(--muted-foreground);
      }
    </style>
  </head>

  <body>
    <header class="nav-wrapper">
      <div class="navbar container">
       <a href="/" class="nav-logo" data-media-type="banani-button">
        <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo" class="site-logo">
        </a>
        <nav class="nav-links">
          <div class="nav-link nav-link-active" data-media-type="banani-button">
            Home
          </div>
          <div class="nav-link" data-media-type="banani-button">Men</div>
          <div class="nav-link" data-media-type="banani-button">Women</div>
          <div class="nav-link" data-media-type="banani-button">
            Limited Drops
          </div>
          <div class="nav-link" data-media-type="banani-button">Stories</div>
        </nav>
        <div class="nav-actions">
          <div class="nav-icon" data-media-type="banani-button">
            <iconify-icon icon="lucide:search" style="font-size: 20px; color: var(--foreground)"></iconify-icon>
          </div>
          <div class="nav-icon" data-media-type="banani-button">
            <iconify-icon icon="lucide:user" style="font-size: 20px; color: var(--foreground)"></iconify-icon>
          </div>
          <div class="nav-icon" data-media-type="banani-button">
            <iconify-icon icon="lucide:shopping-bag" style="font-size: 20px; color: var(--foreground)"></iconify-icon>
            <div class="nav-cart-badge">3</div>
          </div>
          <!-- theme toggle -->
          <div class="nav-icon" id="theme-toggle" data-media-type="banani-button">
            <!-- icon updated via script -->
          </div>
        </div>
      </div>
    </header>

    <main>
      <!-- Hero -->
      <section class="hero">
        <div class="container hero-inner">
          <div class="hero-content">
            <div class="hero-badge">
              <div class="hero-badge-dot"></div>
              New Drop · Electric City
            </div>
            <h1 class="heading-xl hero-title-accent">
              Street <span>Ink</span><br />
              Reloaded
            </h1>
            <p class="hero-desc">
              High-voltage graphic tees engineered for all-day wear.
              Hand-drawn ink, lightning-fast delivery, and silhouettes built
              for the streets.
            </p>
            <div class="hero-actions">
              <button class="btn" data-media-type="banani-button">
                <div style="display: flex; align-items: center; gap: 12px">
                  <iconify-icon icon="lucide:zap"
                    style="font-size: 18px; color: var(--primary-foreground)"></iconify-icon>
                  Shop Lightning Fast
                </div>
              </button>
              <button class="btn btn-outline" data-media-type="banani-button">
                Lookbook
              </button>
            </div>
            <div class="hero-metrics">
              <div class="metric">
                <span class="metric-value">+10k</span>
                <span class="metric-label">Orders Shipped</span>
              </div>
              <div class="metric">
                <span class="metric-value">24hr</span>
                <span class="metric-label">Dispatch Time</span>
              </div>
              <div class="metric">
                <span class="metric-value">4.9</span>
                <span class="metric-label">Collector Rating</span>
              </div>
            </div>
          </div>
          <div class="hero-visual">
            <div class="hero-image-frame">
              <img data-aspect-ratio="4:5"
                data-query="cool urban model wearing highly detailed artistic graphic t-shirt in mid-action, digital ink splatters, faint lightning bolts, stark black background, pale pastel yellow accents, dribbble style ui ux high detail 8k resolution fashion photography"
                alt="Rapid Ink hero model"
                src="https://storage.googleapis.com/banani-generated-images/generated-images/eeab8140-ce1a-498f-8057-0719f228e595.jpg" />
            </div>
            <div class="hero-tagline">All-New Graphic Tee Series</div>
            <div class="hero-floating-card">
              <span class="hero-floating-title">Now Streaming From</span>
              <span class="hero-floating-value">The Digital Underground</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Category Strip -->
      <section class="category-strip">
        <div class="container category-row">
          <div class="category-label">Browse Rapid Ink</div>
          <div class="category-pills">
            <div class="category-pill category-pill-active" data-media-type="banani-button">
              All Tees
            </div>
            <div class="category-pill" data-media-type="banani-button">
              Oversized
            </div>
            <div class="category-pill" data-media-type="banani-button">
              Graphic Packs
            </div>
            <div class="category-pill" data-media-type="banani-button">
              New This Week
            </div>
            <div class="category-pill" data-media-type="banani-button">
              Under $50
            </div>
          </div>
          <button class="btn-link" data-media-type="banani-button">
            View All
            <iconify-icon icon="lucide:arrow-right" style="font-size: 16px; margin-left: 6px"></iconify-icon>
          </button>
        </div>
      </section>

      <!-- Trending Section -->
      <section class="section-padding">
        <div class="container">
          <div class="trending-grid-header">
            <div>
              <h2 class="heading-lg">
                Trending <span class="text-accent">Now</span>
              </h2>
              <p class="text-muted" style="margin-top: 12px">
                Pieces the community is spinning on repeat this week.
              </p>
            </div>
            <button class="btn btn-outline" data-media-type="banani-button">
              View Full Drop
            </button>
          </div>
          <div class="trending-grid">
            <article class="trend-card" data-media-type="banani-button">
              <div class="trend-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="streetwear model in motion wearing black graphic t-shirt, urban rooftop at night, glowing lightning motif, dark background, highly detailed"
                  alt="Kinetic Bolt Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/ae80b70c-eaaf-4991-bd0e-ae502703515a.jpg" />
              </div>
              <div class="trend-info">
                <div class="trend-title">Kinetic Bolt Tee</div>
                <div class="trend-meta">New · Heavyweight Fit</div>
              </div>
            </article>
            <article class="trend-card" data-media-type="banani-button">
              <div class="trend-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="perfectly folded stack of designer graphic t-shirts on wooden chair, black and pastel yellow palette, high end e-commerce photography"
                  alt="Ink Stack Pack"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/cf18783d-a03e-4e4a-9a59-6c4b465b0e13.jpg" />
              </div>
              <div class="trend-info">
                <div class="trend-title">Ink Stack Pack</div>
                <div class="trend-meta">Bundle · Save 20%</div>
              </div>
            </article>
            <article class="trend-card" data-media-type="banani-button">
              <div class="trend-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="close-up macro shot of highly detailed graphic print on t-shirt fabric, edgy brush stroke typography, lightning strikes, vivid yellow on black"
                  alt="Brush Script Series"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/53b3607e-db25-42f2-8448-f2af46e2e3dd.jpg" />
              </div>
              <div class="trend-info">
                <div class="trend-title">Brush Script Series</div>
                <div class="trend-meta">Artist Collab</div>
              </div>
            </article>
            <article class="trend-card" data-media-type="banani-button">
              <div class="trend-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="minimalist metal clothing rack with hanging graphic t-shirts, dark atmospheric studio, pale yellow accent lighting, premium aesthetic"
                  alt="Rack of Tees"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/c903ead5-eeb0-4bd1-a122-330dfebd7296.jpg" />
              </div>
              <div class="trend-info">
                <div class="trend-title">Midnight Rail</div>
                <div class="trend-meta">Back In Stock</div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- Promo Row -->
      <section class="section-padding" style="padding-top: 0">
        <div class="container promo-row">
          <div class="promo-card" data-media-type="banani-button">
            <span class="promo-tag">Special Offer</span>
            <h3 class="promo-title">Buy 2 Oversized Tees</h3>
            <p class="text-muted">
              Get flat 15% off on your cart when you mix and match any of our
              signature oversized fits.
            </p>
          </div>
          <div class="promo-card" data-media-type="banani-button">
            <span class="promo-tag">Essentials</span>
            <h3 class="promo-title">Bottomwear Under $80</h3>
            <p class="text-muted">
              Complete the look. Pair your favorite graphic tee with our
              heavyweight joggers and utility cargos.
            </p>
          </div>
          <div class="promo-card" data-media-type="banani-button">
            <span class="promo-tag">Fast Lane</span>
            <h3 class="promo-title">Lightning Fast Shipping</h3>
            <p class="text-muted">
              Zero downtime. Enjoy express 24-hour dispatch on all orders with
              priority stealth packing.
            </p>
          </div>
        </div>
      </section>

      <!-- Masonry Product Showcase -->
      <section class="section-padding" style="padding-top: 40px">
        <div class="container">
          <div class="masonry-section-header">
            <div>
              <h2 class="heading-lg">
                Latest <span class="text-accent">Drops</span>
              </h2>
              <p class="text-muted" style="margin-top: 12px; max-width: 600px">
                Curated tees infused with digital ink splatters and
                high-voltage lightning motifs. Grab them before they fade into
                the static.
              </p>
            </div>
            <button class="btn btn-outline" data-media-type="banani-button">
              View Collection
            </button>
          </div>

          <div class="masonry-grid">
            <!-- Item 1 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="flat lay of black designer t-shirt featuring vivid digital ink splatters and lightning bolts, surrounded by textured dark concrete background, pastel yellow accents"
                  alt="Thunder Glyph Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/9209bf26-eaac-48d7-a530-5355c6803043.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Thunder Glyph Tee</div>
                  <div class="masonry-price">$45.00</div>
                </div>
              </div>
            </article>

            <!-- Item 2 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="4:5"
                  data-query="edgy streetwear model mid-jump wearing black graphic t-shirt, artistic motion blur, lightning bolts, dark cyberpunk street background"
                  alt="Voltage Leap Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/580e94b4-4285-4625-b6ff-7d95ce1bb630.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Voltage Leap Tee</div>
                  <div class="masonry-price">$52.00</div>
                </div>
              </div>
            </article>

            <!-- Item 3 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="1:1"
                  data-query="extreme close up of edgy brush stroke typography printed on premium black cotton fabric, pale yellow ink, high fidelity texture"
                  alt="Brush Chaos Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/2011c442-1c48-49ae-9e54-c48254fd0843.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Brush Chaos Tee</div>
                  <div class="masonry-price">$40.00</div>
                </div>
              </div>
            </article>

            <!-- Item 4 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="single black graphic t-shirt hanging on thick metal hanger, dark atmospheric studio, dramatic spotlight, glowing lightning emblem on chest"
                  alt="Signal Line Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/f39be664-98ba-4195-9b7f-e5c395cc0e6d.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Signal Line Tee</div>
                  <div class="masonry-price">$38.00</div>
                </div>
              </div>
            </article>

            <!-- Item 5 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="4:5"
                  data-query="neat stack of folded streetwear t-shirts showing edgy graphic prints on edges, black and pastel yellow theme, wooden desk, dark background"
                  alt="Static Stack Pack"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/43fc10f1-9bea-4109-9163-db7ef97c7741.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Static Stack Pack</div>
                  <div class="masonry-price">$110.00</div>
                </div>
              </div>
            </article>

            <!-- Item 6 -->
            <article class="masonry-item" data-media-type="banani-button">
              <div class="masonry-image-wrap">
                <img data-aspect-ratio="3:4"
                  data-query="cool streetwear model leaning on metal railing at night, wearing black oversized graphic tee featuring glowing neon yellow abstract print, cinematic lighting"
                  alt="Neon Rail Tee"
                  src="https://storage.googleapis.com/banani-generated-images/generated-images/8ec35f28-990c-46ed-918f-16703ddc7257.jpg" />
                <div class="masonry-cart-btn">
                  <iconify-icon icon="lucide:shopping-cart"
                    style="font-size: 20px; color: var(--primary-foreground)"></iconify-icon>
                </div>
              </div>
              <div class="masonry-info">
                <div class="masonry-text">
                  <div class="masonry-name">Neon Rail Tee</div>
                  <div class="masonry-price">$55.00</div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
        <div class="container">
          <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="nav-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo" class="site-logo">
                </a>
              <p class="footer-desc">
                Rapid Ink blends digital artistry with premium fabrics to
                deliver tees that feel as sharp as they look. Built for city
                nights and everyday motion.
              </p>
              <div style="display: flex; gap: 20px; margin-top: 8px">
                <div class="nav-icon" data-media-type="banani-button">
                  <iconify-icon icon="lucide:instagram"
                    style="font-size: 24px; color: var(--foreground)"></iconify-icon>
                </div>
                <div class="nav-icon" data-media-type="banani-button">
                  <iconify-icon icon="lucide:twitter" style="font-size: 24px; color: var(--foreground)"></iconify-icon>
                </div>
              </div>
            </div>
            <div>
              <h4 class="footer-title">Shop</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">
                  All Tees
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Oversized Fits
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Artist Collabs
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Bundles
                </div>
              </div>
            </div>
            <div>
              <h4 class="footer-title">Help</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">
                  Shipping &amp; Returns
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Size Guide
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Track Order
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  FAQ
                </div>
              </div>
            </div>
            <div>
              <h4 class="footer-title">About</h4>
              <div class="footer-links">
                <div class="footer-link" data-media-type="banani-button">
                  Our Story
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Careers
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Contact
                </div>
                <div class="footer-link" data-media-type="banani-button">
                  Legal
                </div>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <span>© 2025 Rapid Ink. All rights reserved.</span>
            <span>High-voltage apparel · Designed for motion.</span>
          </div>
        </div>
      </footer>
    </main>
  </body>

  </html>
  <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
  <style>
    /* light-theme is the default (root) */
    :root {
      --background: #ffffff;
      --foreground: #000000;
      --border: #00000014;
      --input: #f0f0f0;
      --primary: #000000;
      --primary-foreground: #ffffff;
      --secondary: #f5f5f5;
      --secondary-foreground: #333333;
      --muted: #f7f7f7;
      --muted-foreground: #888888;
      --success: #1db954;
      --success-foreground: #ffffff;
      --accent: #ffdd57;
      --accent-foreground: #000000;
      --destructive: #ff4d4f;
      --destructive-foreground: #ffffff;
      --warning: #ffb020;
      --warning-foreground: #000000;
      --card: #ffffff;
      --card-foreground: #000000;
      --sidebar: #f9f9f9;
      --sidebar-foreground: #333333;
      --sidebar-primary: #eaeaea;
      --sidebar-primary-foreground: #000000;
      --radius-sm: 4px;
      --radius-md: 6px;
      --radius-lg: 8px;
      --radius-xl: 12px;
      --font-family-body: Inter;
    }

    /* dark theme overrides */
    [data-theme="dark"] {
      --background: #000000;
      --foreground: #ffffff;
      --border: #00000014;
      --input: #0d0d0d;
      --primary: #fff5b8;
      --primary-foreground: #000000;
      --secondary: #141414;
      --secondary-foreground: #ededed;
      --muted: #0b0b0b;
      --muted-foreground: #9b9b9b;
      --success: #1db954;
      --success-foreground: #ffffff;
      --accent: #fff1a8;
      --accent-foreground: #000000;
      --destructive: #ff4d4f;
      --destructive-foreground: #ffffff;
      --warning: #ffb020;
      --warning-foreground: #000000;
      --card: #0b0b0b;
      --card-foreground: #f7f7f7;
      --sidebar: #090909;
      --sidebar-foreground: #dcdcdc;
      --sidebar-primary: #232323;
      --sidebar-primary-foreground: #fff8df;
    }
  </style>

  <script>
    (function () {
      const stored = localStorage.getItem('theme');
      // always default to light unless user saved a preference
      let theme = stored || 'light';
      document.documentElement.setAttribute('data-theme', theme);

      const toggle = document.getElementById('theme-toggle');
      function updateIcon(current) {
        if (!toggle) return;
        if (current === 'dark') {
          toggle.innerHTML = '<iconify-icon icon="lucide:sun" style="font-size:20px; color:var(--foreground)"></iconify-icon>';
        } else {
          toggle.innerHTML = '<iconify-icon icon="lucide:moon" style="font-size:20px; color:var(--foreground)"></iconify-icon>';
        }
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
  </script>
</div>