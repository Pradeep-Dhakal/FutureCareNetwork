@extends('layouts.app')
@section('title','Educator Registration')
@section('head')
<style>
  .form-hero{background:linear-gradient(135deg,#1B2A4A,#0D7C7C);color:#fff;padding:2.5rem 0 1.5rem;}
  .section-title{font-size:1rem;font-weight:600;color:#1B2A4A;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;}
  .check-group .form-check{border:1.5px solid #e2e8ea;border-radius:.5rem;padding:.6rem .75rem .6rem 2rem;margin-bottom:.4rem;transition:all .15s;}
  .check-group .form-check:hover{border-color:#0D7C7C;background:#f0fafa;}
</style>
@endsection

@section('content')
<div class="form-hero">
  <div class="container">
    <nav aria-label="breadcrumb" class="mb-2">
      <ol class="breadcrumb" style="font-size:.8rem;opacity:.7;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
        <li class="breadcrumb-item active text-white">Educator Registration</li>
      </ol>
    </nav>
    <h1 class="fw-bold h3 mb-1">👩‍🏫 Educator Registration</h1>
    <p style="opacity:.8;font-size:.9rem;">Join the Future Care Network as a verified childcare professional.</p>
  </div>
</div>

<div class="container py-4" style="max-width:720px;">

  @if(session('success'))
  <div class="alert alert-success-fcn p-4 mb-4">
    <div class="d-flex align-items-center gap-3">
      <span style="font-size:2rem;">✅</span>
      <div>
        <h5 class="fw-bold mb-1" style="color:#0D7C7C;">Educator Profile Submitted!</h5>
        <p class="mb-1">Your reference number is <strong>{{ session('reference') }}</strong></p>
        <p class="mb-0 small text-muted">Our team will verify your Blue Card and qualifications within 2 business days.</p>
      </div>
    </div>
    <div class="mt-3"><a href="{{ route('home') }}" class="btn btn-sm btn-fcn-primary">← Back to Home</a></div>
  </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger rounded-3 mb-3">
    <strong>Please correct the following:</strong>
    <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
  @endif

  <form method="POST" action="{{ route('educator.store') }}" id="educatorForm" novalidate>
    @csrf

    {{-- PERSONAL DETAILS --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>👤</span> Personal Details</div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Maria Santos" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="maria@email.com" required>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="04XX XXX XXX">
        </div>
        <div class="col-md-6">
          <label class="form-label">State <span class="text-danger">*</span></label>
          <select name="state" class="form-select" required>
            @foreach(['QLD','NSW','VIC','WA','SA','NT','TAS','ACT'] as $s)
            <option value="{{ $s }}" {{ old('state','QLD') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-8">
          <label class="form-label">Suburb <span class="text-danger">*</span></label>
          <input type="text" name="suburb" class="form-control @error('suburb') is-invalid @enderror" value="{{ old('suburb') }}" placeholder="e.g. Toowoomba" required>
          @error('suburb')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-4">
          <label class="form-label">Postcode <span class="text-danger">*</span></label>
          <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ old('postcode') }}" placeholder="4350" required maxlength="4">
          @error('postcode')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    {{-- QUALIFICATIONS --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>🎓</span> Qualifications & Compliance</div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Highest Qualification <span class="text-danger">*</span></label>
          <select name="qualification" class="form-select @error('qualification') is-invalid @enderror" required>
            <option value="">Select...</option>
            @foreach(['Certificate III in ECEC','Diploma of ECEC','Bachelor of Education (Early Childhood)','Currently studying Certificate III','No formal qualification yet'] as $q)
            <option value="{{ $q }}" {{ old('qualification') == $q ? 'selected' : '' }}>{{ $q }}</option>
            @endforeach
          </select>
          @error('qualification')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Blue Card Number</label>
          <input type="text" name="blue_card_number" class="form-control" value="{{ old('blue_card_number') }}" placeholder="e.g. 1234567/8">
        </div>
        <div class="col-md-6">
          <label class="form-label">Blue Card Expiry Date</label>
          <input type="date" name="blue_card_expiry" class="form-control" value="{{ old('blue_card_expiry') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">Public Liability Insurance <span class="text-danger">*</span></label>
          <select name="insurance_status" class="form-select @error('insurance_status') is-invalid @enderror" required>
            <option value="valid" {{ old('insurance_status','valid') == 'valid' ? 'selected' : '' }}>✅ Yes, current policy</option>
            <option value="pending" {{ old('insurance_status') == 'pending' ? 'selected' : '' }}>⏳ In progress</option>
            <option value="none" {{ old('insurance_status') == 'none' ? 'selected' : '' }}>❌ Not yet</option>
          </select>
          @error('insurance_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    {{-- SERVICE DETAILS --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>🏠</span> Service Details</div>
      <div class="mb-3">
        <label class="form-label">Type of Care You Provide</label>
        <div class="check-group row g-2">
          @foreach(['Family Day Care','In-Home Care','Before/After School Care','Occasional Care','Long Day Care'] as $ct)
          <div class="col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="care_types[]" value="{{ $ct }}" id="ct_{{ $loop->index }}"
                {{ in_array($ct, old('care_types', ['Family Day Care'])) ? 'checked' : '' }}>
              <label class="form-check-label" for="ct_{{ $loop->index }}">{{ $ct }}</label>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Maximum Number of Children <span class="text-danger">*</span></label>
          <select name="max_children" class="form-select" required>
            @foreach([1,2,3,4,5,6] as $n)
            <option value="{{ $n }}" {{ old('max_children',4) == $n ? 'selected' : '' }}>{{ $n }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Age Groups You Accept</label>
          <select name="age_groups" class="form-select">
            @foreach(['All ages (0-12)','Infants only (0-2)','Toddlers (2-4)','School age (5-12)'] as $ag)
            <option value="{{ $ag }}" {{ old('age_groups') == $ag ? 'selected' : '' }}>{{ $ag }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Available Days</label>
        <div class="check-group row g-2">
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $day)
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="availability[]" value="{{ $day }}" id="avail_{{ $loop->index }}"
                {{ in_array($day, old('availability', ['Monday','Tuesday','Wednesday'])) ? 'checked' : '' }}>
              <label class="form-check-label" for="avail_{{ $loop->index }}">{{ $day }}</label>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Tell families about your service</label>
        <textarea name="service_description" class="form-control" rows="3" placeholder="Describe your experience, approach to care, languages spoken, cultural background, special skills...">{{ old('service_description') }}</textarea>
      </div>
    </div>

    {{-- TRAINING --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>📚</span> Training & Support Needs</div>
      <label class="form-label">What support do you need? (select all that apply)</label>
      <div class="check-group row g-2">
        @foreach(['Business setup support','Certificate III training','Financial assistance / loans','Peer networking','Insurance guidance','Government subsidy advice'] as $tn)
        <div class="col-md-6">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="training_needs[]" value="{{ $tn }}" id="tn_{{ $loop->index }}"
              {{ in_array($tn, old('training_needs', ['Business setup support'])) ? 'checked' : '' }}>
            <label class="form-check-label" for="tn_{{ $loop->index }}">{{ $tn }}</label>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- PRIVACY --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>🔒</span> Privacy & Consent</div>
      <div class="check-group">
        <div class="form-check mb-2">
          <input class="form-check-input @error('privacy_consent') is-invalid @enderror" type="checkbox" name="privacy_consent" id="consent" value="1" {{ old('privacy_consent') ? 'checked' : '' }} required>
          <label class="form-check-label" for="consent">I confirm all information is accurate and consent to my profile being displayed to families. <span class="text-danger">*</span></label>
          @error('privacy_consent')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
      <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Cancel</a>
      <button type="submit" class="btn btn-fcn-primary btn-lg px-5">Submit Registration →</button>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
(function(){
  'use strict';
  const form = document.getElementById('educatorForm');
  form.addEventListener('submit', function(e) {
    if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
    form.classList.add('was-validated');
  });
})();
</script>
@endsection
