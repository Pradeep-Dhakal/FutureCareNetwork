<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Admin — @yield('title', 'Dashboard') | Future Care Network</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root { --navy:#1B2A4A; --teal:#0D7C7C; --teal-lt:#12A5A5; --mint:#E0F4F4; --sidebar-w:240px; }
  body { font-family:'Inter',sans-serif; background:#F1F5F5; margin:0; }
  /* Sidebar */
  .sidebar { position:fixed; top:0; left:0; width:var(--sidebar-w); height:100vh; background:var(--navy); z-index:1000; overflow-y:auto; }
  .sidebar-logo { padding:1.25rem 1.25rem .75rem; border-bottom:1px solid rgba(255,255,255,.08); }
  .sidebar-logo a { color:#fff; text-decoration:none; font-weight:700; font-size:1rem; }
  .sidebar-section { padding:.75rem 1rem .25rem; font-size:.65rem; font-weight:700; letter-spacing:.1em; color:rgba(255,255,255,.3); }
  .sidebar-item { display:flex; align-items:center; gap:.6rem; padding:.55rem 1rem; margin:.1rem .5rem; border-radius:.5rem; color:rgba(255,255,255,.6); font-size:.875rem; text-decoration:none; transition:all .15s; }
  .sidebar-item:hover { background:rgba(255,255,255,.07); color:#fff; }
  .sidebar-item.active { background:var(--teal); color:#fff; font-weight:500; }
  /* Main */
  .admin-main { margin-left:var(--sidebar-w); min-height:100vh; }
  .topbar { background:#fff; border-bottom:1px solid #e2e8ea; padding:.75rem 1.5rem; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; }
  .topbar h1 { font-size:1.15rem; font-weight:600; color:var(--navy); margin:0; }
  .content-area { padding:1.5rem; }
  /* KPI Cards */
  .kpi-card { background:#fff; border:1px solid #e2e8ea; border-radius:.875rem; padding:1.25rem; position:relative; overflow:hidden; }
  .kpi-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; }
  .kpi-card.green::before { background:var(--teal); }
  .kpi-card.amber::before { background:#E8963A; }
  .kpi-card.blue::before { background:#0EA5E9; }
  .kpi-card.red::before { background:#DC2626; }
  .kpi-num { font-size:2rem; font-weight:700; color:var(--navy); line-height:1; }
  .kpi-label { font-size:.75rem; font-weight:600; color:#64748b; letter-spacing:.04em; }
  .kpi-change { font-size:.75rem; color:var(--teal); }
  /* Tables */
  .admin-table thead th { background:var(--navy); color:#fff; font-size:.78rem; font-weight:600; letter-spacing:.03em; border:none; padding:.75rem 1rem; }
  .admin-table tbody tr:hover td { background:#f0fafa; }
  .admin-table td { vertical-align:middle; padding:.65rem 1rem; font-size:.875rem; border-color:#e2e8ea; }
  /* Badges */
  .badge-fcn { font-size:.72rem; font-weight:600; padding:.3rem .7rem; border-radius:100px; }
  /* Charts */
  .chart-card { background:#fff; border:1px solid #e2e8ea; border-radius:.875rem; padding:1.25rem; }
</style>
@yield('head')
</head>
<body>

<div class="sidebar">
  <div class="sidebar-logo">
    <a href="{{ route('admin.dashboard') }}">🌿 FCN Admin</a>
  </div>
  <div class="mt-2">
    <div class="sidebar-section">OVERVIEW</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>
    <a href="{{ route('admin.families') }}" class="sidebar-item {{ request()->routeIs('admin.families') ? 'active' : '' }}">
      <i class="bi bi-people-fill"></i> Families
    </a>
    <a href="{{ route('admin.educators') }}" class="sidebar-item {{ request()->routeIs('admin.educators') ? 'active' : '' }}">
      <i class="bi bi-mortarboard-fill"></i> Educators
    </a>
    <a href="{{ route('admin.matches') }}" class="sidebar-item {{ request()->routeIs('admin.matches') ? 'active' : '' }}">
      <i class="bi bi-link-45deg"></i> Matches
    </a>
    <div class="sidebar-section mt-2">ACCOUNT</div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="sidebar-item border-0 w-100 text-start" style="background:transparent;cursor:pointer;">
        <i class="bi bi-box-arrow-left"></i> Logout
      </button>
    </form>
  </div>
</div>

<div class="admin-main">
  <div class="topbar">
    <h1>@yield('title', 'Dashboard')</h1>
    <div class="d-flex align-items-center gap-3">
      @if(session('toast'))
        <span class="badge bg-success">{{ session('toast') }}</span>
      @endif
      <span class="text-muted" style="font-size:.85rem;">
        <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
      </span>
    </div>
  </div>
  <div class="content-area">
    @yield('content')
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@yield('scripts')
</body>
</html>
