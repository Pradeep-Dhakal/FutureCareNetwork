<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Family Login — Future Care Network</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family:'Inter',sans-serif; background:linear-gradient(135deg,#1B2A4A 0%,#0D7C7C 100%); min-height:100vh; display:flex; align-items:center; }
  .card { border-radius:1.25rem; padding:2.5rem; max-width:420px; width:100%; box-shadow:0 24px 60px rgba(0,0,0,.18); border:none; }
  .icon { background:#E0F4F4; width:3.5rem; height:3.5rem; border-radius:.875rem; display:flex; align-items:center; justify-content:center; font-size:1.6rem; margin-bottom:1.25rem; }
  .form-control:focus { border-color:#0D7C7C; box-shadow:0 0 0 3px rgba(13,124,124,.12); }
  .btn-teal { background:#0D7C7C; border:none; color:#fff; font-weight:600; padding:.75rem; }
  .btn-teal:hover { background:#12A5A5; color:#fff; }
</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card mx-auto">
        <div class="icon">🏠</div>
        <h4 class="fw-bold mb-1" style="color:#1B2A4A;">Family Login</h4>
        <p class="text-muted small mb-4">Access your Future Care Network family account</p>

        @if($errors->any())
          <div class="alert alert-danger small rounded-3">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('family.login.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-500" style="font-size:.875rem;font-weight:500;">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your@email.com" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label" style="font-size:.875rem;font-weight:500;">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Remember me</label>
          </div>
          <button type="submit" class="btn btn-teal w-100 rounded-3">Login to My Account</button>
        </form>

        <hr class="my-4">
        <div class="text-center">
          <p class="small text-muted mb-2">Don't have an account?</p>
          <a href="{{ route('family.register') }}" class="btn btn-outline-secondary btn-sm px-4">Register as a Family</a>
        </div>
        <div class="text-center mt-3">
          <a href="{{ route('home') }}" class="text-muted small">← Back to Home</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>