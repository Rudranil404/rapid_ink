@extends('layouts.admin')

@section('page_title', 'Storefront Editor')

@section('content')
    <style>
        .form-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px; }
        .form-card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .section-badge { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 4px 8px; border-radius: 4px; }
        .image-preview-box { width: 100%; height: 120px; background-color: #f3f4f6; border-radius: 8px; border: 1px dashed #d1d5db; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 12px; }
        .image-preview-box img { width: 100%; height: 100%; object-fit: cover; }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Home Page Content</h4>
        <button type="submit" form="homepageForm" class="btn btn-brand d-flex align-items-center gap-2">
            <iconify-icon icon="lucide:save"></iconify-icon> Save All Changes
        </button>
    </div>

    <!-- @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2">
            <iconify-icon icon="lucide:check-circle-2" style="font-size: 20px;"></iconify-icon>
            {{ session('success') }}
        </div>
    @endif -->

    <form id="homepageForm" action="{{ route('admin.settings.homepage.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            <div class="col-12 col-lg-8">
                
                @php
                    $maxSlide = 3;
                    foreach($settings as $key => $val) {
                        if (preg_match('/^slide(\d+)_/', $key, $matches)) {
                            $maxSlide = max($maxSlide, (int)$matches[1]);
                        }
                    }
                @endphp

                <div class="form-card">
                    <div class="form-card-title">
                        <span><iconify-icon icon="lucide:images" class="me-2"></iconify-icon> Hero Carousel Setup</span>
                        <span class="badge bg-dark section-badge" id="slide-count-badge">{{ $maxSlide }} Slides</span>
                    </div>

                    <input type="hidden" name="deleted_slides" id="deleted_slides" value="">

                    <ul class="nav nav-pills mb-3" id="hero-tabs" role="tablist">
                        @for($i = 1; $i <= $maxSlide; $i++)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $i == 1 ? 'active' : '' }}" id="tab-btn-{{$i}}" data-bs-toggle="pill" data-bs-target="#slide{{$i}}" type="button">Slide {{$i}}</button>
                            </li>
                        @endfor
                        <li class="nav-item" role="presentation" id="addSlideBtnContainer">
                            <button class="nav-link text-success fw-bold" id="addSlideBtn" type="button">
                                <iconify-icon icon="lucide:plus" class="me-1"></iconify-icon> Add Slide
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content border rounded p-4 bg-light" id="hero-tabContent">
                        @for($i = 1; $i <= $maxSlide; $i++)
                            <div class="tab-pane fade {{ $i == 1 ? 'show active' : '' }}" id="slide{{$i}}" role="tabpanel">
                                
                                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                                    <h6 class="fw-bold mb-0 text-muted">Slide {{$i}} Settings</h6>
                                    @if($i > 1)
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-slide-btn" data-slide-id="{{$i}}">
                                            <iconify-icon icon="lucide:trash-2" style="margin-right: 4px;"></iconify-icon> Delete Slide
                                        </button>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                                    <input type="text" name="slide{{$i}}_headline" class="form-control" value="{{ $settings['slide'.$i.'_headline'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                                    <input type="text" name="slide{{$i}}_subtext" class="form-control" value="{{ $settings['slide'.$i.'_subtext'] ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                                    @if(isset($settings['slide'.$i.'_image']))
                                        <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide'.$i.'_image']) }}" height="60" class="rounded border"></div>
                                    @endif
                                    <input type="file" name="slide{{$i}}_image" class="form-control bg-white" accept="image/*">
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                        <input type="text" name="slide{{$i}}_btn_text" class="form-control" value="{{ $settings['slide'.$i.'_btn_text'] ?? 'Shop Now' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                        <input type="text" name="slide{{$i}}_btn_link" class="form-control" value="{{ $settings['slide'.$i.'_btn_link'] ?? '/products' }}">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

   



                @php
                    // Calculate how many categories currently exist
                    $maxCat = 3; // Default minimum
                    foreach($settings as $key => $val) {
                        if (preg_match('/^cat(\d+)_/', $key, $matches)) {
                            $maxCat = max($maxCat, (int)$matches[1]);
                        }
                    }
                @endphp

                <div class="form-card">
                    <div class="form-card-title">
                        <span><iconify-icon icon="lucide:grid" class="me-2"></iconify-icon> Featured Categories</span>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary section-badge" id="cat-count-badge">{{ $maxCat }} Categories</span>
                            <button class="btn btn-sm btn-outline-dark d-flex align-items-center gap-1" id="addCatBtn" type="button" style="padding: 2px 8px; font-size: 12px;">
                                <iconify-icon icon="lucide:plus"></iconify-icon> Add
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" name="deleted_categories" id="deleted_categories" value="">

                    <div class="row g-4" id="categories-container">
                        @for($i = 1; $i <= $maxCat; $i++)
                            <div class="col-md-4 category-block" id="cat-block-{{$i}}">
                                <div class="p-3 border rounded bg-light position-relative">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold text-muted small">Category {{$i}}</span>
                                        <button type="button" class="btn btn-sm text-danger p-0 delete-cat-btn" data-cat-id="{{$i}}" title="Delete Category">
                                            <iconify-icon icon="lucide:x-circle" style="font-size: 18px;"></iconify-icon>
                                        </button>
                                    </div>
                                    <div class="image-preview-box">
                                        @if(isset($settings['cat'.$i.'_image']))
                                            <img src="{{ asset('storage/'.$settings['cat'.$i.'_image']) }}">
                                        @else
                                            <iconify-icon icon="lucide:image" style="font-size: 30px; color: #9ca3af;"></iconify-icon>
                                        @endif
                                    </div>
                                    <input type="file" name="cat{{$i}}_image" class="form-control form-control-sm mb-2" accept="image/*">
                                    <input type="text" name="cat{{$i}}_title" class="form-control form-control-sm mb-2" placeholder="Category Title" value="{{ $settings['cat'.$i.'_title'] ?? '' }}">
                                    <input type="text" name="cat{{$i}}_link" class="form-control form-control-sm" placeholder="Link (e.g., /category/tees)" value="{{ $settings['cat'.$i.'_link'] ?? '' }}">
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">
                        <span><iconify-icon icon="lucide:book-open" class="me-2"></iconify-icon> Brand Story Banner</span>
                        <span class="badge bg-secondary section-badge">Lower Section</span>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Heading</label>
                                <input type="text" name="brand_heading" class="form-control" value="{{ $settings['brand_heading'] ?? 'Crafted for the Culture' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold text-uppercase">Story Paragraph</label>
                                <textarea name="brand_text" class="form-control" rows="4">{{ $settings['brand_text'] ?? 'Rapid Ink was born out of a desire to blend street culture with premium quality fabrics. Every piece is designed with intention.' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-bold text-uppercase">Side Image</label>
                            <div class="image-preview-box" style="height: 140px;">
                                @if(isset($settings['brand_image']))
                                    <img src="{{ asset('storage/'.$settings['brand_image']) }}">
                                @else
                                    <iconify-icon icon="lucide:image" style="font-size: 30px; color: #9ca3af;"></iconify-icon>
                                @endif
                            </div>
                            <input type="file" name="brand_image" class="form-control form-control-sm mt-2" accept="image/*">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 col-lg-4">
                
                <div class="form-card">
                    <div class="form-card-title">General Settings</div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Website Title</label>
                        <input type="text" name="site_title" class="form-control" value="{{ $settings['site_title'] ?? 'Rapid Ink | Premium Apparel' }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small fw-bold text-uppercase">Home Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3" placeholder="For SEO purposes...">{{ $settings['meta_description'] ?? 'Shop the latest premium streetwear and heavyweight tees at Rapid Ink.' }}</textarea>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Announcement Bar</div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Promo Text</label>
                        <input type="text" name="promo_text" class="form-control" value="{{ $settings['promo_text'] ?? '🔥 FREE Worldwide Shipping on Orders Over $75!' }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small fw-bold text-uppercase">Promo Link (Optional)</label>
                        <input type="text" name="promo_link" class="form-control" value="{{ $settings['promo_link'] ?? '/products' }}">
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-title">Dynamic Product Rows</div>
                    <p class="text-muted small mb-3">These titles appear above the product grids that are generated automatically from your inventory.</p>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Trending Section Title</label>
                        <input type="text" name="trending_title" class="form-control" value="{{ $settings['trending_title'] ?? 'Trending Now' }}">
                    </div>
                    
                    <div class="mb-0">
                        <label class="form-label text-muted small fw-bold text-uppercase">New Arrivals Title</label>
                        <input type="text" name="new_arrivals_title" class="form-control" value="{{ $settings['new_arrivals_title'] ?? 'Fresh Drops' }}">
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track the highest ID to prevent element ID collisions when adding/deleting
            let highestSlideId = {{ $maxSlide }};
            const addBtn = document.getElementById('addSlideBtn');
            const tabList = document.getElementById('hero-tabs');
            const tabContent = document.getElementById('hero-tabContent');
            const badge = document.getElementById('slide-count-badge');
            const deletedInput = document.getElementById('deleted_slides');
            // --- CATEGORY LOGIC ---
            let highestCatId = {{ $maxCat }};
            const addCatBtn = document.getElementById('addCatBtn');
            const catContainer = document.getElementById('categories-container');
            const catBadge = document.getElementById('cat-count-badge');
            const deletedCatInput = document.getElementById('deleted_categories');

            function updateCatBadge() {
                const visibleCats = document.querySelectorAll('.category-block').length;
                catBadge.textContent = visibleCats + ' Categories';
            }

            addCatBtn.addEventListener('click', function(e) {
                e.preventDefault();
                highestCatId++;
                let i = highestCatId;

                let newCat = document.createElement('div');
                newCat.className = 'col-md-4 category-block';
                newCat.id = `cat-block-${i}`;
                newCat.innerHTML = `
                    <div class="p-3 border rounded bg-light position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-muted small">Category ${i}</span>
                            <button type="button" class="btn btn-sm text-danger p-0 delete-cat-btn" data-cat-id="${i}" title="Delete Category">
                                <iconify-icon icon="lucide:x-circle" style="font-size: 18px;"></iconify-icon>
                            </button>
                        </div>
                        <div class="image-preview-box">
                            <iconify-icon icon="lucide:image" style="font-size: 30px; color: #9ca3af;"></iconify-icon>
                        </div>
                        <input type="file" name="cat${i}_image" class="form-control form-control-sm mb-2" accept="image/*">
                        <input type="text" name="cat${i}_title" class="form-control form-control-sm mb-2" placeholder="Category Title">
                        <input type="text" name="cat${i}_link" class="form-control form-control-sm" placeholder="Link URL">
                    </div>
                `;
                catContainer.appendChild(newCat);
                updateCatBadge();
            });

            document.addEventListener('click', function(e) {
                const deleteCatBtn = e.target.closest('.delete-cat-btn');
                if (deleteCatBtn) {
                    if (confirm('Delete this category?')) {
                        const catId = deleteCatBtn.getAttribute('data-cat-id');
                        
                        let currentDeleted = deletedCatInput.value ? deletedCatInput.value.split(',') : [];
                        if (!currentDeleted.includes(catId)) {
                            currentDeleted.push(catId);
                            deletedCatInput.value = currentDeleted.join(',');
                        }

                        const catBlock = document.getElementById(`cat-block-${catId}`);
                        if(catBlock) catBlock.remove();
                        
                        updateCatBadge();
                    }
                }
            });

            function updateBadgeCount() {
                const visibleSlides = document.querySelectorAll('#hero-tabs .nav-item:not(#addSlideBtnContainer)').length;
                badge.textContent = visibleSlides + ' Slides';
            }

            // --- ADD SLIDE LOGIC ---
            addBtn.addEventListener('click', function(e) {
                e.preventDefault();
                highestSlideId++;
                let i = highestSlideId;

                // Create new Tab Button
                let newLi = document.createElement('li');
                newLi.className = 'nav-item';
                newLi.setAttribute('role', 'presentation');
                newLi.innerHTML = `<button class="nav-link" id="tab-btn-${i}" data-bs-toggle="pill" data-bs-target="#slide${i}" type="button">Slide ${i}</button>`;
                tabList.insertBefore(newLi, document.getElementById('addSlideBtnContainer'));

                // Create new Tab Content Area
                let newPane = document.createElement('div');
                newPane.className = 'tab-pane fade';
                newPane.id = `slide${i}`;
                newPane.setAttribute('role', 'tabpanel');
                newPane.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <h6 class="fw-bold mb-0 text-muted">Slide ${i} Settings</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-slide-btn" data-slide-id="${i}">
                            <iconify-icon icon="lucide:trash-2" style="margin-right: 4px;"></iconify-icon> Delete Slide
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                        <input type="text" name="slide${i}_headline" class="form-control" placeholder="New Slide Headline">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                        <input type="text" name="slide${i}_subtext" class="form-control" placeholder="New Slide Subtext">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                        <input type="file" name="slide${i}_image" class="form-control bg-white" accept="image/*">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                            <input type="text" name="slide${i}_btn_text" class="form-control" value="Shop Now">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                            <input type="text" name="slide${i}_btn_link" class="form-control" value="/products">
                        </div>
                    </div>
                `;
                tabContent.appendChild(newPane);
                
                // Automatically activate the new tab
                newLi.querySelector('button').click();
                updateBadgeCount();
            });

            // --- DELETE SLIDE LOGIC ---
            // We use Event Delegation because delete buttons can be dynamically created
            document.addEventListener('click', function(e) {
                const deleteBtn = e.target.closest('.delete-slide-btn');
                if (deleteBtn) {
                    if (confirm('Are you sure you want to delete this slide? It will be permanently removed upon saving.')) {
                        const slideId = deleteBtn.getAttribute('data-slide-id');
                        
                        // 1. Add ID to hidden input for backend to process
                        let currentDeleted = deletedInput.value ? deletedInput.value.split(',') : [];
                        if (!currentDeleted.includes(slideId)) {
                            currentDeleted.push(slideId);
                            deletedInput.value = currentDeleted.join(',');
                        }

                        // 2. Remove Tab and Content from Screen
                        const tabBtn = document.getElementById(`tab-btn-${slideId}`);
                        if(tabBtn) tabBtn.closest('li').remove();
                        
                        const tabPane = document.getElementById(`slide${slideId}`);
                        if(tabPane) tabPane.remove();

                        // 3. Fallback to Slide 1 so the UI doesn't look empty
                        const slide1Btn = document.getElementById('tab-btn-1');
                        if(slide1Btn) slide1Btn.click();
                        
                        updateBadgeCount();
                    }
                }
            });
        });
    </script>