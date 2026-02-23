<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapid Ink - Admin Access</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconify for Icons -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <style>
        body {
            background-color: #FFFAD0; /* Light gray background */
            color: #111827; /* Dark text */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, sans-serif;
        }
        .login-card {
            background-color: #ffffff41;
            border: 1px solid #e5e7eb56;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgb(0, 0, 0); /* Soft shadow */
        }
        .form-control {
            background-color: #f9fafb67;
            border: 1px solid #d1d5db54;
            color: #111827;
            padding: 12px 16px;
        }
        .form-control:focus {
            background-color: #ffffff48;
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
            padding: 12px;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .brand-logo img {
            max-height: 100px;
            width: auto;
            object-fit: contain;
        }
        .back-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Rapid Ink Logo">
        </div>
        <h4 class="text-center mb-4" style="font-weight: 700;">Command Center</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label text-muted small text-uppercase fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control" required autofocus placeholder="admin@rapidink.com">
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small text-uppercase fw-bold">Password</label>
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control pe-5" required placeholder="••••••••">
                    <button type="button" id="togglePassword" class="password-toggle" tabindex="-1">
                        <iconify-icon icon="lucide:eye" style="font-size: 18px;"></iconify-icon>
                    </button>
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted small fw-medium" for="remember">Keep me logged in</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center mb-4">
                <iconify-icon icon="lucide:shield-check" class="me-2" style="font-size: 18px;"></iconify-icon> Authenticate
            </button>
            
            <!-- New Back to Storefront Button -->
            <div class="text-center">
                <a href="/" class="back-link">
                    <iconify-icon icon="lucide:arrow-left" style="font-size: 16px;"></iconify-icon> Return to Storefront
                </a>
            </div>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the eye icon
            const icon = this.querySelector('iconify-icon');
            if (type === 'password') {
                icon.setAttribute('icon', 'lucide:eye');
            } else {
                icon.setAttribute('icon', 'lucide:eye-off');
            }
        });
    </script>
</body>
</html>