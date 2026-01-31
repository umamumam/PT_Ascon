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

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
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
                            <a class="nav-link fw-medium" href="/services">Services</a>
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
                        <a href="{{ route('login') }}" class="btn btn-primary"><span
                                class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                class="d-none d-md-block">Login/Register</span></a>
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
    <footer class="landing-footer bg-body footer-text">
        <div class="footer-top position-relative overflow-hidden z-1">
            <img src="{{ asset('assets/img/front-pages/backgrounds/footer-bg-light.png') }}" alt="footer bg"
                class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />

            <div class="container">
                <div class="row gx-0 gy-6 g-lg-10">
                    <div class="col-lg-4">
                        <a href="/" class="app-brand-link mb-6">
                            <span
                                class="app-brand-logo d-inline-flex align-items-center justify-content-center bg-white p-2 rounded shadow-sm">
                                <img src="Logo.png" alt="Asia Connexindo" class="d-block"
                                    style="max-width: 100px; height: auto;">
                            </span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-orange text-white"
                            style="background-color: #FF5722;">Contact Us</a>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-6 fw-bold">Head Office</h6>
                        <ul class="list-unstyled footer-text mb-6">
                            <li class="mb-3">Soepomo Office Park, Blok O</li>
                            <li class="mb-3">Jl. Prof. Dr. Supomo No. 143</li>
                            <li class="mb-3">Tebet, Jakarta Selatan 12870</li>
                            <li class="mb-4">Indonesia</li>
                            <li class="small text-muted">Phone:</li>
                            <li>+62 21 8379 1179</li>
                            <li>+62 21 8379 1183</li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-6 fw-bold">Semarang Office</h6>
                        <ul class="list-unstyled footer-text mb-6">
                            <li class="mb-3">SETOS CO WORK</li>
                            <li class="mb-3">MG Setos, Jl. Inspeksi Lt 3,</li>
                            <li class="mb-3">Kembangsari, Semarang Tengah,</li>
                            <li class="mb-4">Jawa Tengah, Indonesia 50133</li>
                            <li class="small text-muted">Phone:</li>
                            <li>+62 24 8604 1230 Ext. 105</li>
                            <li>+62 24 7644 1991</li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-4">
                        <h6 class="footer-title mb-6 fw-bold">Socials</h6>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-3"><a href="#" class="footer-link">Linkedin</a></li>
                            <li class="mb-3"><a href="#" class="footer-link">Instagram</a></li>
                            <li class="mb-3"><a href="#" class="footer-link">Facebook</a></li>
                        </ul>
                        <h6 class="footer-title mb-2 fw-bold">Inquiries</h6>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-3"><a href="#" class="footer-link">WA: +62 21 819 1000 1999</a></li>
                            <li class="mb-3"><a href="#" class="footer-link">admin@asiaconnex.net</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom py-3 py-md-5">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-bottom-text">©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        PT Asia Connexindo Internasional.
                    </span>
                </div>
                <div>
                    <a href="#" class="me-3"><img src="{{ asset('assets/img/front-pages/icons/facebook.svg') }}"
                            alt="facebook" /></a>
                    <a href="#" class="me-3"><img src="{{ asset('assets/img/front-pages/icons/twitter.svg') }}"
                            alt="twitter" /></a>
                    <a href="#"><img src="{{ asset('assets/img/front-pages/icons/instagram.svg') }}" alt="instagram" /></a>
                </div>
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

    <!-- Main JS -->
    <script src="{{ asset('assets/js/front-main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
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
</body>

</html>
