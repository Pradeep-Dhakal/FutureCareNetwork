@extends('layouts.app')
@section('title','Family Registration')
@section('head')
<style>
  .form-hero { background:linear-gradient(135deg,#1B2A4A,#0D7C7C); color:#fff; padding:2.5rem 0 1.5rem; }
  .progress-bar-fcn { height:4px; background:#e2e8ea; border-radius:2px; margin-bottom:2rem; }
  .progress-fill { height:100%; background:#0D7C7C; border-radius:2px; width:100%; }
  .section-title { font-size:1rem; font-weight:600; color:#1B2A4A; margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
  .check-group .form-check { border:1.5px solid #e2e8ea; border-radius:.5rem; padding:.6rem .75rem .6rem 2rem; margin-bottom:.4rem; transition:all .15s; }
  .check-group .form-check:hover { border-color:#0D7C7C; background:#f0fafa; }
  .check-group .form-check-input:checked ~ .form-check-label { color:#0D7C7C; font-weight:500; }
</style>
@endsection

@section('content')
<div class="form-hero">
  <div class="container">
    <nav aria-label="breadcrumb" class="mb-2">
      <ol class="breadcrumb" style="font-size:.8rem;opacity:.7;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
        <li class="breadcrumb-item active text-white">Family Registration</li>
      </ol>
    </nav>
    <h1 class="fw-bold h3 mb-1">🏠 Family Registration</h1>
    <p style="opacity:.8;font-size:.9rem;">Register your family to find safe, verified childcare in your area.</p>
  </div>
</div>

<div class="container py-4" style="max-width:720px;">



  {{-- ERRORS --}}
  @if($errors->any())
  <div class="alert alert-danger rounded-3 mb-3">
    <strong>Please correct the following:</strong>
    <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
  @endif

  <div class="progress-bar-fcn"><div class="progress-fill"></div></div>

  <div class="alert alert-info small mb-3">
    <i class="bi bi-info-circle me-2"></i>
    This platform collects structured data to help match your family with the right care and to support government funding decisions for your region.
  </div>

<form method="POST" action="{{ route('family.store') }}">   
   @csrf

    {{-- PARENT DETAILS --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>👤</span> Parent / Guardian Details</div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="parent_name" class="form-control @error('parent_name') is-invalid @enderror" value="{{ old('parent_name') }}" placeholder="e.g. Sarah Johnson" required>
          @error('parent_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="sarah@email.com" required>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone Number</label>
          <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="04XX XXX XXX">
        </div>
        <div class="col-md-6">
  <label class="form-label">Password <span class="text-danger">*</span></label>
  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
    placeholder="Minimum 8 characters" required>
  @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
  <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
  <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
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
          <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ old('postcode') }}" placeholder="e.g. 4350" required maxlength="4" pattern="\d{4}">
          @error('postcode')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
          <label class="form-label">Street Address</label>
          <input type="text" name="street_address" class="form-control" value="{{ old('street_address') }}" placeholder="Street address (optional)">
        </div>
      </div>
    </div>

    {{-- CHILDREN'S DETAILS --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>👶</span> Children's Details</div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Number of Children Needing Care <span class="text-danger">*</span></label>
          <select name="children_count" class="form-select @error('children_count') is-invalid @enderror" required>
            <option value="">Select...</option>
            @foreach([1,2,3,'4+'] as $n)
            <option value="{{ is_string($n) ? 4 : $n }}" {{ old('children_count') == $n ? 'selected' : '' }}>{{ $n }}</option>
            @endforeach
          </select>
          @error('children_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Children's Ages (select all that apply)</label>
        <div class="check-group row g-2">
          @foreach(['Under 12 months','1 year','2 years','3 years','4 years','5 years','School age (5-12)'] as $age)
          <div class="col-md-6">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="children_ages[]" value="{{ $age }}" id="age_{{ $loop->index }}"
                {{ in_array($age, old('children_ages', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="age_{{ $loop->index }}">{{ $age }}</label>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Special needs or considerations</label>
        <textarea name="special_needs" class="form-control" rows="2" placeholder="e.g. dietary requirements, health conditions, language needs...">{{ old('special_needs') }}</textarea></div>
    </div>

    {{-- CARE PREFERENCES --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>🕒</span> Care Preferences</div>
      <div class="mb-3">
        <label class="form-label">Type of Care Required <span class="text-danger">*</span></label>
        <select name="care_type" class="form-select @error('care_type') is-invalid @enderror" required>
          <option value="">Select care type...</option>
          @foreach(['Family Day Care','In-Home Care','Long Day Care','Before/After School Care','Occasional Care','Overnight Care'] as $ct)
          <option value="{{ $ct }}" {{ old('care_type') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
          @endforeach
        </select>
        @error('care_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Preferred Care Start Date</label>
          <input type="date" name="preferred_start_date" class="form-control" value="{{ old('preferred_start_date') }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">How long have you been waiting?</label>
          <select name="wait_time" class="form-select">
            <option value="">Select...</option>
            @foreach(['Just starting to look','1-3 months','3-6 months','6-12 months','Over 12 months'] as $wt)
            <option value="{{ $wt }}" {{ old('wait_time') == $wt ? 'selected' : '' }}>{{ $wt }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Preferred Care Days</label>
        <div class="check-group row g-2">
          @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="days_required[]" value="{{ $day }}" id="day_{{ $loop->index }}"
                {{ in_array($day, old('days_required', ['Monday','Tuesday'])) ? 'checked' : '' }}>
              <label class="form-check-label" for="day_{{ $loop->index }}">{{ $day }}</label>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="mt-3">
        <label class="form-label">Cultural or language preferences</label>
        <input type="text" name="cultural_preferences" class="form-control" value="{{ old('cultural_preferences') }}" placeholder="e.g. Mandarin-speaking educator, First Nations cultural understanding">
      </div>
    </div>

    {{-- PRIVACY --}}
    <div class="form-card mb-3">
      <div class="section-title"><span>🔒</span> Privacy & Consent</div>
      <div class="check-group">
        <div class="form-check mb-2">
          <input class="form-check-input @error('privacy_consent') is-invalid @enderror" type="checkbox" name="privacy_consent" id="consent" value="1" {{ old('privacy_consent') ? 'checked' : '' }} required>
          <label class="form-check-label" for="consent">I consent to my information being stored securely and used for childcare matching purposes. <span class="text-danger">*</span></label>
          @error('privacy_consent')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" id="consent2" checked>
          <label class="form-check-label" for="consent2">I understand my anonymised data may be used to support regional childcare funding applications.</label>
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
