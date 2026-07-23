@extends('layouts.landing')
@section('content')

<style>
    .news-grid-card {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-grid-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(255, 87, 34, 0.12) !important;
    }

    .news-img-wrapper {
        position: relative;
        height: 220px;
        overflow: hidden;
        border-radius: 12px 12px 0 0;
        background-color: #f8f9fa;
    }

    .news-img-wrapper img {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .news-grid-card:hover .news-img-wrapper img {
        transform: scale(1.08);
    }

    .news-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #FF5722;
        color: #ffffff;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        z-index: 2;
        box-shadow: 0 4px 10px rgba(255, 87, 34, 0.3);
    }

    .news-title {
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.4;
        color: #1a1a1a;
        transition: color 0.2s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 3.4rem;
        /* Enforce uniform height for titles */
    }

    .news-title a {
        color: #2f3349;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
    }

    .news-title a:hover {
        color: #FF5722;
    }

    .news-excerpt {
        font-size: 0.88rem;
        color: #666666;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 4.2rem;
        /* Enforce uniform height for text */
        margin-bottom: 1.5rem;
    }

    .news-meta {
        font-size: 0.75rem;
        color: #888888;
        display: flex;
        align-items: center;
    }

    .news-author-avatar {
        width: 32px;
        height: 32px;
        background-color: #fff2ee;
        color: #FF5722;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid rgba(255, 87, 34, 0.2);
    }

    .all-posts-link {
        color: #FF5722;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        position: relative;
        padding-bottom: 4px;
        transition: all 0.3s ease;
    }

    .all-posts-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #FF5722;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .all-posts-link:hover::after {
        transform: scaleX(1);
    }
</style>

<section id="landingNewsHeader" class="section-py bg-white" style="padding-top: 180px !important;">
    <div class="container">
        <!-- Header Title Section -->
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-8">
                <h6 class="text-dark fw-bold mb-2 text-uppercase tracking-wider"
                    style="letter-spacing: 2px; font-size: 0.8rem;">eServices / News Update</h6>
                <h1 class="display-4 fw-extrabold text-dark mb-3">Our Latest Insights</h1>
                <p class="text-dark mx-auto" style="max-width: 600px; font-size: 0.95rem;">Stay updated with the latest
                    news, logistics solutions, and transport updates from PT Asia Connexindo Internasional.</p>
                <div class="mt-4">
                    <a href="/news" class="all-posts-link">All Posts</a>
                </div>
            </div>
        </div>

        <!-- News Grid Section -->
        <div class="row g-4 mt-2 justify-content-start">
            @forelse($news as $article)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card news-grid-card shadow-sm border-0 h-100">
                    <!-- Image Area -->
                    <div class="news-img-wrapper">
                        <span class="news-category-badge">Logistics</span>
                        <a href="{{ route('public.news.show', $article->slug) }}">
                            <img src="{{ $article->image_path ? asset($article->image_path) : 'https://static.wixstatic.com/media/78d045_bd3b500c853c4af4a99079daf3ac4a2a~mv2.jpg' }}"
                                alt="{{ $article->title }}" class="img-fluid">
                        </a>
                    </div>

                    <!-- Content Area -->
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Author & Date Header -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="news-author-avatar me-2">
                                    {{ strtoupper(substr($article->author, 0, 1)) }}
                                </div>
                                <div class="news-meta">
                                    <span class="fw-bold text-dark">{{ $article->author }}</span>
                                    <span class="text-dark">•</span>
                                    <span class="text-dark">{{ $article->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <!-- Post Title -->
                            <h3 class="news-title mb-2">
                                <a href="{{ route('public.news.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>

                            <!-- Post Excerpt -->
                            <p class="news-excerpt text-dark">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                        </div>

                        <!-- Footer Section -->
                        <div class="pt-3 border-top d-flex justify-content-between align-items-center mt-auto">
                            <div class="news-meta">
                                <span>{{ $article->views_count }} views</span>
                                <span>•</span>
                                <span>{{ $article->read_time }} min read</span>
                            </div>
                            <div class="d-flex align-items-center text-dark">
                                <i class="ti ti-heart-filled text-danger me-1" style="font-size: 0.95rem;"></i>
                                <span>Liked</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center text-dark py-5 card border-0 shadow-sm" style="border-radius: 12px;">
                    <p class="mb-0 py-4" style="font-size: 1rem;">No news updates available at this time.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection