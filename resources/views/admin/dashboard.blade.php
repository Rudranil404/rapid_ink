@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
    <style>
        .stat-card { padding: 24px; display: flex; align-items: center; gap: 20px; background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);}
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--brand-color); }
        .stat-value { font-size: 28px; font-weight: 800; line-height: 1.2; }
        .stat-label { font-size: 13px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; }
    </style>

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
                    <div class="stat-value">{{ $productCount ?? 0 }}</div>
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
    
    @endsection