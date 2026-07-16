<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="front-pages" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>PT Asia Connexindo Internasional</title>

    <meta name="description" content="Freight Forwarding Expert with Trusted Global Network" />

    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    {{-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> --}}
    <script src="{{ asset('assets/js/front-config.js') }}"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        @media (min-width: 992px) {
            .col-lg-2-4 {
                flex: 0 0 auto;
                width: 20%;
            }
        }

        .italic {
            font-style: italic;
            font-size: 0.75rem;
        }

        .service-card {
            border: 1px solid #e5e5e5;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .service-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            border-color: #FF5722;
        }

        .service-icon-img {
            height: 55px;
            object-fit: contain;
        }

        .custom-card-wrapper {
            display: flex;
            flex-direction: column;
        }

        .custom-arch-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-top-left-radius: 120px;
            border-top-right-radius: 120px;
            display: block;
        }

        .custom-card-body {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .custom-arch-img {
                height: 400px;
                border-top-left-radius: 180px;
                border-top-right-radius: 180px;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            opacity: 0;
            animation: fadeUp 0.8s ease-out forwards;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }

        .reveal-on-scroll.active {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-200 {
            transition-delay: 0.2s;
        }

        /* Custom Solid Header Overrides */
        nav.layout-navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            border-bottom: none !important;
        }

        /* Disable layout-page:before header blur/background element to fix the scroll line */
        .layout-navbar-fixed .layout-page:before,
        .layout-navbar-fixed .layout-wrapper .layout-page:before,
        .layout-navbar-fixed .layout-wrapper:not(.layout-horizontal) .layout-page:before {
            display: none !important;
            background: transparent !important;
            backdrop-filter: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        .layout-navbar .navbar.landing-navbar {
            background-color: #ffffff !important;
            border: none !important;
            margin-top: 0 !important;
            border-radius: 0 !important;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            box-shadow: none !important;
            /* Ensure no floating card shadow */
        }

        /* Enforce full-width styling and clean transition on scroll */
        nav.layout-navbar.navbar-active {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            border-bottom: none !important;
        }

        .layout-navbar.navbar-active .navbar.landing-navbar {
            background-color: #ffffff !important;
            box-shadow: none !important;
            border: none !important;
        }

        .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link {
            color: #333333 !important;
            font-weight: 500 !important;
        }

        .layout-navbar .navbar.landing-navbar .navbar-nav .show>.nav-link,
        .layout-navbar .navbar.landing-navbar .navbar-nav .active>.nav-link,
        .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link.show,
        .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link.active {
            color: #FF5722 !important;
        }

        .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link:hover {
            color: #FF5722 !important;
        }

        /* Dark Style Overrides */
        .dark-style nav.layout-navbar {
            background-color: #2f3349 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
            border-bottom: 1px solid #434968 !important;
        }

        .dark-style .layout-navbar .navbar.landing-navbar {
            background-color: #2f3349 !important;
            border: none !important;
            margin-top: 0 !important;
            border-radius: 0 !important;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }

        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link {
            color: #cfcde4 !important;
            font-weight: 500 !important;
        }

        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .show>.nav-link,
        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .active>.nav-link,
        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link.show,
        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link.active {
            color: #7367f0 !important;
        }

        .dark-style .layout-navbar .navbar.landing-navbar .navbar-nav .nav-link:hover {
            color: #7367f0 !important;
        }

        /* Style the login button like the orange "Call Now!" button */
        .btn-login-orange {
            background-color: #FF5722 !important;
            border-color: #FF5722 !important;
            color: #ffffff !important;
            border-radius: 50px !important;
            padding: 0.5rem 1.75rem !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            box-shadow: 0 4px 10px rgba(255, 87, 34, 0.3) !important;
            transition: all 0.2s ease-in-out !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .btn-login-orange:hover {
            background-color: #e64a19 !important;
            border-color: #e64a19 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 14px rgba(255, 87, 34, 0.4) !important;
            color: #ffffff !important;
        }

        /* Hero Wave Section styling */
        .landing-hero {
            border-radius: 0 !important;
            overflow: hidden !important;
        }

        .hero-wave-divider {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            line-height: 0;
            z-index: 10;
        }

        .hero-wave-divider svg {
            display: block;
            width: 100%;
            height: 80px;
        }

        @media (max-width: 768px) {
            .hero-wave-divider svg {
                height: 40px;
            }
        }

        /* Dark mode wave fill adjust */
        .dark-style .hero-wave-divider svg path {
            fill: #2f3349 !important;
        }

        /* Custom Footer Style */
        footer.custom-landing-footer {
            background-color: #ffffff !important;
            color: #444050 !important;
            padding-top: 3rem !important;
            padding-bottom: 2rem !important;
        }

        .dark-style footer.custom-landing-footer {
            background-color: #2f3349 !important;
            color: #cfcde4 !important;
        }

        .dark-style footer.custom-landing-footer .container {
            border-top-color: #7367f0 !important;
        }

        footer.custom-landing-footer h5,
        footer.custom-landing-footer h6 {
            color: #2f3349 !important;
            font-weight: 700 !important;
        }

        .dark-style footer.custom-landing-footer h5,
        .dark-style footer.custom-landing-footer h6 {
            color: #cfcde4 !important;
        }

        footer.custom-landing-footer a.footer-link {
            color: #444050 !important;
            text-decoration: underline !important;
            font-size: 0.95rem !important;
            transition: color 0.2s ease-in-out !important;
        }

        footer.custom-landing-footer a.footer-link:hover {
            color: #FF5722 !important;
        }

        .dark-style footer.custom-landing-footer a.footer-link {
            color: #cfcde4 !important;
        }

        .dark-style footer.custom-landing-footer a.footer-link:hover {
            color: #7367f0 !important;
        }
    </style>
</head>

<body>
    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>
    <!-- Navbar: Start -->
    <nav class="layout-navbar shadow-none py-0">
        <div class="container">
            <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-8">
                <!-- Menu logo wrapper: Start -->
                <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4 me-xl-8">
                    <!-- Mobile menu toggle: Start-->
                    <button class="navbar-toggler border-0 px-0 me-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-lg align-middle text-heading fw-medium"></i>
                    </button>
                    <!-- Mobile menu toggle: End-->
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-logo">
                            <img src="{{ asset('LogoLanding.png') }}" alt="Logo"
                                style="height: 50px; width: auto; object-fit: contain;">
                        </span>
                        {{-- <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">Vuexy</span> --}}
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->
                <!-- Menu wrapper: Start -->
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-lg"></i>
                    </button>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page" href="/about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="/business">Business</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                eServices
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/sailing">Sailing Schedule</a></li>
                                <li><a class="dropdown-item" href="/etracking">Tracking</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="/quote">eQuote</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="/news">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="/careers">Careers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="/contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- Style Switcher -->
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-1">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <i class="ti ti-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i class="ti ti-sun me-3"></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                    <span class="align-middle"><i class="ti ti-moon-stars me-3"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                    <span class="align-middle"><i
                                            class="ti ti-device-desktop-analytics me-3"></i>System</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Style Switcher-->

                    <!-- navbar button: Start -->
                    <li>
                        <a href="tel:+622183791179" class="btn btn-login-orange">Call Now!</a>
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div>
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    @yield('content')

    <!-- Footer: Start -->
    <footer class="custom-landing-footer footer-text">
        <div class="container" style="border-top: 4px solid #FF5722 !important; padding-top: 3rem !important;">
            <div class="row">
                <!-- Column 1: Logo -->
                <div class="col-lg-3 col-md-12 mb-5 mb-lg-0 text-center text-lg-start">
                    <a href="/" class="d-inline-block mb-3">
                        <img src="{{ asset('LogoLanding.png') }}" alt="PT Asia Connexindo Internasional"
                            style="max-width: 120px; height: auto;">
                    </a>
                </div>

                <!-- Column 2: Offices -->
                <div class="col-lg-5 col-md-6 mb-5 mb-md-0">
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 1.1rem;">Head Office</h5>
                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">
                            {!! nl2br(e($settings['head_office_address'] ?? "Soepomo Office Park, Blok O\nJl. Prof. Dr.
                            Supomo No. 143\nTebet Jakarta Selatan 12870\nIndonesia")) !!}
                        </p>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">Phone :</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">
                            {{ $settings['phone'] ?? '+62 21 8379 1179' }}
                            @if(isset($settings['phone_2']) && $settings['phone_2'])
                            <br>{{ $settings['phone_2'] }}
                            @endif
                        </p>
                    </div>

                    <div>
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 1.1rem;">Semarang Office</h5>
                        <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6;">
                            {!! nl2br(e($settings['semarang_office_address'] ?? "SETOS CO WORK\nMG Setos, Jl. Inspeksi
                            Lt 3,\nKembangsari, Semarang Tengah,\nJawa Tengah, Indonesia 50133")) !!}
                        </p>
                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">Phone :</h6>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.5;">
                            {{ $settings['phone_semarang'] ?? '+62 24 8604 1230 Ext. 105' }}
                            @if(isset($settings['phone_semarang_2']) && $settings['phone_semarang_2'])
                            <br>{{ $settings['phone_semarang_2'] }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Column 3: Inquiries & Socials -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="fw-bold text-dark mb-3" style="font-size: 1.1rem;">Inquiries</h5>
                            <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.6; max-width: 250px;">
                                For any inquiries, questions or commendations, please contact us
                            </p>
                            <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                                Phone: {{ $settings['phone'] ?? '+62 21 8379 1179' }}<br>
                                WA: {{ $settings['whatsapp'] ?? '+62 819 1000 1999' }}<br>
                                Email: {{ $settings['email'] ?? 'admin@asiaconnex.net' }}
                            </p>
                        </div>
                        <div>
                            <a href="/contact" class="btn text-white rounded-0 px-4 py-2"
                                style="background-color: #FF5722; font-weight: 500; font-size: 0.9rem; letter-spacing: 0.5px;">Contact
                                Us</a>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 1.1rem;">Socials</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="{{ $settings['linkedin_link'] ?? '#' }}" target="_blank"
                                    class="footer-link">Linkedin</a></li>
                            <li class="mb-2"><a href="{{ $settings['instagram_link'] ?? '#' }}" target="_blank"
                                    class="footer-link">Instagram</a></li>
                            <li class="mb-2"><a href="{{ $settings['facebook_link'] ?? '#' }}" target="_blank"
                                    class="footer-link">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom mt-5 pt-4 border-top border-light">
                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                    © <script>
                        document.write(new Date().getFullYear());
                    </script> by PT Asia Connexindo Internasional
                </p>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/front-main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/js/modal-add-new-address.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observerOptions = {
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            const targets = document.querySelectorAll('.reveal-on-scroll');
            targets.forEach(target => observer.observe(target));
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 0
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter-value');
            const duration = 2000;

            const animateCounter = (el) => {
                const target = +el.getAttribute('data-target');
                let startTime = null;

                const step = (currentTime) => {
                    if (!startTime) startTime = currentTime;
                    const progress = Math.min((currentTime - startTime) / duration, 1);

                    const currentValue = Math.floor(progress * target);

                    el.innerText = currentValue.toLocaleString('id-ID');

                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.innerText = target.toLocaleString('id-ID');
                    }
                };

                window.requestAnimationFrame(step);
            };

            const observerOptions = {
                threshold: 0.7,
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => observer.observe(counter));
        });
    </script>

    <!-- Custom Chat Widget -->
    <div id="custom-chat-widget" style="font-family: 'Public Sans', sans-serif;">
        <!-- Floating Chat Button -->
        <button id="chat-widget-trigger" class="btn p-0"
            style="position: fixed; bottom: 20px; right: 20px; width: 50px; height: 50px; border-radius: 50%; background-color: #FF5722; box-shadow: 0 4px 16px rgba(255, 87, 34, 0.4); border: none; z-index: 99999; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
            </svg>
        </button>

        <!-- Chat Popup Window -->
        <div id="chat-widget-window"
            style="position: fixed; bottom: 20px; right: 20px; width: 320px; height: 460px; border-radius: 12px; background-color: #ffffff; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15); border: 1px solid #eaeaea; z-index: 99999; display: none; flex-direction: column; overflow: hidden; transition: all 0.3s ease;">
            <!-- Header -->
            <div
                style="background-color: #FF5722; padding: 12px 14px; display: flex; align-items: center; position: relative;">
                <div
                    style="position: relative; width: 36px; height: 36px; border-radius: 50%; background-color: #ffffff; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-right: 10px; border: 1px solid #eaeaea;">
                    <img src="{{ asset('Logo.png') }}" alt="Logo" style="width: 22px; height: auto;">
                    <span
                        style="position: absolute; bottom: 0px; right: 0px; width: 8px; height: 8px; border-radius: 50%; background-color: #4caf50; border: 1px solid #ffffff;"></span>
                </div>
                <div>
                    <h6 style="color: #ffffff; margin: 0; font-weight: 700; font-size: 0.85rem; line-height: 1.2;">PT
                        Asia Connexindo Int...</h6>
                    <span style="color: rgba(255, 255, 255, 0.85); font-size: 0.7rem;">We'll reply as soon as we
                        can</span>
                </div>
                <button id="chat-widget-close"
                    style="position: absolute; top: 12px; right: 14px; background: none; border: none; color: #ffffff; font-size: 1.15rem; cursor: pointer; line-height: 1; padding: 0;">&times;</button>
            </div>

            <!-- Body / Chat Area -->
            <div id="chat-widget-body"
                style="flex-grow: 1; padding: 15px; overflow-y: auto; background-color: #f9f9f9; display: flex; flex-direction: column;">
                <!-- Live Chat View -->
                <div id="chat-view-live" style="display: flex; flex-direction: column; flex-grow: 1;">
                    <!-- Message Bubble: Testing -->
                    <div
                        style="align-self: flex-end; background-color: #FF5722; color: #ffffff; padding: 6px 12px; border-radius: 10px 10px 0 10px; font-size: 0.8rem; max-width: 80%; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(255, 87, 34, 0.15); word-break: break-word;">
                        testing
                    </div>

                    <!-- Lead Capture Card -->
                    <div id="chat-lead-card"
                        style="background-color: #ffffff; border: 1px solid #eaeaea; border-radius: 8px; padding: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); margin-bottom: 12px;">
                        <p
                            style="font-size: 0.78rem; color: #555555; line-height: 1.5; margin-bottom: 10px; font-weight: 500;">
                            Hey there, please leave your details so we can contact you even if you are no longer on the
                            site.
                        </p>
                        <form id="chat-lead-form" onsubmit="event.preventDefault(); submitChatLead();">
                            <div style="margin-bottom: 10px;">
                                <label
                                    style="display: block; font-size: 0.7rem; font-weight: 600; color: #333333; margin-bottom: 2px;">Name</label>
                                <input type="text" id="chat-lead-name" required
                                    style="width: 100%; border: none; border-bottom: 1px solid #cccccc; padding: 4px 0; font-size: 0.8rem; background-color: transparent; outline: none; transition: border-bottom-color 0.2s;"
                                    onfocus="this.style.borderBottomColor='#FF5722'"
                                    onblur="this.style.borderBottomColor='#cccccc'">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label
                                    style="display: block; font-size: 0.7rem; font-weight: 600; color: #333333; margin-bottom: 2px;">Email</label>
                                <input type="email" id="chat-lead-email" required
                                    style="width: 100%; border: none; border-bottom: 1px solid #cccccc; padding: 4px 0; font-size: 0.8rem; background-color: transparent; outline: none; transition: border-bottom-color 0.2s;"
                                    onfocus="this.style.borderBottomColor='#FF5722'"
                                    onblur="this.style.borderBottomColor='#cccccc'">
                            </div>
                            <button type="submit"
                                style="width: 100%; background-color: #000000; color: #ffffff; border: none; padding: 7px 0; font-weight: 600; font-size: 0.78rem; text-transform: uppercase; cursor: pointer; transition: background-color 0.2s;"
                                onmouseover="this.style.backgroundColor='#333333'"
                                onmouseout="this.style.backgroundColor='#000000'">Submit</button>
                        </form>
                    </div>

                    <!-- Success Message (Hidden Initially) -->
                    <div id="chat-success-message"
                        style="display: none; align-self: flex-start; background-color: #ffffff; border: 1px solid #eaeaea; border-radius: 8px 8px 8px 0; padding: 10px 14px; font-size: 0.8rem; max-width: 85%; box-shadow: 0 2px 8px rgba(0,0,0,0.02); line-height: 1.5; color: #333333;">
                        Thank you! We have received your details and will get in touch with you shortly.
                    </div>
                </div>

                <!-- WhatsApp View -->
                <div id="chat-view-wa"
                    style="display: none; flex-direction: column; flex-grow: 1; justify-content: flex-start; padding-top: 10px;">
                    <!-- WhatsApp Card -->
                    <div
                        style="background-color: #ffffff; border: 1px solid #eaeaea; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
                        <p
                            style="font-size: 0.82rem; color: #333333; line-height: 1.6; margin-bottom: 20px; font-weight: 400;">
                            We're available on WhatsApp during Mon - Fri, 08:00 - 17:00. We'd love to hear from you.
                        </p>
                        <a href="https://wa.me/6281910001999?text=Hi%2C%20I%20have%20an%20inquiry%20regarding%20shipping%20services."
                            target="_blank"
                            style="display: inline-flex; align-items: center; justify-content: center; background-color: #3CA290; color: #ffffff; border: none; padding: 8px 18px; border-radius: 18px; font-weight: 600; font-size: 0.8rem; text-decoration: none; cursor: pointer; transition: background-color 0.2s;"
                            onmouseover="this.style.backgroundColor='#328879'"
                            onmouseout="this.style.backgroundColor='#3CA290'">
                            Open WhatsApp
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link"
                                width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="#ffffff" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                <path d="M11 13l9 -9" />
                                <path d="M15 4h5v5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer / Input and Channels Area -->
            <div
                style="background-color: #ffffff; border-top: 1px solid #eaeaea; padding: 10px 12px; display: flex; flex-direction: column;">
                <!-- Emoji Picker Panel -->
                <div id="chat-emoji-picker" style="display: none; flex-wrap: wrap; gap: 4px; padding: 8px 4px 4px; border-top: 1px solid #f1f1f1; max-height: 110px; overflow-y: auto; margin-bottom: 4px;">
                    <!-- Emoji list injected by JS -->
                </div>

                <!-- Image Preview Area -->
                <div id="chat-image-preview-wrap" style="display:none; margin-bottom: 6px;">
                    <div style="position:relative; display:inline-block;">
                        <img id="chat-image-preview" src="" style="max-height:80px; max-width:100%; border-radius:8px; border:1px solid #eaeaea;" />
                        <button onclick="removeChatImage()" style="position:absolute; top:-6px; right:-6px; background:#FF5722; color:#fff; border:none; border-radius:50%; width:18px; height:18px; font-size:0.65rem; cursor:pointer; line-height:18px; padding:0;">✕</button>
                    </div>
                </div>

                <!-- Message Input -->
                <div id="chat-input-area" style="display: flex; align-items: center; margin-bottom: 8px;">
                    <input type="text" id="chat-message-input" placeholder="Write your message..."
                        style="flex-grow: 1; border: none; font-size: 0.8rem; outline: none; padding: 4px 0; color: #333333;"
                        onkeypress="handleChatInputKeyPress(event)">
                    <div style="display: flex; gap: 6px; align-items: center; margin-left: 6px;">
                        <!-- Emoji Toggle -->
                        <button id="chat-emoji-btn" onclick="toggleEmojiPicker()" title="Emoji"
                            style="background:none; border:none; cursor:pointer; padding:2px; font-size:1.1rem; line-height:1; display:flex; align-items:center;">😊</button>
                        <!-- Photo Upload -->
                        <button onclick="document.getElementById('chat-file-input').click()" title="Attach photo"
                            style="background:none; border:none; cursor:pointer; padding:2px; display:flex; align-items:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#aaaaaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </button>
                        <input type="file" id="chat-file-input" accept="image/*" style="display:none;" onchange="handleChatImageUpload(event)">
                        <!-- Send Button -->
                        <button onclick="sendChatMessage()" title="Send"
                            style="background:#FF5722; border:none; cursor:pointer; padding:5px 7px; border-radius:6px; display:flex; align-items:center; transition: background 0.2s;"
                            onmouseover="this.style.background='#e64a19'" onmouseout="this.style.background='#FF5722'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Channels / Tabs -->
                <div id="chat-channels-area"
                    style="display: flex; border-top: 1px solid #f1f1f1; padding-top: 8px; gap: 8px;">
                    <!-- Live Chat Tab -->
                    <button id="chat-tab-live"
                        style="flex: 1; background-color: #ffffff; border: 1px solid #eaeaea; padding: 5px 0; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
                        onclick="toggleChatTab('live')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message" width="16"
                            height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#FF5722" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                        </svg>
                    </button>
                    <!-- WhatsApp Tab -->
                    <button id="chat-tab-wa"
                        style="flex: 1; background-color: #f7f7f7; border: 1px solid #eaeaea; padding: 5px 0; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;"
                        onclick="toggleChatTab('wa')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp"
                            width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="#888888" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path
                                d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const trigger = document.getElementById('chat-widget-trigger');
            const windowEl = document.getElementById('chat-widget-window');
            const closeBtn = document.getElementById('chat-widget-close');
            
            trigger.addEventListener('click', function() {
                if (windowEl.style.display === 'none' || windowEl.style.display === '') {
                    windowEl.style.display = 'flex';
                    windowEl.style.opacity = '0';
                    windowEl.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        windowEl.style.transition = 'all 0.3s ease';
                        windowEl.style.opacity = '1';
                        windowEl.style.transform = 'translateY(0)';
                    }, 10);
                    // Hide the floating trigger icon to cover it
                    trigger.style.display = 'none';
                } else {
                    windowEl.style.display = 'none';
                }
            });

            closeBtn.addEventListener('click', function() {
                windowEl.style.display = 'none';
                // Show the floating trigger icon again
                trigger.style.display = 'flex';
            });
        });

        function submitChatLead() {
            const name = document.getElementById('chat-lead-name').value;
            const email = document.getElementById('chat-lead-email').value;
            
            if (name && email) {
                document.getElementById('chat-lead-card').style.display = 'none';
                document.getElementById('chat-success-message').style.display = 'block';
            }
        }

        function toggleChatTab(type) {
            const liveTab = document.getElementById('chat-tab-live');
            const waTab = document.getElementById('chat-tab-wa');
            const liveView = document.getElementById('chat-view-live');
            const waView = document.getElementById('chat-view-wa');
            const inputArea = document.getElementById('chat-input-area');
            const channelsArea = document.getElementById('chat-channels-area');
            
            const liveSvg = liveTab.querySelector('svg');
            const waSvg = waTab.querySelector('svg');

            if (type === 'live') {
                // Set Live Chat active
                liveTab.style.backgroundColor = '#ffffff';
                if (liveSvg) liveSvg.setAttribute('stroke', '#FF5722');
                
                // Set WhatsApp inactive
                waTab.style.backgroundColor = '#f7f7f7';
                if (waSvg) waSvg.setAttribute('stroke', '#888888');
                
                // Toggle view content
                liveView.style.display = 'flex';
                waView.style.display = 'none';
                
                // Show input area and set tab border
                inputArea.style.display = 'flex';
                channelsArea.style.borderTop = '1px solid #f1f1f1';
                channelsArea.style.paddingTop = '8px';
            } else if (type === 'wa') {
                // Set WhatsApp active
                waTab.style.backgroundColor = '#ffffff';
                if (waSvg) waSvg.setAttribute('stroke', '#25D366');
                
                // Set Live Chat inactive
                liveTab.style.backgroundColor = '#f7f7f7';
                if (liveSvg) liveSvg.setAttribute('stroke', '#888888');
                
                // Toggle view content
                liveView.style.display = 'none';
                waView.style.display = 'flex';
                
                // Hide input area and remove tab border
                inputArea.style.display = 'none';
                channelsArea.style.borderTop = 'none';
                channelsArea.style.paddingTop = '0';
            }
        }

        /* ─── Emoji Picker ─── */
        const CHAT_EMOJIS = [
            '😊','😂','🥰','😍','🤩','😎','🙌','👍','👏','🙏',
            '❤️','🧡','💛','💚','💙','💜','🔥','✨','🎉','🎊',
            '🚀','📦','🛳️','✈️','🌍','📞','📧','💬','🕐','✅',
            '❌','⚠️','📌','📎','🖇️','📋','📄','🖊️','💡','🔍'
        ];

        (function initEmojiPicker() {
            const picker = document.getElementById('chat-emoji-picker');
            CHAT_EMOJIS.forEach(em => {
                const span = document.createElement('span');
                span.textContent = em;
                span.style.cssText = 'font-size:1.3rem; cursor:pointer; padding:3px; border-radius:4px; transition:background 0.15s;';
                span.onmouseover = () => span.style.background = '#f1f1f1';
                span.onmouseout  = () => span.style.background = 'transparent';
                span.onclick = () => {
                    const inp = document.getElementById('chat-message-input');
                    inp.value += em;
                    inp.focus();
                };
                picker.appendChild(span);
            });
        })();

        function toggleEmojiPicker() {
            const picker = document.getElementById('chat-emoji-picker');
            picker.style.display = picker.style.display === 'flex' ? 'none' : 'flex';
        }

        /* ─── Image Upload ─── */
        let chatPendingImageDataUrl = null;

        function handleChatImageUpload(event) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                chatPendingImageDataUrl = e.target.result;
                const preview = document.getElementById('chat-image-preview');
                const wrap    = document.getElementById('chat-image-preview-wrap');
                preview.src = chatPendingImageDataUrl;
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(file);
            event.target.value = '';
        }

        function removeChatImage() {
            chatPendingImageDataUrl = null;
            document.getElementById('chat-image-preview').src = '';
            document.getElementById('chat-image-preview-wrap').style.display = 'none';
        }

        /* ─── Send Message ─── */
        function sendChatMessage() {
            const input   = document.getElementById('chat-message-input');
            const message = input.value.trim();
            const body    = document.getElementById('chat-widget-body');

            // Close emoji picker if open
            document.getElementById('chat-emoji-picker').style.display = 'none';

            // Send pending image
            if (chatPendingImageDataUrl) {
                const imgBubble = document.createElement('div');
                imgBubble.style.cssText = 'align-self:flex-end; max-width:80%; margin-bottom:10px;';
                const img = document.createElement('img');
                img.src = chatPendingImageDataUrl;
                img.style.cssText = 'max-width:100%; max-height:150px; border-radius:10px 10px 0 10px; display:block; box-shadow:0 2px 8px rgba(0,0,0,0.12);';
                imgBubble.appendChild(img);
                body.appendChild(imgBubble);
                removeChatImage();
                body.scrollTop = body.scrollHeight;
            }

            // Send text
            if (message) {
                const msgBubble = document.createElement('div');
                msgBubble.style.cssText = 'align-self:flex-end; background-color:#FF5722; color:#ffffff; padding:6px 12px; border-radius:10px 10px 0 10px; font-size:0.8rem; max-width:80%; margin-bottom:10px; box-shadow:0 2px 4px rgba(255,87,34,0.15); word-break:break-word;';
                msgBubble.textContent = message;
                body.appendChild(msgBubble);
                input.value = '';
                body.scrollTop = body.scrollHeight;

                if (document.getElementById('chat-lead-card').style.display === 'none') {
                    setTimeout(() => {
                        const replyBubble = document.createElement('div');
                        replyBubble.style.cssText = 'align-self:flex-start; background-color:#ffffff; border:1px solid #eaeaea; border-radius:8px 8px 8px 0; padding:10px 14px; font-size:0.8rem; max-width:85%; box-shadow:0 2px 8px rgba(0,0,0,0.02); line-height:1.5; color:#333333; margin-bottom:10px; word-break:break-word;';
                        replyBubble.textContent = 'Thank you for your message! Our team will get back to you shortly.';
                        body.appendChild(replyBubble);
                        body.scrollTop = body.scrollHeight;
                    }, 1000);
                }
            }
        }

        function handleChatInputKeyPress(event) {
            if (event.key === 'Enter') sendChatMessage();
        }
    </script>
</body>

</html>