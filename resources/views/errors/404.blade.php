<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 – Page Not Found | PT Asia Connexindo Internasional</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            overflow: hidden;
        }

        /* Animated background blobs */
        body::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,87,34,0.08) 0%, transparent 70%);
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
            background: radial-gradient(circle, rgba(255,87,34,0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: blobFloat 10s ease-in-out infinite reverse;
            pointer-events: none;
        }
        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -30px) scale(1.05); }
            66%       { transform: translate(-20px, 20px) scale(0.98); }
        }

        .error-card {
            background: #ffffff;
            border: 1px solid #ebebeb;
            border-radius: 20px;
            padding: 60px 50px;
            max-width: 560px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.06);
            position: relative;
            z-index: 1;
            animation: cardIn 0.5s cubic-bezier(0.34,1.56,0.64,1) both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .logo-wrap {
            margin-bottom: 32px;
        }
        .logo-wrap img {
            height: 52px;
            object-fit: contain;
        }

        .error-code {
            font-size: 7rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #FF5722 0%, #ff8a65 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -4px;
            margin-bottom: 16px;
            animation: pulseCode 3s ease-in-out infinite;
        }
        @keyframes pulseCode {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.8; }
        }

        .error-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: block;
            animation: iconBounce 2s ease-in-out infinite;
        }
        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-8px); }
        }

        .error-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .error-desc {
            font-size: 0.95rem;
            color: #777;
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
            box-shadow: 0 4px 16px rgba(255,87,34,0.3);
        }
        .btn-primary:hover {
            background: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255,87,34,0.35);
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
        .footer-links a:hover { color: #FF5722; }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="logo-wrap">
            <a href="/">
                <img src="/img/logo.png" alt="PT Asia Connexindo Internasional" onerror="this.style.display='none'">
            </a>
        </div>

        <span class="error-icon">🗺️</span>
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-desc">
            Oops! The page you're looking for seems to have sailed away.<br>
            It may have been moved, deleted, or the URL might be incorrect.
        </p>

        <div class="btn-group">
            <a href="/" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Back to Home
            </a>
            <a href="javascript:history.back()" class="btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Go Back
            </a>
        </div>

        <hr class="divider">

        <div class="footer-links">
            <a href="/news">News</a>
            <a href="/careers">Careers</a>
            <a href="/contact">Contact Us</a>
            <a href="tel:+622183791179">Call Now</a>
        </div>
    </div>
</body>
</html>
