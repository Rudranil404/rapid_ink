@extends('layouts.admin')

@section('page_title', 'Products Management')

@section('content')
    <style>
        .table-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); overflow: hidden; }
        .table thead th { background-color: #f9fafb; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; padding: 16px 24px; border-bottom: 1px solid var(--border-color); }
        .table tbody td { padding: 16px 24px; vertical-align: middle; font-size: 14px; font-weight: 500; border-bottom: 1px solid var(--border-color); }
        .product-img { width: 40px; height: 40px; border-radius: 6px; object-fit: cover; background-color: #f3f4f6; }
        .badge-trending { background-color: #fef08a; color: #854d0e; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">All Products</h5>
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
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($products) && count($products) > 0)
                    @foreach($products as $product)
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
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if($product->status == 'active')
                                    <span class="badge bg-success text-white border">Active</span>
                                @else
                                    <span class="badge bg-secondary text-white border">Draft</span>
                                @endif
                                
                                @if($product->is_trending)
                                    <span class="badge-trending ms-1">Trending</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.products.toggle-trending', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm border me-1 {{ $product->is_trending ? 'bg-warning text-dark border-warning' : 'btn-light text-muted' }}" title="{{ $product->is_trending ? 'Remove from Trending' : 'Mark as Trending' }}">
                                        <iconify-icon icon="lucide:flame" style="font-size: 16px; position: relative; top: 2px;"></iconify-icon>
                                    </button>
                                </form>

                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light border me-1" title="Edit">
                                    <iconify-icon icon="lucide:edit-2" style="font-size: 16px; position: relative; top: 2px;"></iconify-icon>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                        <iconify-icon icon="lucide:trash-2" style="font-size: 16px; position: relative; top: 2px;"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <iconify-icon icon="lucide:package-open" style="font-size: 32px; margin-bottom: 10px;"></iconify-icon>
                            <p class="mb-0">No products found. Start by adding your first product!</p>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-brand mt-3">Add Product</a>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection