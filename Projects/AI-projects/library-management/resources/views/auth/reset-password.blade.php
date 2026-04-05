<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Library Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f4f7f6 0%, #e0eaf5 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            background: #ffffff;
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .login-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .login-header h2 { font-weight: 700; margin-bottom: 5px; letter-spacing: 1px; }
        .login-body { padding: 40px 30px; }
        .form-control {
            border-radius: 8px;
            border: 1px solid #dce1e7;
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.15);
            border-color: #2a5298;
        }
        .btn-primary { 
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); 
            border: none; border-radius: 8px; padding: 12px;
            font-weight: 600; letter-spacing: 0.5px; transition: all 0.3s;
        }
        .btn-primary:hover { 
            background: linear-gradient(135deg, #152e5b 0%, #1e3c72 100%); 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3); 
        }
        .form-label { font-weight: 500; color: #495057; margin-bottom: 8px; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-key fs-1 mb-2 d-block"></i>
            <h2>Set New Password</h2>
            <p class="mb-0 text-white-50">Choose a strong new password</p>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger mb-4 shadow-sm border-0 border-start border-5 border-danger" style="border-radius: 8px;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-3">
                    <label class="form-label text-muted small"><i class="bi bi-envelope me-1"></i> Resetting password for</label>
                    <input type="text" class="form-control bg-light" value="{{ $email }}" disabled>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label"><i class="bi bi-lock me-2"></i>New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autofocus placeholder="Minimum 6 characters">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label"><i class="bi bi-lock-fill me-2"></i>Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Repeat your new password">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Reset Password <i class="bi bi-check-lg ms-2"></i>
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none" style="color: #2a5298;">
                        <i class="bi bi-arrow-left me-1"></i> Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
