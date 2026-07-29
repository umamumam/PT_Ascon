<x-app-user-layout>
    @push('styles')
    <style>
        /* ── ASCON Customer Portal - Senior Enterprise UI/UX Theme ── */
        .page-header-block {
            margin-bottom: 2rem;
        }

        .page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .page-breadcrumb a {
            color: #0f4c81;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .page-breadcrumb a:hover {
            color: #0a345c;
            text-decoration: underline;
        }

        .page-title-text {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .page-subtitle-text {
            font-size: 0.9375rem;
            color: #475569;
            max-width: 720px;
            margin-bottom: 0;
            line-height: 1.6;
        }

        .enterprise-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid #bfdbfe;
            font-size: 0.725rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* ── Main Form Card Container ── */
        .reg-form-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        /* Left Side: Context & Guidelines Panel */
        .reg-info-side {
            background: #f8fafc;
            padding: 2.5rem 2rem;
            border-right: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-section-tag {
            font-size: 0.725rem;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .reg-info-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.75rem;
            letter-spacing: -0.01em;
        }

        .reg-info-desc {
            font-size: 0.875rem;
            color: #475569;
            line-height: 1.65;
            margin-bottom: 2rem;
        }

        /* Enterprise Trust Feature List */
        .trust-feature-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .trust-feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .trust-icon-box {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.15rem;
        }

        .trust-icon-box.blue {
            background: #eff6ff;
            color: #0f4c81;
            border: 1px solid #dbeafe;
        }

        .trust-icon-box.green {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #dcfce7;
        }

        .trust-icon-box.amber {
            background: #fefce8;
            color: #854d0e;
            border: 1px solid #fef9c3;
        }

        .trust-feature-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .trust-feature-desc {
            font-size: 0.8125rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Support Callout Box */
        .support-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem;
        }

        .support-card-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .support-card-desc {
            font-size: 0.8125rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        /* Right Side: Form Content */
        .reg-form-side {
            padding: 2.5rem;
        }

        .form-header-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: #0f172a;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Clean Label & Standard Input Control */
        .custom-form-label {
            font-weight: 600;
            color: #334155;
            font-size: 0.875rem;
            margin-bottom: 0.4rem;
            display: block;
        }

        .reg-form-side .form-control {
            border-radius: 8px !important;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 0.9rem;
            font-size: 0.9rem;
            background: #ffffff;
            color: #0f172a;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .reg-form-side .form-control:focus {
            border-color: #0f4c81;
            box-shadow: 0 0 0 3px rgba(15, 76, 129, 0.12);
        }

        .reg-form-side textarea.form-control {
            line-height: 1.6;
        }

        /* Development Sandbox Box */
        .sandbox-mode-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 3px solid #0f4c81;
            border-radius: 10px;
            padding: 1.25rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .sandbox-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 0.75rem;
        }

        .sandbox-label {
            font-weight: 600;
            color: #0f172a;
            font-size: 0.875rem;
        }

        .sandbox-badge {
            background: #e0e7ff;
            color: #3730a3;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 4px;
        }

        .sandbox-desc {
            font-size: 0.8125rem;
            color: #64748b;
            margin-top: 0.65rem;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.5;
        }

        /* Action Buttons Footer */
        .form-footer-actions {
            margin-top: 2.25rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-form-secondary {
            color: #334155;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.65rem 1.25rem;
            text-decoration: none;
            transition: all 0.15s ease;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
        }

        .btn-form-secondary:hover {
            background-color: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }

        .btn-form-submit {
            background: #0f4c81;
            color: #ffffff !important;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.65rem 1.75rem;
            font-size: 0.875rem;
            transition: all 0.15s ease;
            box-shadow: 0 2px 6px rgba(15, 76, 129, 0.2);
            display: inline-flex;
            align-items: center;
        }

        .btn-form-submit:hover {
            background: #0a345c;
            box-shadow: 0 4px 12px rgba(15, 76, 129, 0.3);
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            .reg-info-side {
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
            }

            .reg-form-side {
                padding: 1.75rem;
            }
        }
    </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Page Header & Breadcrumb -->
        <div class="page-header-block">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="page-title-text">Customer Registration Form</h1>
                    <p class="page-subtitle-text">
                        Fill out your details below to request your ASCON Customer Code.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Form Card Layout -->
        <div class="reg-form-card mb-5">
            <div class="row g-0">

                <!-- Left Column: Context & Trust Signals -->
                <div class="col-lg-4 reg-info-side">
                    <div>
                        <div class="info-section-tag">INFORMATION</div>
                        <h2 class="reg-info-title">Account Request</h2>
                        <p class="reg-info-desc">
                            Requests are reviewed by our team to issue your official Customer Code.
                        </p>

                        <!-- Illustration Image -->
                        <div class="d-flex justify-content-center align-items-center text-center my-4 py-2 w-100">
                            <img src="{{ asset('assets/img/illustrations/auth-two-step-illustration-light.png') }}"
                                alt="Registration Illustration" class="img-fluid"
                                style="max-height: 280px; max-width: 100%; object-fit: contain; margin: 0 auto; display: block;">
                        </div>

                        <!-- Enterprise Feature Highlights -->
                    </div>

                    @php
                    $rawWa = $settings['whatsapp'] ?? \App\Models\Setting::where('key', 'whatsapp')->value('value') ??
                    '6281133300888';
                    $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
                    if (empty($cleanWa)) {
                    $cleanWa = '6281133300888';
                    }
                    @endphp

                    <!-- Direct Support Box -->
                    <div class="support-card">
                        <div class="support-card-title">Need Assistance?</div>
                        <div class="support-card-desc">Questions regarding registration?</div>
                        <a href="https://wa.me/{{ $cleanWa }}" target="_blank"
                            class="btn btn-sm btn-outline-success w-100 fw-semibold">
                            <i class="ti ti-brand-whatsapp me-1"></i> WhatsApp CS
                        </a>
                    </div>
                </div>

                <!-- Right Column: Registration Input Form -->
                <div class="col-lg-8 reg-form-side">
                    <div class="form-header-title">
                        <span>Registration Details</span>
                        <span class="text-muted fw-normal fs-tiny">* Required</span>
                    </div>

                    <form id="standaloneRegForm" action="{{ route('public.customer-registration.submit') }}"
                        method="POST">
                        @csrf
                        <div class="row g-4">

                            <!-- Full Name / Company Name -->
                            <div class="col-md-6">
                                <label class="custom-form-label">Full Name / Company Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control"
                                    value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                    placeholder="e.g. John Doe / PT Logistics Jaya" required autofocus>
                            </div>

                            <!-- Sender Email Address -->
                            <div class="col-md-6">
                                <label class="custom-form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                    placeholder="e.g. client@company.com" required>
                            </div>

                            <!-- Subject -->
                            <div class="col-12">
                                <label class="custom-form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control" value="Register Account"
                                    required>
                            </div>

                            <!-- Hidden Target Recipient Email -->
                            @php
                            $defaultTargetEmail = auth()->check() ? auth()->user()->email : ($settings['email'] ??
                            \App\Models\Setting::where('key', 'email')->value('value') ?? 'admin@asiaconnex.net');
                            @endphp
                            <input type="hidden" name="target_email" value="{{ $defaultTargetEmail }}">

                            <!-- Message / Company Details -->
                            <div class="col-12">
                                <label class="custom-form-label">Message / Details <span
                                        class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="8"
                                    placeholder="Enter registration details..." required>Dear ASCON Team,

I would like to request registration for an ASCON Customer Portal account.

Company / Client Name: [Your Company]
Phone / WhatsApp: [Your Phone]
Address: [Your Address]

Thank you.</textarea>
                            </div>

                        </div>

                        <!-- Form Footer Actions -->
                        <div class="form-footer-actions">
                            <a href="{{ route('public.customer-registration') }}" class="btn-form-secondary">
                                <i class="ti ti-arrow-left me-1.5"></i> Back
                            </a>
                            <button type="submit" class="btn btn-form-submit">
                                <i class="ti ti-send me-1.5"></i> Submit Request
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('standaloneRegForm');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    
                    const btn = form.querySelector('button[type="submit"]');
                    const originalText = btn.innerHTML;
                    
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';
                    btn.disabled = true;
                    
                    const formData = new FormData(form);
                    
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) {
                            if (response.status === 422 && data.errors) {
                                let errorMsg = Object.values(data.errors).flat().join('<br>');
                                throw new Error(errorMsg);
                            }
                            throw new Error(data.message || 'Server error occurred.');
                        }
                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Application Submitted!',
                                text: data.message || 'Account registration request sent successfully.',
                                confirmButtonColor: '#0f4c81',
                                customClass: {
                                    confirmButton: 'btn btn-primary px-4'
                                }
                            });
                            form.reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Notice',
                                text: data.message || 'Failed to submit application.',
                                confirmButtonColor: '#0f4c81'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Error',
                            html: error.message || 'An error occurred while contacting the server.',
                            confirmButtonColor: '#0f4c81'
                        });
                    })
                    .finally(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    });
                });
            }
        });
    </script>
    @endpush
</x-app-user-layout>