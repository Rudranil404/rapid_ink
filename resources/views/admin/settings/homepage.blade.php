@extends('layouts.admin')

@section('page_title', 'Storefront Editor')

@section('content')
    <style>
        .form-card { background-color: #ffffff; border: 1px solid var(--border-color); border-radius: 12px; padding: 24px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px; }
        .form-card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Home Page Content</h4>
        <button type="submit" form="homepageForm" class="btn btn-brand d-flex align-items-center gap-2">
            <iconify-icon icon="lucide:save"></iconify-icon> Save Changes
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form id="homepageForm" action="{{ route('admin.settings.homepage.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            <div class="col-12 col-lg-8">
                
                <div class="form-card">
                    <div class="form-card-title">
                        <span><iconify-icon icon="lucide:images" class="me-2"></iconify-icon> Hero Carousel Setup</span>
                        <span class="badge bg-dark">3 Slides</span>
                    </div>

                    <div class="border rounded p-3 mb-4 bg-light">
                        <h6 class="fw-bold mb-3">Slide 1 (Primary)</h6>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                            <input type="text" name="slide1_headline" class="form-control" value="{{ $settings['slide1_headline'] ?? 'Premium Threads for the Bold' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                            <input type="text" name="slide1_subtext" class="form-control" value="{{ $settings['slide1_subtext'] ?? 'Discover the latest collection of high-quality tees.' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                            @if(isset($settings['slide1_image']))
                                <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide1_image']) }}" height="60" class="rounded"></div>
                            @endif
                            <input type="file" name="slide1_image" class="form-control bg-white" accept="image/*">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                <input type="text" name="slide1_btn_text" class="form-control" value="{{ $settings['slide1_btn_text'] ?? 'Shop The Collection' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                <input type="text" name="slide1_btn_link" class="form-control" value="{{ $settings['slide1_btn_link'] ?? '#trending' }}">
                            </div>
                        </div>
                    </div>

                    <div class="border rounded p-3 mb-4 bg-light">
                        <h6 class="fw-bold mb-3">Slide 2</h6>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                            <input type="text" name="slide2_headline" class="form-control" value="{{ $settings['slide2_headline'] ?? 'Summer Essentials' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                            <input type="text" name="slide2_subtext" class="form-control" value="{{ $settings['slide2_subtext'] ?? 'Stay cool with our breathable fabrics.' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                            @if(isset($settings['slide2_image']))
                                <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide2_image']) }}" height="60" class="rounded"></div>
                            @endif
                            <input type="file" name="slide2_image" class="form-control bg-white" accept="image/*">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                <input type="text" name="slide2_btn_text" class="form-control" value="{{ $settings['slide2_btn_text'] ?? 'Explore Now' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                <input type="text" name="slide2_btn_link" class="form-control" value="{{ $settings['slide2_btn_link'] ?? '#trending' }}">
                            </div>
                        </div>
                    </div>

                    <div class="border rounded p-3 bg-light">
                        <h6 class="fw-bold mb-3">Slide 3</h6>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Headline</label>
                            <input type="text" name="slide3_headline" class="form-control" value="{{ $settings['slide3_headline'] ?? 'Limited Edition Drops' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Subtext</label>
                            <input type="text" name="slide3_subtext" class="form-control" value="{{ $settings['slide3_subtext'] ?? 'Once they\'re gone, they\'re gone forever.' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Background Image</label>
                            @if(isset($settings['slide3_image']))
                                <div class="mb-2"><img src="{{ asset('storage/'.$settings['slide3_image']) }}" height="60" class="rounded"></div>
                            @endif
                            <input type="file" name="slide3_image" class="form-control bg-white" accept="image/*">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Text</label>
                                <input type="text" name="slide3_btn_text" class="form-control" value="{{ $settings['slide3_btn_text'] ?? 'Shop Limited' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold text-uppercase">Button Link</label>
                                <input type="text" name="slide3_btn_link" class="form-control" value="{{ $settings['slide3_btn_link'] ?? '#trending' }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-card">
                    <div class="form-card-title">Announcement Bar</div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Promo Text</label>
                        <input type="text" name="promo_text" class="form-control" value="{{ $settings['promo_text'] ?? '🔥 FREE Worldwide Shipping on Orders Over $75!' }}">
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection