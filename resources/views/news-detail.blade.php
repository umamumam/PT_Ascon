@extends('layouts.landing')
@section('content')

<section id="landingNewsDetail" class="section-py bg-white">
    <div class="container">
        <div class="row mb-5 mt-10 justify-content-center">
            <div class="col-lg-9">
                <a href="/news" class="btn text-primary p-0 mb-4 d-inline-flex align-items-center text-decoration-none">
                    <i class="ti ti-arrow-left me-1_5"></i> Back to All Posts
                </a>

                <h1 class="display-6 fw-bold mb-3" style="color: #FF5722; line-height: 1.2;">
                    {{ $article->title }}
                </h1>

                <div class="d-flex align-items-center mb-5">
                    <div style="width: 36px; height: 36px; background-color: #7a92a3; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: bold;" class="me-2">
                        {{ strtoupper(substr($article->author, 0, 1)) }}
                    </div>
                    <div style="font-size: 0.8rem; color: #666;">
                        <div class="fw-bold text-dark">{{ $article->author }}</div>
                        <div>{{ $article->created_at->format('M d, Y') }} • {{ $article->read_time }} min read</div>
                    </div>
                </div>

                @if($article->image_path)
                    <div class="mb-5 overflow-hidden rounded">
                        <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;">
                    </div>
                @endif

                <div class="post-content text-muted" style="font-size: 1rem; line-height: 1.8; text-align: justify; white-space: pre-line;">
                    {{ $article->content }}
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center">
                    <div style="font-size: 0.8rem; color: #666;">
                        <span>{{ $article->views_count }} views</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="ti ti-heart text-danger" style="font-size: 1rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
