<x-app-user-layout>
    @push('styles')
    <style>
        /* ── Registration Page Senior UI/UX Theme ── */
        .reg-hero-card {
            background: linear-gradient(135deg, #0b1f3a 0%, #0f4c81 55%, #1e3a8a 100%);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 20px 45px -15px rgba(15, 76, 129, 0.35);
        }

        .reg-hero-card::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .reg-hero-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .reg-pill-badge {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Visual Stepper Header */
        .stepper-container {
            background: #ffffff;
            border-radius: 16px;
            padding: 1.25rem 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 2rem;
        }

        .stepper-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 780px;
            margin: 0 auto;
        }

        .stepper-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 700;
            font-size: 0.875rem;
            color: #64748b;
        }

        .stepper-item.active {
            color: #0f4c81;
        }

        .stepper-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 800;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .stepper-item.active .stepper-number {
            background: linear-gradient(135deg, #0f4c81 0%, #1e3a8a 100%);
            color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 4px 10px rgba(15, 76, 129, 0.25);
        }

        .stepper-line {
            height: 2px;
            flex: 1;
            max-width: 90px;
            background: #e2e8f0;
            margin: 0 0.5rem;
        }

        /* 3D Process Cards */
        .step-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 2.25rem 1.75rem 1.75rem 1.75rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .step-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 45px -12px rgba(15, 76, 129, 0.15);
            border-color: #cbd5e1;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: transparent;
            transition: background 0.3s ease;
        }

        .step-card-1:hover::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .step-card-2:hover::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .step-card-3:hover::before { background: linear-gradient(90deg, #10b981, #34d399); }

        /* 3D Image Wrapper */
        .img-3d-wrapper {
            position: relative;
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: radial-gradient(circle at center, rgba(248, 250, 252, 1) 0%, rgba(255, 255, 255, 0) 70%);
        }

        .img-3d-wrapper::after {
            content: '';
            position: absolute;
            bottom: 8px;
            width: 140px;
            height: 20px;
            background: radial-gradient(ellipse at center, rgba(15, 76, 129, 0.16) 0%, rgba(0, 0, 0, 0) 75%);
            border-radius: 50%;
            z-index: 1;
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        .img-3d-wrapper img {
            max-height: 165px;
            max-width: 100%;
            object-fit: contain;
            z-index: 2;
            transition: transform 0.4s ease;
            animation: float3d 5s ease-in-out infinite;
            filter: drop-shadow(0 12px 20px rgba(0,0,0,0.06));
        }

        .step-card:hover .img-3d-wrapper img {
            transform: scale(1.08) translateY(-4px);
        }

        .step-card:hover .img-3d-wrapper::after {
            transform: scale(0.9);
            opacity: 0.7;
        }

        @keyframes float3d {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .step-badge {
            position: absolute;
            top: 1.25rem;
            left: 1.25rem;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 8px;
            z-index: 3;
        }

        .step-badge-1 { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .step-badge-2 { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .step-badge-3 { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }

        .step-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.6rem;
            letter-spacing: -0.2px;
        }

        .step-desc {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        /* Action Buttons & Boxes */
        .btn-action-mail {
            background: linear-gradient(135deg, #0f4c81 0%, #1d4ed8 100%);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 0.875rem;
            border-radius: 12px;
            padding: 12px 18px;
            box-shadow: 0 4px 14px rgba(15, 76, 129, 0.25);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-decoration: none;
            border: none;
        }

        .btn-action-mail:hover {
            box-shadow: 0 8px 22px rgba(15, 76, 129, 0.4);
            transform: translateY(-2px);
        }

        .btn-action-login {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 0.875rem;
            border-radius: 12px;
            padding: 12px 18px;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            text-decoration: none;
            border: none;
        }

        .btn-action-login:hover {
            box-shadow: 0 8px 22px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .security-info-box {
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.825rem;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Features Section */
        .benefit-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 1.75rem 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            height: 100%;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            border-color: #cbd5e1;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.06);
        }

        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-bottom: 1.25rem;
        }

        .benefit-icon-1 { background: #eff6ff; color: #2563eb; }
        .benefit-icon-2 { background: #fff7ed; color: #ea580c; }
        .benefit-icon-3 { background: #f0fdf4; color: #16a34a; }

        .support-banner {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 2.25rem 2rem;
        }

        @media (max-width: 767.98px) {
            .stepper-nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            .stepper-line {
                display: none;
            }
        }
    </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Hero Banner Section -->
        <div class="reg-hero-card mb-4 p-4 p-md-5">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8">
                    <div class="reg-pill-badge mb-3">
                        <i class="ti ti-shield-check text-warning"></i> ASCON CLIENT PORTAL
                    </div>
                    <h3 class="text-white fw-extrabold mb-3" style="font-size: clamp(1.1rem, 2.2vw, 1.75rem); letter-spacing: -0.5px; white-space: nowrap;">
                        Customer Registration Guide & Workflow
                    </h3>
                    <p class="text-white-50 mb-4 fs-6" style="max-width: 640px; line-height: 1.7;">
                        An exclusive facility for <strong>PT Asia Connexindo Internasional</strong> clients to access 
                        <span class="text-white fw-bold">Live Shipment Tracking</span> and real-time <span class="text-white fw-bold">Freight Rates & Tariffs</span>.
                    </p>

                    <!-- Feature Tags -->
                    <div class="d-flex flex-wrap gap-3 text-white-50 small">
                        <div class="d-flex align-items-center gap-1.5">
                            <i class="ti ti-circle-check-filled text-success me-1"></i> Official Management Verification
                        </div>
                        <div class="d-flex align-items-center gap-1.5">
                            <i class="ti ti-circle-check-filled text-success me-1"></i> 24/7 Container Tracking
                        </div>
                        <div class="d-flex align-items-center gap-1.5">
                            <i class="ti ti-circle-check-filled text-success me-1"></i> Secure Customer Code Access
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 text-center d-none d-lg-block">
                    <img src="{{ asset('assets/img/front-pages/landing-page/cta-dashboard.png') }}"
                        alt="Customer Portal ASCON" class="img-fluid" style="max-height: 190px; filter: drop-shadow(0 15px 25px rgba(0,0,0,0.3));">
                </div>
            </div>
        </div>

        <!-- Stepper Indicator Header -->
        <div class="stepper-container">
            <div class="stepper-nav">
                <div class="stepper-item active">
                    <div class="stepper-number">1</div>
                    <span>Email Request</span>
                </div>
                <div class="stepper-line"></div>
                <div class="stepper-item active">
                    <div class="stepper-number">2</div>
                    <span>Customer Code Issued</span>
                </div>
                <div class="stepper-line"></div>
                <div class="stepper-item active">
                    <div class="stepper-number">3</div>
                    <span>Live Tracking Access</span>
                </div>
            </div>
        </div>

        <!-- 3-Step Interactive Process Cards -->
        <div class="row g-4 mb-5">
            <!-- Step 1 Card -->
            <div class="col-lg-4 col-md-6">
                <div class="step-card step-card-1">
                    <span class="step-badge step-badge-1">Step 01</span>

                    <div class="img-3d-wrapper">
                        <img src="{{ asset('assets/img/elements/c1.png') }}" alt="Registration Email Request">
                    </div>

                    <h4 class="step-title">Submit Registration Email</h4>
                    <p class="step-desc">
                        Clients submit a formal registration request via <strong>Email</strong> to ASCON management for account identity and company verification.
                    </p>

                    <div>
                        <a href="{{ route('public.customer-registration.form') }}" class="btn-action-mail">
                            <i class="ti ti-mail-forward fs-5"></i> Submit Registration Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Step 2 Card -->
            <div class="col-lg-4 col-md-6">
                <div class="step-card step-card-2">
                    <span class="step-badge step-badge-2">Step 02</span>

                    <div class="img-3d-wrapper">
                        <img src="{{ asset('assets/img/elements/c2.png') }}" alt="Receive Customer Code">
                    </div>

                    <h4 class="step-title">Receive Customer Code</h4>
                    <p class="step-desc">
                        Upon approval, ASCON management will issue a unique <strong>Customer Code</strong> that serves as your official password to access the portal.
                    </p>

                    <div>
                        <div class="security-info-box">
                            <i class="ti ti-shield-lock-filled text-warning fs-4"></i>
                            <div>
                                <strong>Official Password Issued</strong>
                                <div class="text-muted small">Directly issued by ASCON Administration.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 Card -->
            <div class="col-lg-4 col-md-6">
                <div class="step-card step-card-3">
                    <span class="step-badge step-badge-3">Step 03</span>

                    <div class="img-3d-wrapper">
                        <img src="{{ asset('assets/img/elements/c3.png') }}" alt="Access Portal Tracking">
                    </div>

                    <h4 class="step-title">Access Tracking & Rates</h4>
                    <p class="step-desc">
                        Use your <strong>registered email</strong> and issued <strong>Customer Code</strong> to log in and unlock full portal features and shipment updates.
                    </p>

                    <div>
                        <a href="/login" class="btn-action-login">
                            <i class="ti ti-login fs-5"></i> Log In To Portal Now
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portal Benefits Section -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <span class="badge bg-label-primary px-3 py-2 fw-bold rounded-pill text-uppercase">Why Use ASCON Portal?</span>
                <h3 class="fw-extrabold text-dark mt-2 mb-1">Key Advantages of Client Portal Access</h3>
                <p class="text-muted small">Seamless logistics tracking and rate transparency at your fingertips</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-1">
                            <i class="ti ti-radar"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Live Shipment Tracking</h5>
                        <p class="text-muted small mb-0">
                            Track container locations and current cargo movement status accurately with 24/7 updates.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-2">
                            <i class="ti ti-cash-banknote"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Transparent Rates & Schedules</h5>
                        <p class="text-muted small mb-0">
                            Access real-time freight tariffs and vessel departure schedules directly without delays.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-3">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Organized History & Documents</h5>
                        <p class="text-muted small mb-0">
                            All your past shipping records and invoices are securely stored in a centralized database.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Need Support / Help Callout -->
        <div class="support-banner">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white p-3 rounded-circle d-none d-sm-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                            <i class="ti ti-headset fs-2"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Need Help With Account Registration?</h5>
                            <p class="text-muted small mb-0">
                                ASCON Customer Support team is ready to assist with your registration or Customer Code inquiry.
                            </p>
                        </div>
                    </div>
                </div>
                @php
                    $rawWa = $settings['whatsapp'] ?? \App\Models\Setting::where('key', 'whatsapp')->value('value') ?? '6281133300888';
                    $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
                    if (empty($cleanWa)) {
                        $cleanWa = '6281133300888';
                    }
                    $contactEmail = $settings['email'] ?? \App\Models\Setting::where('key', 'email')->value('value') ?? 'admin@asiaconnex.net';
                @endphp
                <div class="col-md-4 text-md-end">
                    <a href="mailto:{{ $contactEmail }}" class="btn btn-outline-primary fw-bold me-2">
                        <i class="ti ti-mail me-1"></i> Email Support
                    </a>
                    <a href="https://wa.me/{{ $cleanWa }}?text=Hello%20ASCON%20Support,%20I%20need%20assistance%20with%20Customer%20Portal%20registration." target="_blank" class="btn btn-success fw-bold">
                        <i class="ti ti-brand-whatsapp me-1"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-app-user-layout>