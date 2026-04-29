@extends('layouts.app')
@section('title', 'Future Care Network')
@section('head')
<style>
  .hero { background: linear-gradient(135deg, #1B2A4A 0%, #2d4a38 60%, #0D7C7C 100%); color:#fff; padding:5rem 0 4rem; }
  .hero h1 { font-size:clamp(2rem,4vw,3rem); font-weight:700; line-height:1.2; }
  .hero p { font-size:1.05rem; opacity:.8; max-width:560px; }
  .stat-card { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); border-radius:.875rem; padding:1.25rem; text-align:center; }
  .stat-num { font-size:2rem; font-weight:700; color:#12A5A5; }
  .stat-label { font-size:.8rem; opacity:.6; }
  .problem-section { background:#1B2A4A; color:#fff; padding:4rem 0; }
  .stakeholder-card { background:#fff; border:1px solid #e2e8ea; border-radius:1rem; padding:1.5rem; cursor:pointer; transition:all .2s; }
  .stakeholder-card:hover { border-color:#0D7C7C; box-shadow:0 8px 30px rgba(13,124,124,.12); transform:translateY(-2px); }
  .stakeholder-icon { font-size:2rem; margin-bottom:.75rem; }
  .how-step { display:flex; align-items:flex-start; gap:1rem; padding:1rem; }
  .step-num { background:#0D7C7C; color:#fff; width:2rem; height:2rem; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0; font-size:.875rem; }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <div class="badge mb-3" style="background:rgba(13,165,165,.2);color:#12A5A5;padding:.4rem 1rem;border-radius:100px;border:1px solid rgba(18,165,165,.3);">
          🇦🇺 Regional Australia Childcare Initiative
        </div>
        <h1>Connecting families with <span style="color:#12A5A5;">quality childcare</span> across regional Australia</h1>
        <p class="mt-3 mb-4">A centralised digital platform that links families to verified educators, while giving educators the training and support they need to thrive.</p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="{{ route('family.register') }}" class="btn btn-fcn-primary btn-lg px-4">🏠 Register as a Family</a>
          <a href="{{ route('educator.register') }}" class="btn btn-outline-light btn-lg px-4">👩‍🏫 Become an Educator</a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="row g-3">
          @foreach([['50K+','Families in unregulated FB groups'],['$10K','Average educator startup cost'],['6+ mo','Average regional waitlist'],['$0','Govt funding from community data']] as $s)
          <div class="col-6">
            <div class="stat-card">
              <div class="stat-num">{{ $s[0] }}</div>
              <div class="stat-label">{{ $s[1] }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- PROBLEM --}}
<section class="problem-section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2 class="fw-bold mb-3">The childcare crisis in regional Australia</h2>
        <p style="opacity:.7;line-height:1.8;">Right now, finding childcare in regional Australia is like the "Wild West." Families rely on unregulated Facebook groups with 50,000+ members, educators face $10,000 startup costs with no support, and policymakers have no reliable data to act on. Future Care Network changes all of this.</p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([['73%','Regional families report difficulty finding childcare'],['40%','Educators leave within 2 years due to lack of support'],['6 mo+','Average wait time for childcare placement'],['0','Centralised platforms before Future Care Network']] as $p)
          <div class="col-6">
            <div class="stat-card">
              <div class="stat-num">{{ $p[0] }}</div>
              <div class="stat-label mt-1">{{ $p[1] }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- STAKEHOLDERS --}}
<section class="py-5">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold" style="color:#1B2A4A;">Who is this platform for?</h2>
      <p class="text-muted">Four stakeholder groups, all supported in one place.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['👨‍👩‍👧','Families','Find safe, verified childcare in your region. Register your needs and connect with qualified educators.',route('family.register'),'Register your family'],
        ['👩‍🏫','Educators','Create your verified profile, manage availability, and access training and business support.',route('educator.register'),'Register as educator'],
        ['🎓','Training Providers (RTOs)','Offer Certificate III and professional development courses directly to educators on the platform.','#','Partner with us'],
        ['📊','Administrators','Access live dashboards, run compliance reports, and monitor Blue Card verification.',route('admin.dashboard'),'View dashboard'],
      ] as $s)
      <div class="col-md-6 col-lg-3">
        <div class="stakeholder-card h-100">
          <div class="stakeholder-icon">{{ $s[0] }}</div>
          <h5 class="fw-bold" style="color:#1B2A4A;">{{ $s[1] }}</h5>
          <p class="text-muted small mb-3">{{ $s[2] }}</p>
          <a href="{{ $s[3] }}" class="btn btn-sm btn-fcn-outline">{{ $s[4] }} →</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- HOW IT WORKS --}}
<section class="py-5" style="background:#fff;">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold" style="color:#1B2A4A;">How it works</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-8">
        @foreach([
          ['Register','Families and educators register on the platform with full profile details.'],
          ['Verify','Our administrators verify educator credentials including Blue Card and qualifications.'],
          ['Match','Families are matched with verified educators based on location, care type and availability.'],
          ['Connect','Matched families and educators connect safely through the platform.'],
        ] as $i => $step)
        <div class="how-step">
          <div class="step-num">{{ $i + 1 }}</div>
          <div>
            <strong>{{ $step[0] }}</strong>
            <p class="text-muted small mb-0">{{ $step[1] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="py-5" style="background:var(--fcn-mint);">
  <div class="container text-center">
    <h2 class="fw-bold mb-2" style="color:#1B2A4A;">Ready to get started?</h2>
    <p class="text-muted mb-4">Join hundreds of families and educators already on the Future Care Network platform.</p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="{{ route('family.register') }}" class="btn btn-fcn-primary btn-lg px-5">Register as a Family</a>
      <a href="{{ route('educator.register') }}" class="btn btn-fcn-outline btn-lg px-5">Register as an Educator</a>
    </div>
  </div>
</section>

@endsection
