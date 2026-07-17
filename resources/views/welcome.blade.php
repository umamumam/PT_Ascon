@extends('layouts.landing')
@section('content')
<section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
        <img src="{{ asset('assets/img/front-pages/backgrounds/Landing.jpg') }}" alt="hero background"
            class="position-absolute top-0 start-50 translate-middle-x object-fit-cover w-100 h-100"
            style="filter: brightness(0.8);" />

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
                        <h5 class="text-white mb-2 fw-medium">PT Asia Connexindo Internasional</h5>
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
                            <a href="#projects" class="btn btn-danger btn-lg px-5 shadow-sm hover-lift">
                                View Projects
                            </a>
                            <a href="#contact" class="btn btn-outline-light btn-lg px-5 hover-lift">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- about --}}
<section id="landingAbout" class="section-py landing-about" style="background-color: #F8F8F8 !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 reveal-on-scroll">
                <h3 class="text-dark fw-bold mb-3">About Us</h3>
                <h3 class="display-6 fw-bold text-primary mb-4" style="color: #FF5722 !important; line-height: 1.2;">
                    Freight Forwarding<br>
                    Expert with Trusted<br>
                    Global Network
                </h3>

                <p class="fw-bold text-dark mb-4">PT. Asia Connexindo Internasional</p>

                <div class="about-description text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                    <p class="mb-4">
                        PT. Asia Connexindo Internasional (Ascon) was established in 1999,
                        to facilitate the needs of trustworthy freight forwarding agent in Jakarta.
                    </p>
                    <p class="mb-4">
                        Two decades ago, it started with small team and handled only consolidation groupage,
                        however we are now growing and serving wide spectrum of transportation needs.
                    </p>
                    <p class="mb-4">
                        Ascon has been managed by a competent team of service oriented and dedicated
                        professionals with a number of experience within the industry.
                    </p>
                    <p>
                        We will continue developing new services to ensure that we are at the forefront of the
                        industry.
                    </p>
                </div>
            </div>

            <div class="col-lg-6 text-center reveal-on-scroll delay-200">
                <div class="position-relative">
                    <img src="{{ asset('assets/img/front-pages/backgrounds/about.avif') }}" alt="International Routes"
                        class="img-fluid" />
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
                <h3 class="text-dark fw-bold mb-2">Our Services</h3>
                <h4 class="display-6 fw-bold mb-4" style="color: #FF5722; line-height: 1.2;">
                    We Offer a Range<br>
                    of Services to Meet<br>
                    Your Needs
                </h4>
                <p class="text-muted" style="font-size: 0.9rem;">
                    We are committed to transporting your goods safely, economically in timely manner of any volume,
                    destination and mode of transport.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="https://static.wixstatic.com/media/36e2c8_f9e73736d972499b9e5095f30873b3e5~mv2.jpg/v1/crop/x_0,y_886,w_5459,h_1961/fill/w_842,h_303,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/aerial-view-cargo-ship-cargo-container-harbor.jpg"
                    alt="Cargo Ship" class="img-fluid rounded shadow-sm" data-aos="fade-left" data-aos-duration="1000">
            </div>
        </div>

        <div id="trigger-services" class="row g-4 overflow-hidden">
            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="100"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_d50fcfe6910643f5a524838333a4bd76~mv2.png/v1/fill/w_75,h_57,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/sea%20groupage%20service.png"
                            alt="Sea Groupage" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Sea Groupage Service</h6>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="200"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_3138493585894ac1a79b0d3fea789dad~mv2.png/v1/fill/w_103,h_57,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/airfreight%20worldwide.png"
                            alt="Airfreight" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Airfreight Worldwide</h6>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="300"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_81ed5f5ff26f49c590bba6aeba34d564~mv2.png/v1/fill/w_91,h_57,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/FCL%20service.png"
                            alt="FCL Service" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Worldwide FCL Service</h6>
                    <small class="text-muted d-block italic">(Full Container Load)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="400"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_4599e9bb0dd04831ab4cf1eb0111a412~mv2.png/v1/fill/w_96,h_57,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/LCL%20service.png"
                            alt="LCL Service" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Worldwide LCL Service</h6>
                    <small class="text-muted d-block italic">(Less than Container Load)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="500"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_4cb19f9318fa49828bd88046099c97e6~mv2.png/v1/fill/w_49,h_59,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Customs%20Brokerage.png"
                            alt="Customs Brokerage" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Customs Brokerage</h6>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="600"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_f1a94b61c8d64ea7b91affae3f19345c~mv2.png/v1/fill/w_78,h_59,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Buyers%20Consolidation.png"
                            alt="Buyer Consolidation" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Buyer's Consolidation</h6>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="700"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_5295d86af3dc46129d0613313e7d43c4~mv2.png/v1/fill/w_111,h_59,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Inland%20Transport.png"
                            alt="Inland Transport" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Inland Transport</h6>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="800"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_bd85dbc558a94f6793b34b8c8fa08a3e~mv2.png/v1/fill/w_82,h_79,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Combined%20sea%20and%20air%20transport.png"
                            alt="Combined Transport" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Combined Sea and Land Transport</h6>
                    <small class="text-muted d-block">(Via Dubai or other countries as required)</small>
                </div>
            </div>

            <div class="col-md-4 col-lg-2-4 text-center" data-aos="fade-up" data-aos-delay="900"
                data-aos-anchor="#trigger-services">
                <div class="service-card">
                    <div class="mb-3">
                        <img src="https://static.wixstatic.com/media/36e2c8_fbcc9ceef4694a3c86e4c6ba86dc526a~mv2.png/v1/fill/w_72,h_72,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Warehousing.png"
                            alt="Warehousing" class="service-icon-img" />
                    </div>
                    <h6 class="fw-bold mb-0">Warehousing</h6>
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
                    <h3 class="text-dark fw-bold mb-2">Why Choose Us</h3>
                </div>
                <h2 class="mb-4 fw-bold" style="color: #FF5722; line-height: 1.2; font-size: 2.5rem;">
                    A Couple of Good<br />
                    Reasons On Why You<br />
                    Should Choose Us
                </h2>
                <p class="mb-5 text-muted" style="max-width: 350px;">
                    Our experience backed by a dedicated and knowledgeable team have helped our clients to enhance
                    their business efficiency and grow their market globally.
                </p>
            </div>

            <div class="col-md-7 col-lg-7 col-xl-8">
                <div class="row g-4">

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="200" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="https://static.wixstatic.com/media/nsplsh_6d97f01dd18643a192e4fdad71bfc01f~mv2.jpg/v1/fill/w_302,h_533,al_br,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/nsplsh_6d97f01dd18643a192e4fdad71bfc01f~mv2.jpg"
                                class="img-fluid custom-arch-img" alt="Experience">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h6 class="fw-bold mb-2" style="color: #FF5722;">26+ Years of Experience</h6>
                                <p class="small text-muted mb-3">Our Experience has allowed us to convince clients
                                    and agents around the world to be part of our global network and partnership.
                                </p>
                                <div class="text-end"><i class="ti ti-thumb-up" style="color: #FF5722;"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="400" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="https://static.wixstatic.com/media/11062b_b58444d0dad140688dc506c9f8e23f91~mv2.jpg/v1/fill/w_302,h_533,al_c,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/11062b_b58444d0dad140688dc506c9f8e23f91~mv2.jpg"
                                class="img-fluid custom-arch-img" alt="Monitored">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h6 class="fw-bold mb-2" style="color: #FF5722;">Your Goods Will be Monitored</h6>
                                <p class="small text-muted mb-3">Our customer service will act swiftly to notify you
                                    about any slight of change regarding your cargo and will ensure that your cargo
                                    is safe.</p>
                                <div class="text-end"><i class="ti ti-thumb-up" style="color: #FF5722;"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" data-aos="fade-right" data-aos-delay="600" data-aos-anchor="#trigger-why">
                        <div class="custom-card-wrapper h-100">
                            <img src="https://static.wixstatic.com/media/nsplsh_46466686057e4a82953868b5df48b117~mv2.jpg/v1/fill/w_302,h_533,al_bl,q_80,usm_0.66_1.00_0.01,enc_avif,quality_auto/nsplsh_46466686057e4a82953868b5df48b117~mv2.jpg"
                                class="img-fluid custom-arch-img" alt="Schedule">
                            <div class="custom-card-body bg-white p-3 shadow-sm">
                                <h6 class="fw-bold mb-2" style="color: #FF5722;">Weekly Schedule</h6>
                                <p class="small text-muted mb-3">We have a weekly regular service to Singapore,
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
<section id="landingCTA" class="section-py landing-cta position-relative p-0 overflow-hidden"
    style="min-height: 700px; display: flex; align-items: center;">
    <img src="{{ asset('assets/img/front-pages/backgrounds/Worldwide.jpg') }}"
        class="position-absolute top-0 start-0 w-100 h-150 z-n1" alt="cta image"
        style="object-fit: cover; object-position: center;" />

    <div class="container">
        <div class="row">
            <div class="col-lg-7 text-white">
                <p class="mb-2 fw-medium">Worldwide Freight Forwarder</p>

                <h2 class="fw-bold mb-4" style="color: #FF5722; line-height: 1.2; font-size: clamp(1.5rem, 3.5vw, 2.4rem);">
                    Experienced Sea & Air Forwarder,<br>
                    from Freight to Warehousing.
                </h2>

                <p class="mb-2 fw-medium">
                    It is our commitment to be a leading freight forwarder offering one-stop services to customers
                    and agents all over the world efficiently and effectively by creating partnership through trust.
                </p>

                <div class="row g-4 mt-2">
                    <div class="col-6 col-md-3">
                        <h1 class="fw-bold text-white mb-0 counter-value" data-target="1999">0</h1>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Year of Establishment</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <h1 class="fw-bold text-white mb-0 counter-value" data-target="2">0</h1>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Office Branch</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <h1 class="fw-bold text-white mb-0 counter-value" data-target="26">0</h1>
                            <h1 class="fw-bold text-white mb-0">+</h1>
                        </div>
                        <div style="width: 30px; height: 3px; background-color: #FF5722;" class="my-2"></div>
                        <p class="mb-2 fw-medium">Years of Experience</p>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <h1 class="fw-bold text-white mb-0 counter-value" data-target="200">0</h1>
                            <h1 class="fw-bold text-white mb-0">+</h1>
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
                    <h3 class="text-dark fw-bold mb-2">Follow us</h3>
                </div>

                <h2 class="mb-4 fw-bold" style="color: #FF5722; line-height: 1.2; font-size: clamp(1.5rem, 3.5vw, 2.4rem);">
                    Stay Updated &<br />
                    Connect with Us
                </h2>

                <p class="mb-5 text-muted" style="max-width: 400px;">
                    Don't miss any news and stay updated for our regular weekly schedule by following us on
                    <strong>Facebook, Instagram & Linkedin.</strong>
                </p>

                <div class="d-flex gap-3">
                    <a href="{{ $settings['facebook_link'] ?? '#' }}" target="_blank"
                        class="btn btn-icon btn-outline-primary rounded-circle">
                        <i class="ti ti-brand-facebook ti-md"></i>
                    </a>
                    <a href="{{ $settings['instagram_link'] ?? '#' }}" target="_blank"
                        class="btn btn-icon btn-outline-danger rounded-circle">
                        <i class="ti ti-brand-instagram ti-md"></i>
                    </a>
                    <a href="{{ $settings['linkedin_link'] ?? '#' }}" target="_blank"
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
                                    class="d-block w-100 h-100" alt="{{ $feed->title }}"
                                    style="object-fit: cover; height: 180px;">
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