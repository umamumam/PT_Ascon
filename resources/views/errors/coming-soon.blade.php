<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rates & Tariffs – Coming Soon | PT Asia Connexindo Internasional</title>
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            overflow-y: auto;
        }

        /* Animated background blobs */
        body::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 87, 34, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: blobFloat 8s ease-in-out infinite;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -200px;
            left: -200px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 87, 34, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: blobFloat 10s ease-in-out infinite reverse;
            pointer-events: none;
        }

        @keyframes blobFloat {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.05);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.98);
            }
        }

        .error-card {
            background: #ffffff;
            border: 1px solid #ebebeb;
            border-radius: 20px;
            padding: 40px 45px 35px;
            max-width: 560px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            position: relative;
            z-index: 1;
            margin: 30px auto;
            animation: cardIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo-wrap {
            margin-bottom: 24px;
        }

        .logo-wrap img {
            height: 100px;
            width: auto;
            object-fit: contain;
        }

        .coming-badge {
            display: inline-block;
            background: rgba(255, 87, 34, 0.1);
            color: #FF5722;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .error-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: block;
            animation: iconBounce 2.5s ease-in-out infinite;
        }

        @keyframes iconBounce {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .error-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .error-desc {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FF5722;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 16px rgba(255, 87, 34, 0.3);
        }

        .btn-primary:hover {
            background: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 87, 34, 0.35);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #555;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.88rem;
            border: 1.5px solid #ddd;
            transition: all 0.2s ease;
        }

        .btn-ghost:hover {
            border-color: #FF5722;
            color: #FF5722;
            transform: translateY(-2px);
        }

        .divider {
            border: none;
            border-top: 1px solid #f1f1f1;
            margin: 36px 0 24px;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .footer-links a {
            font-size: 0.8rem;
            color: #aaa;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #FF5722;
        }
    </style>
</head>

<body>
    <div class="error-card">
        <div class="logo-wrap">
            <a href="/">
                <img src="{{ asset('Logo.png') }}" alt="PT Asia Connexindo Internasional">
            </a>
        </div>

        <span class="coming-badge">Coming Soon</span>
        <span class="error-icon">🚀</span>
        <h1 class="error-title">Rates & Tariffs</h1>
        <p class="error-desc">
            Our freight rate calculator and shipping cost estimator is currently under development.<br>
            For immediate quotes and rate inquiries, please get in touch with our team!
        </p>

        <div class="btn-group">
            <a href="javascript:history.back()" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back
            </a>
            <a href="/contact" class="btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                Contact Us
            </a>
        </div>

        <hr class="divider">

        <div class="footer-links">
            <a href="/services">Services</a>
            <a href="/sailing">Sailing Schedule</a>
            <a href="/etracking">Cargo Tracking</a>
            <a href="/contact">Contact</a>
        </div>
    </div>
</body>

</html>