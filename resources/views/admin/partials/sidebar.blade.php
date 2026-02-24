<aside style="width: 260px; height: 100vh; position: fixed; left: 0; top: 0; background-color: #1f2937; color: white; display: flex; flex-direction: column; box-shadow: 4px 0 10px rgba(0,0,0,0.1);">
    
    <div style="padding: 24px; font-size: 1.5rem; font-weight: bold; border-bottom: 1px solid #374151; display: flex; align-items: center; gap: 10px;">
        <span class="iconify" data-icon="mdi: ink-variant" style="color: #6366f1;"></span>
        Rapid Ink Admin
    </div>

    <nav style="flex-grow: 1; padding: 20px 0;">
        <ul style="list-style: none; padding: 0; margin: 0;">
            <li style="margin-bottom: 5px;">
                <a href="{{ route('admin.dashboard') }}" 
                   style="display: flex; align-items: center; padding: 12px 24px; text-decoration: none; color: {{ request()->routeIs('admin.dashboard') ? 'white' : '#9ca3af' }}; background-color: {{ request()->routeIs('admin.dashboard') ? '#374151' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.dashboard') ? '#6366f1' : 'transparent' }}; transition: all 0.2s;">
                    <span class="iconify" data-icon="mdi:view-dashboard" style="margin-right: 12px; font-size: 1.2rem;"></span>
                    Dashboard
                </a>
            </li>

            <li style="margin-bottom: 5px;">
                <a href="{{ route('admin.settings.homepage') }}" 
                   style="display: flex; align-items: center; padding: 12px 24px; text-decoration: none; color: {{ request()->routeIs('admin.settings.homepage') ? 'white' : '#9ca3af' }}; background-color: {{ request()->routeIs('admin.settings.homepage') ? '#374151' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.settings.homepage') ? '#6366f1' : 'transparent' }}; transition: all 0.2s;">
                    <span class="iconify" data-icon="mdi:home-cog" style="margin-right: 12px; font-size: 1.2rem;"></span>
                    Homepage Settings
                </a>
            </li>

            <li style="margin-bottom: 5px;">
                <a href="{{ route('admin.products.index') }}" 
                   style="display: flex; align-items: center; padding: 12px 24px; text-decoration: none; color: {{ request()->routeIs('admin.products.*') ? 'white' : '#9ca3af' }}; background-color: {{ request()->routeIs('admin.products.*') ? '#374151' : 'transparent' }}; border-left: 4px solid {{ request()->routeIs('admin.products.*') ? '#6366f1' : 'transparent' }}; transition: all 0.2s;">
                    <span class="iconify" data-icon="mdi:package-variant-closed" style="margin-right: 12px; font-size: 1.2rem;"></span>
                    Products
                </a>
            </li>
        </ul>
    </nav>

    <div style="padding: 20px; border-top: 1px solid #374151;">
        <a href="{{ route('home') }}" target="_blank" style="display: flex; align-items: center; color: #9ca3af; text-decoration: none; font-size: 0.9rem; margin-bottom: 15px;">
            <span class="iconify" data-icon="mdi:open-in-new" style="margin-right: 10px;"></span>
            View Storefront
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width: 100%; display: flex; align-items: center; background: none; border: none; color: #ef4444; cursor: pointer; padding: 0; font-size: 0.9rem;">
                <span class="iconify" data-icon="mdi:logout" style="margin-right: 10px;"></span>
                Logout
            </button>
        </form>
    </div>
</aside>