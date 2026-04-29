<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Future Care Network</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body{font-family:'Inter',sans-serif;background:linear-gradient(135deg,#1B2A4A 0%,#0D7C7C 100%);min-height:100vh;display:flex;align-items:center;}
  .login-card{background:#fff;border-radius:1.25rem;padding:2.5rem;max-width:420px;width:100%;box-shadow:0 24px 60px rgba(0,0,0,.18);}
  .brand-icon{background:#0D7C7C;color:#fff;width:3rem;height:3rem;border-radius:.75rem;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin-bottom:1.25rem;}
  .form-control:focus{border-color:#0D7C7C;box-shadow:0 0 0 3px rgba(13,124,124,.12);}
  .btn-login{background:#0D7C7C;border:none;color:#fff;font-weight:600;padding:.75rem;}
  .btn-login:hover{background:#12A5A5;color:#fff;}
</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="login-card mx-auto">
        <div class="brand-icon">🌿</div>
        <h4 class="fw-bold mb-1" style="color:#1B2A4A;">Admin Portal</h4>
        <p class="text-muted small mb-4">Future Care Network — Administrator Access</p>

        @if($errors->any())
        <div class="alert alert-danger small">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-500" style="font-size:.875rem;font-weight:500;">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@futurecareproject.com.au" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label fw-500" style="font-size:.875rem;font-weight:500;">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Remember me</label>
          </div>
          <button type="submit" class="btn btn-login w-100 rounded-3">Sign In to Dashboard</button>
        </form>

        <div class="mt-4 p-3 rounded-3" style="background:#f0fafa;font-size:.8rem;">
          <strong>Demo credentials:</strong><br>
          Email: admin@futurecareproject.com.au<br>
          Password: Admin@FCN2026
        </div>

        <div class="text-center mt-3">
          <a href="{{ route('home') }}" class="text-muted small">← Back to public site</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
