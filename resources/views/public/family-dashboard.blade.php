@extends('layouts.app')
@section('title', 'My Family Dashboard')
@section('content')

<div style="background:linear-gradient(135deg,#1B2A4A,#0D7C7C);color:#fff;padding:2rem 0 1.5rem;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h2 class="fw-bold mb-1">Welcome, {{ $family->parent_name }} 👋</h2>
        <p style="opacity:.8;margin:0;font-size:.9rem;">Reference: <strong>{{ $family->reference_number }}</strong></p>
      </div>
      <form method="POST" action="{{ route('family.logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-light btn-sm px-4">Logout</button>
      </form>
    </div>
  </div>
</div>

<div class="container py-4">

  {{-- Status Card --}}
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">APPLICATION STATUS</div>
        <div class="fs-4 fw-bold" style="color:#0D7C7C;">
          {{ ucfirst($family->status) }}
        </div>
        <div class="small text-muted mt-1">
          @if($family->status === 'matched') Your family has been matched with an educator.
          @elseif($family->status === 'waitlisted') You are on the waitlist. We will notify you.
          @else Your application is being reviewed.
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">CARE TYPE</div>
        <div class="fs-5 fw-bold" style="color:#1B2A4A;">{{ $family->care_type }}</div>
        <div class="small text-muted mt-1">{{ $family->suburb }}, {{ $family->postcode }}</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">CHILDREN</div>
        <div class="fs-4 fw-bold" style="color:#1B2A4A;">{{ $family->children_count }}</div>
        <div class="small text-muted mt-1">
          {{ $family->children_ages ? implode(', ', $family->children_ages) : 'Ages not specified' }}
        </div>
      </div>
    </div>
  </div>

  {{-- Profile Details --}}
  <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <h5 class="fw-bold mb-3" style="color:#1B2A4A;">Your Registration Details</h5>
    <div class="row g-3">
      @foreach([
        ['Full Name',         $family->parent_name],
        ['Email',             $family->email],
        ['Phone',             $family->phone ?? 'Not provided'],
        ['Location',          $family->suburb . ', ' . $family->postcode . ' ' . $family->state],
        ['Care Type',         $family->care_type],
        ['Preferred Days',    $family->days_required ? implode(', ', $family->days_required) : 'Not specified'],
        ['Wait Time',         $family->wait_time ?? 'Not specified'],
        ['Cultural Prefs',    $family->cultural_preferences ?? 'None specified'],
      ] as [$label, $value])
      <div class="col-md-6">
        <div class="text-muted small fw-bold">{{ strtoupper($label) }}</div>
        <div style="color:#1B2A4A;">{{ $value }}</div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="alert rounded-3" style="background:#E0F4F4;border:1px solid #0D7C7C;">
    <strong style="color:#0D7C7C;">Need help?</strong>
    <span class="text-muted"> Contact the Future Care Network team at hello@thefuturecareproject.com.au</span>
  </div>

</div>
@endsection