@extends('layouts.app')
@section('title','Registration Successful')
@section('content')
<div class="container py-5" style="max-width:600px;">
  <div class="text-center py-5">
    <div style="font-size:4rem;">✅</div>
    <h2 class="fw-bold mt-3" style="color:#0D7C7C;">Educator Profile Submitted!</h2>
    <p class="text-muted mt-2">Your educator profile has been received. Our team will verify your Blue Card and qualifications within 2 business days.</p>
    <div class="mt-4 d-flex gap-3 justify-content-center">
      <a href="{{ route('home') }}" class="btn btn-fcn-primary px-4">← Back to Home</a>
      <a href="{{ route('educator.register') }}" class="btn btn-fcn-outline px-4">Register Another</a>
    </div>
  </div>
</div>
@endsection