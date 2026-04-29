<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Future Care Network') — Digital Platform</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --fcn-navy: #1B2A4A;
    --fcn-teal: #0D7C7C;
    --fcn-teal-lt: #12A5A5;
    --fcn-mint: #E0F4F4;
    --fcn-amber: #E8963A;
    --fcn-cream: #F7FAFA;
  }
  body { font-family: 'Inter', sans-serif; background: var(--fcn-cream); color: #1e293b; }
  .navbar-fcn { background: var(--fcn-navy); }
  .navbar-fcn .navbar-brand { font-weight: 700; color: #fff !important; font-size: 1.15rem; }
  .navbar-fcn .nav-link { color: rgba(255,255,255,.75) !important; font-size: .875rem; }
  .navbar-fcn .nav-link:hover { color: #fff !important; }
  .btn-fcn-primary { background: var(--fcn-teal); border-color: var(--fcn-teal); color: #fff; font-weight: 500; }
  .btn-fcn-primary:hover { background: var(--fcn-teal-lt); border-color: var(--fcn-teal-lt); color: #fff; }
  .btn-fcn-outline { border-color: var(--fcn-teal); color: var(--fcn-teal); font-weight: 500; }
  .btn-fcn-outline:hover { background: var(--fcn-teal); color: #fff; }
  .form-card { background: #fff; border: 1px solid #e2e8ea; border-radius: 1rem; padding: 2rem; box-shadow: 0 4px 24px rgba(30,42,74,.07); }
  .form-label { font-weight: 500; font-size: .85rem; color: #374151; }
  .form-control:focus, .form-select:focus { border-color: var(--fcn-teal); box-shadow: 0 0 0 3px rgba(13,124,124,.12); }
  .alert-success-fcn { background: var(--fcn-mint); border: 1px solid var(--fcn-teal); border-radius: .75rem; }
  footer { background: var(--fcn-navy); color: rgba(255,255,255,.6); font-size: .85rem; }
</style>
@yield('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-fcn py-2">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
      <span style="background:var(--fcn-teal);border-radius:.5rem;padding:4px 8px;font-size:.8rem;">🌿</span>
      Future <span style="color:var(--fcn-teal-lt);margin:0 3px;">Care</span> Network
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto align-items-center gap-1">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('family.register') }}">For Families</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('educator.register') }}">For Educators</a></li>
        <li class="nav-item ms-2">
          <a class="btn btn-sm btn-fcn-primary px-3" href="{{ route('family.register') }}">Get Started</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
@yield('content')
</main>

<footer class="py-4 mt-5">
  <div class="container text-center">
    <p class="mb-1">© 2026 Future Care Network — Inspiring Innovative Approaches to Regional Childcare</p>
    <p class="mb-0">Built by Agile Avengers | CSC6200 UniSQ | Angela Cochrane, Founder</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
