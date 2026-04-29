@extends('layouts.app')
@section('title','Registration Successful')
@section('content')
<div class="container py-5" style="max-width:600px;">
  <div class="text-center py-5">
    <div style="font-size:4rem;">✅</div>
    <h2 class="fw-bold mt-3" style="color:#0D7C7C;">Registration Submitted!</h2>
    <p class="text-muted mt-2">Your family has been registered with the Future Care Network. We will notify you when a matched educator is found in your area.</p>
    <div class="mt-4 d-flex gap-3 justify-content-center">
      <a href="{{ route('home') }}" class="btn btn-fcn-primary px-4">← Back to Home</a>
      <a href="{{ route('family.register') }}" class="btn btn-fcn-outline px-4">Register Another</a>
    </div>
  </div>
</div>
@endsection