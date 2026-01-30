@extends('layouts.landing')
@section('content')

<style>
    .news-card {
        border: 1px solid #ebebeb !important;
        border-radius: 0px;
        transition: all 0.3s ease;
        max-width: 740px;
        margin: 0 auto;
    }

    .news-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .all-posts-link {
        color: #FF5722;
        text-decoration: none;
        font-size: 0.9rem;
    }

    /* Ukuran font judul sedikit dikecilkan agar seimbang dengan kartu yang lebih ramping */
    .post-title {
        color: #FF5722;
        font-weight: 700;
        line-height: 1.2;
        font-size: 1.75rem;
    }

    .post-title:hover {
        color: #e64a19;
    }

    .avatar-circle {
        width: 32px;
        height: 32px;
        background-color: #7a92a3;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
    }

    .meta-text {
        font-size: 0.75rem;
        color: #666;
    }
</style>

<section id="landingNewsHeader" class="section-py bg-white">
    <div class="container">
        <div class="row mb-5 mt-10 justify-content-center">
            <div class="col-lg-9">
                <h6 class="text-dark fw-bold mb-3" style="letter-spacing: 0.5px;">PT Asia Connexindo Internasional</h6>
                <h1 class="display-5 fw-bold" style="color: #FF5722;">News Update</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="mb-3">
                    <a href="#" class="all-posts-link ms-1">All Posts</a>
                </div>

                <div class="card news-card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="https://static.wixstatic.com/media/78d045_bd3b500c853c4af4a99079daf3ac4a2a~mv2.jpg"
                                alt="Laptop working" class="img-fluid h-100 w-100"
                                style="object-fit: cover; min-height: 320px;">
                        </div>

                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-4 d-flex flex-column h-100">

                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">R</div>
                                        <div>
                                            <div class="meta-text fw-bold">rizki lubron</div>
                                            <div class="meta-text text-muted">Nov 1, 2022 • 1 min read</div>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <i class="ti ti-dots-vertical cursor-pointer text-muted" style="font-size: 1.1rem;"></i>
                                    </div>
                                </div>

                                <h2 class="post-title mb-3">
                                    Welcome to our new and improved website
                                </h2>

                                <p class="card-text text-muted mb-4" style="font-size: 0.9rem; line-height: 1.5;">
                                    PT Asia Connexindo Internasional ( International Freight Forwarder ) new website is
                                    live! Freight Forwarding Welcome to our new website!...
                                </p>

                                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div class="meta-text text-muted">
                                        <span class="me-3">41 views</span>
                                        <span>2 comments</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="meta-text text-muted me-1">2</span>
                                        <i class="ti ti-heart text-danger" style="font-size: 0.9rem;"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
