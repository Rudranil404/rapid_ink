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
            background-color: #f3f4f6; /* Light gray background */
            color: #111827; /* Dark text */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', system-ui, sans-serif;
        }
        .login-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); /* Soft shadow */
        }
        .form-control {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            color: #111827;
            padding: 12px 16px;
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
            padding: 12px;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
        }
        .brand-logo {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin-bottom: 30px;
            color: #000000;
        }
        .brand-icon {
            color: #000000; /* Replaced yellow with solid black for light theme */
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            RAPID<iconify-icon icon="lucide:zap" class="brand-icon" style="font-size: 28px;"></iconify-icon>INK
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
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted small fw-medium" for="remember">Keep me logged in</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                <iconify-icon icon="lucide:shield-check" class="me-2" style="font-size: 18px;"></iconify-icon> Authenticate
            </button>
        </form>
    </div>

</body>
</html>