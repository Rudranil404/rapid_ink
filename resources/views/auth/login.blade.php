@php
    // FORCE REAL HTTP HEADERS TO PREVENT MOBILE DISK CACHING
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Rapid Ink - Admin Access</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
    <style>
        body {
            background-color: #FFFAD0;
            color: #111827;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, sans-serif;
            padding: 24px;
        }
        .login-card {
            background-color: #ffffff41;
            border: 1px solid #e5e7eb56;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
        }
        .form-control {
            background-color: #ffffff90;
            border: 1px solid #d1d5db;
            color: #111827;
            padding: 12px 16px;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #000000;
            color: #111827;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #000000;
            border-color: #000000;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
            transform: translateY(-2px);
        }
        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .brand-logo img {
            max-height: 80px;
            width: auto;
            object-fit: contain;
        }
        .back-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .back-link:hover {
            color: #000000;
        }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .password-toggle:hover {
            color: #111827;
        }
        
        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
        </div>
        <h5 class="text-center mb-4" style="font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Command Center</h5>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small border-0 shadow-sm rounded-3 mb-4" style="background-color: #fee2e2; color: #991b1b;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success py-2 small border-0 shadow-sm rounded-3 mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            
            <div class="mb-3">
                <label class="form-label text-muted small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@rapidink.com">
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control pe-5" required placeholder="••••••••" autocomplete="new-password">
                    <button type="button" id="togglePassword" class="password-toggle" tabindex="-1">
                        <iconify-icon icon="lucide:eye" style="font-size: 18px;"></iconify-icon>
                    </button>
                </div>
            </div>

            <div class="mb-4 form-check d-flex align-items-center gap-2">
                <input type="checkbox" class="form-check-input mt-0" id="remember" name="remember" style="cursor: pointer;">
                <label class="form-check-label text-muted small fw-bold text-uppercase" for="remember" style="cursor: pointer; padding-top: 2px;">Keep me logged in</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center mb-4">
                <iconify-icon icon="lucide:shield-check" class="me-2" style="font-size: 18px;"></iconify-icon> Authenticate
            </button>
            
            <div class="text-center">
                <a href="/" class="back-link">
                    <iconify-icon icon="lucide:arrow-left" style="font-size: 16px;"></iconify-icon> Return to Storefront
                </a>
            </div>
        </form>
    </div>

    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            const icon = this.querySelector('iconify-icon');
            if (type === 'password') {
                icon.setAttribute('icon', 'lucide:eye');
            } else {
                icon.setAttribute('icon', 'lucide:eye-off');
            }
        });

        // Fallback Javascript Cache Buster
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload(true);
            }
        });
    </script>
</body>
</html>