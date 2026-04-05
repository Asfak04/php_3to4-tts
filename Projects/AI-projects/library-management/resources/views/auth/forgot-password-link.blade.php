<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Link - Library Management System</title>
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
            max-width: 500px;
        }
        .login-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .login-header h2 { font-weight: 700; margin-bottom: 5px; letter-spacing: 1px; }
        .login-body { padding: 40px 30px; }
        .reset-link-box {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 15px;
            word-break: break-all;
            font-size: 0.85rem;
            color: #2a5298;
            font-family: monospace;
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
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-check-circle fs-1 mb-2 d-block"></i>
            <h2>Reset Link Generated</h2>
            <p class="mb-0 text-white-50">Click the link below to reset your password</p>
        </div>
        
        <div class="login-body">
            <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 8px;">
                <i class="bi bi-info-circle me-2"></i> 
                <strong>Development Mode:</strong> Since the mail server is not configured, the reset link is shown here directly. In production, this would be sent via email.
            </div>

            <p class="text-muted small mb-2"><i class="bi bi-link-45deg me-1"></i> Your password reset link:</p>
            <div class="reset-link-box mb-4">
                <a href="{{ $resetLink }}">{{ $resetLink }}</a>
            </div>

            <a href="{{ $resetLink }}" class="btn btn-primary w-100 mb-3">
                Reset My Password <i class="bi bi-arrow-right ms-2"></i>
            </a>

            <div class="text-center">
                <small class="text-muted"><i class="bi bi-clock me-1"></i> This link expires in 60 minutes.</small>
            </div>
        </div>
    </div>

</body>
</html>
