@extends('layouts.app')
@section('title', 'My Educator Dashboard')
@section('content')

<div style="background:linear-gradient(135deg,#1B2A4A,#0D7C7C);color:#fff;padding:2rem 0 1.5rem;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h2 class="fw-bold mb-1">Welcome, {{ $educator->name }} 👋</h2>
        <p style="opacity:.8;margin:0;font-size:.9rem;">Reference: <strong>{{ $educator->reference_number }}</strong></p>
      </div>
      <form method="POST" action="{{ route('educator.logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-light btn-sm px-4">Logout</button>
      </form>
    </div>
  </div>
</div>

<div class="container py-4">

  {{-- Status Cards --}}
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">PROFILE STATUS</div>
        <div class="fs-4 fw-bold" style="color:#0D7C7C;">{{ ucfirst($educator->status) }}</div>
        <div class="small text-muted mt-1">
          @if(in_array($educator->status, ['verified','active'])) Your profile is verified and visible to families.
          @elseif($educator->status === 'suspended') Your profile has been suspended. Contact support.
          @else Your profile is under review by our team.
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">BLUE CARD STATUS</div>
        @php $bcStatus = $educator->blue_card_status; @endphp
        <div class="fs-5 fw-bold {{ $bcStatus === 'expired' ? 'text-danger' : ($bcStatus === 'expiring' ? 'text-warning' : '') }}" style="{{ $bcStatus === 'valid' ? 'color:#0D7C7C;' : '' }}">
          @if($bcStatus === 'valid') ✓ Valid
          @elseif($bcStatus === 'expired') ⚠ Expired
          @elseif($bcStatus === 'expiring') ⏰ Expiring Soon
          @else Not Provided
          @endif
        </div>
        <div class="small text-muted mt-1">
          {{ $educator->blue_card_expiry ? 'Expires: ' . $educator->blue_card_expiry->format('d M Y') : 'No expiry date recorded' }}
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
        <div class="text-muted small fw-bold mb-1">MAX CHILDREN</div>
        <div class="fs-4 fw-bold" style="color:#1B2A4A;">{{ $educator->max_children }}</div>
        <div class="small text-muted mt-1">{{ $educator->age_groups ?? 'All ages' }}</div>
      </div>
    </div>
  </div>

  {{-- Profile Details --}}
  <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
    <h5 class="fw-bold mb-3" style="color:#1B2A4A;">Your Educator Profile</h5>
    <div class="row g-3">
      @foreach([
        ['Full Name',        $educator->name],
        ['Email',            $educator->email],
        ['Phone',            $educator->phone ?? 'Not provided'],
        ['Location',         $educator->suburb . ', ' . $educator->postcode . ' ' . $educator->state],
        ['Qualification',    $educator->qualification],
        ['Insurance',        ucfirst($educator->insurance_status)],
        ['Care Types',       $educator->care_types ? implode(', ', $educator->care_types) : 'Not specified'],
        ['Available Days',   $educator->availability ? implode(', ', $educator->availability) : 'Not specified'],
      ] as [$label, $value])
      <div class="col-md-6">
        <div class="text-muted small fw-bold">{{ strtoupper($label) }}</div>
        <div style="color:#1B2A4A;">{{ $value }}</div>
      </div>
      @endforeach
    </div>

    @if($educator->service_description)
    <div class="mt-3 pt-3 border-top">
      <div class="text-muted small fw-bold mb-1">ABOUT MY SERVICE</div>
      <p class="mb-0" style="color:#1B2A4A;">{{ $educator->service_description }}</p>
    </div>
    @endif
  </div>

  <div class="alert rounded-3" style="background:#E0F4F4;border:1px solid #0D7C7C;">
    <strong style="color:#0D7C7C;">Need help?</strong>
    <span class="text-muted"> Contact the Future Care Network team at hello@thefuturecareproject.com.au</span>
  </div>

</div>
@endsection