@extends('layouts.landing')
@section('content')
<section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
        <picture>
            <source media="(max-width: 768px)"
                srcset="{{ asset('assets/img/front-pages/backgrounds/Landing-mobile.webp') }}" type="image/webp">
            <source srcset="{{ asset('assets/img/front-pages/backgrounds/Landing.jpg') }}" type="image/jpeg">
            <img src="{{ asset('assets/img/front-pages/backgrounds/Landing.jpg') }}"
                alt="PT Asia Connexindo Internasional Freight Forwarding Hero" fetchpriority="high" decoding="async"
                class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100"
                style="filter: brightness(0.85);" />
        </picture>


        <!-- Hero Wave Divider -->
        <div class="hero-wave-divider">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,90 Q300,120 600,100 T1200,60 L1200,120 L0,120 Z" fill="#F8F8F8"></path>
            </svg>
        </div>

        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-6 text-start text-white py-12">
                    <div class="animate-fade-up" style="animation-delay: 0.1s;">
                        <span class="text-white mb-2 fw-medium d-block fs-5">PT Asia Connexindo Internasional</span>
                    </div>

                    <div class="animate-fade-up" style="animation-delay: 0.3s;">
                        <h1 class="text-white hero-title fw-bold mb-4"
                            style="font-size: clamp(1.8rem, 5vw, 3rem); line-height: 1.2;">
                            {!! nl2br(e($settings['hero_title'] ?? "Partnership\nThrough Trust,\nSince 1999")) !!}
                        </h1>
                    </div>

                    <div class="animate-fade-up" style="animation-delay: 0.5s;">
                        <div class="mb-6" style="max-width: 500px;">
                            <hr class="w-25 border-2 border-primary mb-4 opacity-100">
                            <p class="hero-sub-title lh-lg">
                                {{ $settings['hero_subtitle'] ?? 'Established in 1999, to facilitate the needs of a
                                trustworthy freight forwarding agent in Jakarta. Now with over two decades of experience
                                backed by a dedicated and knowledgeable team, we have gained partnership globally by
                                being a trustworthy and reliable freight forwarding company.' }}
                            </p>
                        </div>
                    </div>

                    <div class="animate-fade-up" style="animation-delay: 0.7s;">
                        <div class="landing-hero-btn d-flex gap-3">
                            <a href="/contact" class="btn btn-danger btn-lg px-5 shadow-sm hover-lift">
                                Contact Us
                            </a>
                            {{-- <a href="/contact" class="btn btn-outline-light btn-lg px-5 hover-lift">
                                Contact Us
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- about --}}
<section id="landingAbout" class="section-py landing-about" style="background-color: #F1F1F1 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 reveal-on-scroll">
                <h2 class="text-dark fw-bold mb-3 h3">About Us</h2>
                <h3 class="display-6 fw-bold text-primary mb-4" style="color: #FF5722 !important; line-height: 1.2;">
                    Freight Forwarding<br>
                    Expert with Trusted<br>
                    Global Network
                </h3>

                <p class="fw-bold text-dark mb-4">PT. Asia Connexindo Internasional</p>

                <div class="about-description text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                    <p class="fw-bold text-dark mb-4">
                        PT. Asia Connexindo Internasional (Ascon) was established in 1999,
                        to facilitate the needs of trustworthy freight forwarding agent in Jakarta.
                    </p>
                    <p class="fw-bold text-dark mb-4">
                        Two decades ago, it started with small team and handled only consolidation groupage,
                        however we are now growing and serving wide spectrum of transportation needs.
                    </p>
                    <p class="fw-bold text-dark mb-4">
                        Ascon has been managed by a competent team of service oriented and dedicated
                        professionals with a number of experience within the industry.
                    </p>
                    <p class="fw-bold text-dark mb-4">
                        We will continue developing new services to ensure that we are at the forefront of the
                        industry.
                    </p>
                </div>
            </div>

            <div class="col-lg-6 text-center reveal-on-scroll delay-200">
                <div class="position-relative">
                    <img src="{{ asset('assets/img/front-pages/backgrounds/aboutnew.webp') }}"
                        alt="PT Asia Connexindo Internasional International Routes Logistics" loading="lazy"
                        decoding="async" width="570" height="380" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
{{-- services --}}
<section id="landingServices" class="section-py landing-services bg-white">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-5" data-aos="fade-right">
                <h2 class="text-dark fw-bold mb-2 h3">Our Services</h2>
                <h3 class="display-6 fw-bold mb-4" style="color: #FF5722; line-height: 1.2;">
                    We Offer a Range<br>
                    of Services to Meet<br>
                    Your Needs
                </h3>
                <p class="fw-bold text-dark mb-4" style="font-size: 0.9rem;">
                    We are committed to transporting your goods safely, economically in timely manner of any volume,
                    destination and mode of transport.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/front-pages/services/service-main.jpg') }}" loading="lazy"
                    decoding="async" width="842" height="303"
                    alt="Aerial View Cargo Container Ship - PT Asia Connexindo Services"
                    class="img-fluid rounded shadow-sm" data-aos="fade-left" data-aos-duration="1000">
            </div>
        </div>

        <div id="trigger-services" class="row g-4 overflow-hidden">
            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="100"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/sea-groupage.png') }}" loading="lazy"
                            decoding="async" width="75" height="57" alt="Sea Groupage Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Sea Groupage Service</h4>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="200"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/airfreight.png') }}" loading="lazy"
                            decoding="async" width="103" height="57"
                            alt="Airfreight Worldwide Service - PT Asia Connexindo" class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Airfreight Worldwide</h4>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="300"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/fcl-service.png') }}" loading="lazy"
                            decoding="async" width="91" height="57" alt="Worldwide FCL Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Worldwide FCL Service</h4>
                    <small class="fw-bold text-dark d-block italic">(Full Container Load)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="400"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/lcl-service.png') }}" loading="lazy"
                            decoding="async" width="96" height="57" alt="Worldwide LCL Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Worldwide LCL Service</h4>
                    <small class="fw-bold text-dark d-block italic">(Less than Container Load)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="500"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/customs-brokerage.png') }}" loading="lazy"
                            decoding="async" width="49" height="59" alt="Customs Brokerage Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Customs Brokerage</h4>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="600"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/buyers-consolidation.png') }}"
                            loading="lazy" decoding="async" width="78" height="59"
                            alt="Buyer Consolidation Service - PT Asia Connexindo" class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Buyer's Consolidation</h4>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="700"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/inland-transport.png') }}" loading="lazy"
                            decoding="async" width="111" height="59" alt="Inland Transport Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Inland Transport</h4>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="800"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/combined-transport.png') }}" loading="lazy"
                            decoding="async" width="82" height="79"
                            alt="Combined Transport Service - PT Asia Connexindo" class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Combined Sea and Land Transport</h4>
                    <small class="fw-bold text-dark d-block">(Via Dubai or other countries as required)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="900"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/front-pages/services/warehousing.png') }}" loading="lazy"
                            decoding="async" width="72" height="72" alt="Warehousing Service - PT Asia Connexindo"
                            class="service-icon-img" />
                    </div>
                    <h4 class="fw-bold mb-0 h6">Warehousing</h4>
                </div>
            </div>


            <div class="col-md-4 col-lg-2-4" data-aos="zoom-in" data-aos-delay="1000"
                data-aos-anchor="#trigger-services">
                <div class="service-card h-100 d-flex align-items-center justify-content-center">
                    <a href="/services" class="btn btn-danger btn-lg px-5">
                        Read More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Real customers reviews: Start -->
<section id="landingWhyChooseUs" class="section-py bg-body landing-reviews pb-0">
    <div class="container">
        <div id="trigger-why" class="row align-items-start gx-0 gy-4 g-lg-5 mb-5 pb-md-5">

            <div class="col-md-5 col-lg-5 col-xl-4" data-aos="fade-right" data-aos-delay="50"
                data-aos-anchor="#trigger-why">
                <div class="mb-4">
                    <div style="width: 40px; height: 3px; background-color: #333;" class="mb-2"></div>
                    <h2 class="text-dark fw-bold mb-2 h3">Why Choose Us</h2>
                </div>
                <h3 class="mb-4 fw-bold" style="color: #FF5722; line-height: 1.2; font-size: 2.5rem;">
                    A Couple of Good<br />
                    Reasons On Why You<br />
                    Should Choose Us
                </h3>
                <p class="mb-5 fw-bold text-dark" style="max-width: 350px;">
                    Our experience backed by a dedicated and knowledgeable team have helped our clients to enhance
                    their business efficiency and grow their market globally.
                </p>
            </div>

            <div class="col-md-7 col-lg-7 col-xl-8">
                <div class="row g-4">

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="200" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="{{ asset('assets/img/front-pages/why/why-experience.jpg') }}" loading="lazy"
                                decoding="async" width="302" height="533" class="img-fluid custom-arch-img"
                                alt="26 Years Freight Forwarding Experience - PT Asia Connexindo">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h4 class="fw-bold mb-2 h6" style="color: #FF5722;">26+ Years of Experience</h4>
                                <p class="small fw-bold text-dark mb-3">Our Experience has allowed us to convince
                                    clients
                                    and agents around the world to be part of our global network and partnership.
                                </p>
                                <div class="text-end"><i class="ti ti-thumb-up" style="color: #FF5722;"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="400" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="{{ asset('assets/img/front-pages/why/why-monitored.jpg') }}" loading="lazy"
                                decoding="async" width="302" height="533" class="img-fluid custom-arch-img"
                                alt="Monitored Freight Forwarding Shipments - PT Asia Connexindo">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h4 class="fw-bold mb-2 h6" style="color: #FF5722;">Your Goods Will be Monitored</h4>
                                <p class="small fw-bold text-dark mb-3">Our customer service will act swiftly to notify
                                    you
                                    about any slight of change regarding your cargo and will ensure that your cargo
                                    is safe.</p>
                                <div class="text-end"><i class="ti ti-thumb-up" style="color: #FF5722;"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="600" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="{{ asset('assets/img/front-pages/why/why-schedule.jpg') }}" loading="lazy"
                                decoding="async" width="302" height="533" class="img-fluid custom-arch-img"
                                alt="Weekly Shipping Sailing Schedule - PT Asia Connexindo">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h4 class="fw-bold mb-2 h6" style="color: #FF5722;">Weekly Schedule</h4>
                                <p class="small fw-bold text-dark mb-3">We have a weekly regular service to Singapore,
                                    Dubai, Etc. <br><small class="fst-italic">(Follow our social media for more
                                        info)</small></p>
                                <div class="text-end"><i class="ti ti-thumb-up" style="color: #FF5722;"></i></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Real customers reviews: End -->

<!-- CTA: Start -->
<section id="landingCTA" class="position-relative overflow-hidden py-5 py-md-10 d-flex align-items-center"
    style="min-height: 650px;">
    <!-- Background Image -->
    <picture>
        <source media="(max-width: 768px)"
            srcset="{{ asset('assets/img/front-pages/backgrounds/Worldwide-mobile.webp') }}" type="image/webp">
        <source srcset="{{ asset('assets/img/front-pages/backgrounds/Worldwide.webp') }}" type="image/webp">
        <img src="{{ asset('assets/img/front-pages/backgrounds/Worldwide.webp') }}" loading="lazy" decoding="async"
            width="1440" height="650" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
            alt="PT Asia Connexindo Internasional Worldwide Freight Forwarder Network"
            style="z-index: 1; object-position: center;" />
    </picture>

    <!-- Dark Overlay for Readability -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.55); z-index: 2;"></div>

    <div class="container position-relative" style="z-index: 3;">
        <div class="row">
            <div class="col-lg-7 text-white">
                <h2 class="mb-2 fw-medium text-white fs-5">Worldwide Freight Forwarder</h2>

                <h3 class="fw-bold mb-4"
                    style="color: #FF5722; line-height: 1.2; font-size: clamp(1.5rem, 3.5vw, 2.4rem);">
                    Experienced Sea & Air Forwarder,<br>
                    from Freight to Warehousing.
                </h3>

                <p class="mb-2 fw-medium">
                    It is our commitment to be a leading freight forwarder offering one-stop services to customers
                    and agents all over the world efficiently and effectively by creating partnership through trust.
                </p>

                <div class="row g-4 mt-2">
                    <div class="col-6 col-md-3">
                        <span class="h1 fw-bold text-white mb-0 counter-value d-block" data-target="1999">0</span>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Year of Establishment</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <span class="h1 fw-bold text-white mb-0 counter-value d-block" data-target="2">0</span>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Office Branch</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <span class="h1 fw-bold text-white mb-0 counter-value" data-target="26">0</span>
                            <span class="h1 fw-bold text-white mb-0">+</span>
                        </div>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Years of Experience</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <span class="h1 fw-bold text-white mb-0 counter-value" data-target="200">0</span>
                            <span class="h1 fw-bold text-white mb-0">+</span>
                        </div>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Business Partners</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CTA: End -->

<!-- Contact Us: Start -->
<section id="landingFollowUs" class="section-py bg-body landing-follow">
    <div class="container">
        <div class="row g-6 align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="mb-4">
                    <div style="width: 40px; height: 3px; background-color: #333;" class="mb-2"></div>
                    <h2 class="text-dark fw-bold mb-2 h3">Follow Us</h2>
                </div>

                <h3 class="mb-4 fw-bold"
                    style="color: #FF5722; line-height: 1.2; font-size: clamp(1.5rem, 3.5vw, 2.4rem);">
                    Stay Updated &<br />
                    Connect with Us
                </h3>

                <p class="mb-5 fw-bold text-dark" style="max-width: 400px;">
                    Don't miss any news and stay updated for our regular weekly schedule by following us on
                    <strong>Facebook, Instagram & Linkedin.</strong>
                </p>

                <div class="d-flex gap-3">
                    <a href="{{ $settings['facebook_link'] ?? 'https://www.facebook.com' }}" target="_blank"
                        rel="noopener" aria-label="PT Asia Connexindo Facebook"
                        class="btn btn-icon btn-outline-primary rounded-circle">
                        <i class="ti ti-brand-facebook ti-md"></i>
                    </a>
                    <a href="{{ $settings['instagram_link'] ?? 'https://www.instagram.com' }}" target="_blank"
                        rel="noopener" aria-label="PT Asia Connexindo Instagram"
                        class="btn btn-icon btn-outline-danger rounded-circle">
                        <i class="ti ti-brand-instagram ti-md"></i>
                    </a>
                    <a href="{{ $settings['linkedin_link'] ?? 'https://www.linkedin.com' }}" target="_blank"
                        rel="noopener" aria-label="PT Asia Connexindo LinkedIn"
                        class="btn btn-icon btn-outline-info rounded-circle">
                        <i class="ti ti-brand-linkedin ti-md"></i>
                    </a>
                </div>

            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="row g-3">
                    @php
                    $badgeColors = ['primary', 'success', 'warning text-dark', 'danger', 'info', 'secondary'];
                    @endphp
                    @forelse($feeds as $feed)
                    <div class="col-6">
                        <div class="card border-0 shadow-sm overflow-hidden h-100">
                            <a href="{{ $feed->link ?? 'javascript:void(0)' }}"
                                target="{{ $feed->link ? '_blank' : '_self' }}"
                                class="position-relative h-100 d-block text-decoration-none">
                                <img src="{{ str_starts_with($feed->image_path, 'http') ? $feed->image_path : asset($feed->image_path) }}"
                                    class="d-block w-100 h-100"
                                    alt="{{ $feed->title ?: 'PT Asia Connexindo Social Feed' }}" loading="lazy"
                                    decoding="async" width="300" height="180" style="object-fit: cover; height: 180px;">
                                <div class="card-img-overlay d-flex align-items-end p-2 bg-dark-gradient-overlay"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                    <span class="badge bg-{{ $badgeColors[$loop->index % count($badgeColors)] }}">{{
                                        $feed->tag }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center text-muted py-4">No feeds available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Sections:End -->
@endsection