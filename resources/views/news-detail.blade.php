@extends('layouts.landing')
@section('content')

<style>
    .news-detail-container {
        max-width: 840px;
        margin: 0 auto;
    }

    .news-detail-card {
        background: #ffffff !important;
        border: 1px solid #ebebeb !important;
        border-radius: 12px !important;
        padding: 45px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02) !important;
    }

    .news-detail-title {
        font-size: 2.25rem !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        color: #1a1a1a !important;
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .author-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f1f1f1;
        margin-bottom: 2rem;
    }

    .author-avatar {
        width: 42px;
        height: 42px;
        background-color: #fff2ee;
        color: #FF5722;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        font-weight: 700;
        border: 1px solid rgba(255, 87, 34, 0.15);
    }

    .author-meta {
        font-size: 0.82rem;
        color: #666666;
    }

    .category-tag {
        font-size: 0.8rem;
        color: #FF5722;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .article-main-image-container {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f8f9fa;
        margin-bottom: 2.5rem;
        border: 1px solid #ebebeb;
        text-align: center;
    }

    .article-main-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
    }

    .post-content-text {
        font-size: 1.05rem;
        line-height: 1.9;
        color: #333333;
        text-align: justify;
        white-space: pre-line;
        margin-bottom: 3rem;
    }

    .share-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #ffffff;
        color: #666666;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
        transition: all 0.2s ease-in-out;
        border: 1px solid #eaeaea;
        text-decoration: none;
    }

    .share-btn:hover {
        background-color: #FF5722;
        color: #ffffff;
        border-color: #FF5722;
        transform: translateY(-2px);
    }

    .back-link {
        color: #666666;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: color 0.2s ease-in-out;
    }

    .back-link:hover {
        color: #FF5722;
    }
</style>

<section id="landingNewsDetail" class="section-py" style="background-color: #f8f9fa;">
    <div class="container mt-10">
        <div class="row justify-content-center">
            <div class="col-lg-12 news-detail-container">
                <!-- Back Link -->
                <div class="mb-4">
                    <a href="/news" class="back-link d-inline-flex align-items-center">
                        <i class="ti ti-chevron-left me-1"></i> All Posts
                    </a>
                </div>

                <!-- Main Post Card -->
                <div class="news-detail-card">
                    <!-- Author Section Header -->
                    <div class="author-section">
                        <div class="d-flex align-items-center">
                            <div class="author-avatar me-3">
                                {{ strtoupper(substr($article->author, 0, 1)) }}
                            </div>
                            <div class="author-meta">
                                <span class="fw-bold text-dark d-block" style="font-size: 0.9rem;">{{ $article->author }}</span>
                                <span class="text-muted">{{ $article->created_at->format('M d, Y') }} • {{ $article->read_time }} min read</span>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-link text-muted p-0" type="button">
                                <i class="ti ti-dots-vertical" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Category & Title -->
                    <span class="category-tag">Logistics</span>
                    <h1 class="news-detail-title">{{ $article->title }}</h1>

                    <!-- Article Main Image (Aspect Ratio Preserved, No Cropping) -->
                    @if($article->image_path)
                        <div class="article-main-image-container">
                            <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="article-main-image">
                        </div>
                    @endif

                    <!-- Article Body Content -->
                    <div class="post-content-text">
                        {{ $article->content }}
                    </div>

                    <!-- Footer Share & Interaction Section -->
                    <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                        <!-- Social Sharing Links -->
                        <div class="d-flex align-items-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" title="Share on Facebook">
                                <i class="ti ti-brand-facebook" style="font-size: 1.1rem;"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="share-btn" title="Share on Twitter/X">
                                <i class="ti ti-brand-twitter" style="font-size: 1.1rem;"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="share-btn" title="Share on LinkedIn">
                                <i class="ti ti-brand-linkedin" style="font-size: 1.1rem;"></i>
                            </a>
                            <button onclick="copyToClipboard()" class="share-btn" title="Copy Link" id="btnCopyLink">
                                <i class="ti ti-link" style="font-size: 1.1rem;"></i>
                            </button>
                        </div>

                        <!-- Interaction Metrics -->
                        <div class="d-flex align-items-center text-muted" style="font-size: 0.85rem; gap: 15px;">
                            <span>{{ $article->views_count }} views</span>
                            <span class="text-muted">|</span>
                            <div class="d-flex align-items-center">
                                <i class="ti ti-heart-filled text-danger me-1" style="font-size: 1rem;"></i>
                                <span>Liked</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function copyToClipboard() {
        var dummy = document.createElement('input'),
            text = window.location.href;

        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);

        var btn = document.getElementById('btnCopyLink');
        var originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check text-success" style="font-size: 1.1rem;"></i>';
        setTimeout(function() {
            btn.innerHTML = originalHTML;
        }, 2000);
    }
</script>

@endsection
