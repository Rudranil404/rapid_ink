@extends('layouts.admin')

@section('page_title', 'Edit Product')

@section('content')
    <style>
        .form-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px; }
        .form-card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); }
        .form-label { font-size: 13px; font-weight: 600; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; }
        .form-control, .form-select { background-color: #f9fafb; border: 1px solid #d1d5db; padding: 12px 16px; font-size: 14px; border-radius: 8px; }
        .form-control:focus, .form-select:focus { background-color: #ffffff; border-color: var(--brand-color); box-shadow: 0 0 0 3px rgba(0,0,0,0.1); }
        .upload-zone { border: 2px dashed #d1d5db; border-radius: 12px; padding: 40px 20px; text-align: center; background-color: #f9fafb; cursor: pointer; transition: all 0.2s; }
        .upload-zone:hover { border-color: var(--brand-color); background-color: #f3f4f6; }
        .upload-icon { font-size: 40px; color: #9ca3af; margin-bottom: 12px; }
        .variant-checkbox { display: inline-block; margin-right: 10px; margin-bottom: 10px; }
        .variant-checkbox input[type="checkbox"] { display: none; }
        .variant-checkbox label { border: 1px solid #d1d5db; border-radius: 6px; padding: 8px 16px; cursor: pointer; font-weight: 600; font-size: 13px; transition: all 0.2s; background-color: #ffffff; }
        .variant-checkbox input[type="checkbox"]:checked + label { background-color: #000000; color: #ffffff; border-color: #000000; }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light border p-2" title="Go Back">
                <iconify-icon icon="lucide:arrow-left" style="font-size: 18px;"></iconify-icon>
            </a>
            <h4 class="fw-bold mb-0">Edit Product: {{ $product->name }}</h4>
        </div>
        <div>
            <button type="submit" form="productForm" class="btn btn-brand d-flex align-items-center gap-2">
                <iconify-icon icon="lucide:save"></iconify-icon> Update Product
            </button>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4 rounded-3 border-0 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="productForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="form-card">
                    <div class="form-card-title">Basic Information</div>
                    
                    <div class="mb-4">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title d-flex justify-content-between align-items-center">
                        <span>Media Gallery</span>
                        <span class="badge bg-light text-muted border">Max 10 Images</span>
                    </div>
                    
                    @if(!empty($product->images))
                        <div class="mb-3 p-3 bg-light rounded border d-flex gap-2 overflow-auto">
                            @foreach($product->images as $img)
                                <img src="{{ asset('storage/'.$img) }}" height="80" class="rounded border">
                            @endforeach
                        </div>
                        <p class="text-muted small">Uploading new images will replace the current ones.</p>
                    @endif

                    <div class="upload-zone" onclick="document.getElementById('fileInput').click()">
                        <iconify-icon icon="lucide:image-plus" class="upload-icon"></iconify-icon>
                        <h6 class="fw-bold">Click to upload new images</h6>
                        <input type="file" id="fileInput" name="images[]" multiple accept="image/*" class="d-none" max="10">
                    </div>
                    <div id="imagePreviewContainer" class="d-flex gap-2 mt-3 flex-wrap"></div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Variants & Attributes</div>
                    
                    @php 
                        $selectedSizes = is_array($product->sizes) ? $product->sizes : []; 
                        $selectedColors = is_array($product->colors) ? $product->colors : []; 
                    @endphp

                    <div class="mb-4">
                        <label class="form-label d-block mb-3">Available Sizes</label>
                        @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <div class="variant-checkbox">
                                <input type="checkbox" id="size-{{ strtolower($size) }}" name="sizes[]" value="{{ $size }}" {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                <label for="size-{{ strtolower($size) }}">{{ $size }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <label class="form-label d-block mb-3">Available Colors</label>
                        @foreach(['Black', 'White', 'Heather Gray', 'Custom'] as $color)
                            <div class="variant-checkbox">
                                <input type="checkbox" id="color-{{ Str::slug($color) }}" name="colors[]" value="{{ $color }}" {{ in_array($color, $selectedColors) ? 'checked' : '' }}>
                                <label for="color-{{ Str::slug($color) }}">{{ $color }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-card">
                    <div class="form-card-title">Pricing & Inventory</div>
                    <div class="mb-4">
                        <label class="form-label">Base Price ($) *</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 fw-bold">$</span>
                            <input type="number" name="price" class="form-control border-start-0 ps-0" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Quantity in Stock *</label>
                        <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $product->stock) }}" required>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Organization</div>
                    <div class="mb-4">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="T-Shirts" {{ $product->category == 'T-Shirts' ? 'selected' : '' }}>T-Shirts</option>
                            <option value="Hoodies" {{ $product->category == 'Hoodies' ? 'selected' : '' }}>Hoodies</option>
                            <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="Bottoms" {{ $product->category == 'Bottoms' ? 'selected' : '' }}>Bottoms</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Product Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active (Visible)</option>
                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-light">
                        <div>
                            <div class="fw-bold" style="font-size: 14px;">Trending Product</div>
                            <div class="text-muted" style="font-size: 12px;">Highlight on homepage</div>
                        </div>
                        <div class="form-check form-switch fs-4 mb-0">
                            <input class="form-check-input" type="checkbox" role="switch" name="is_trending" value="1" {{ $product->is_trending ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = ''; 
            const files = e.target.files;
            if(files.length > 0) {
                const badge = document.createElement('span');
                badge.className = 'badge bg-dark px-3 py-2 mt-2';
                badge.textContent = files.length + ' new file(s) selected to replace old ones.';
                container.appendChild(badge);
            }
        });
    </script>
@endsection