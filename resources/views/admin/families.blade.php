@extends('layouts.admin')
@section('title','Families')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <p class="text-muted small mb-0">{{ $families->total() }} families registered</p>
  </div>
  <a href="{{ route('admin.matches') }}" class="btn btn-sm btn-fcn-primary">
    <i class="bi bi-link-45deg me-1"></i>Run Matching
  </a>
</div>

{{-- Filters --}}
<form method="GET" class="row g-2 mb-3">
  <div class="col-md-5">
    <input type="text" name="search" class="form-control" placeholder="Search by name, suburb or reference..." value="{{ request('search') }}">
  </div>
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="">All Statuses</option>
      @foreach(['pending','matched','waitlisted'] as $s)
      <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-fcn-primary w-100">Filter</button>
  </div>
  <div class="col-md-2">
    <a href="{{ route('admin.families') }}" class="btn btn-outline-secondary w-100">Clear</a>
  </div>
</form>

<div class="chart-card p-0">
  <div class="table-responsive">
    <table class="table admin-table mb-0">
      <thead>
        <tr>
          <th>Reference</th>
          <th>Parent Name</th>
          <th>Location</th>
          <th>Care Type</th>
          <th>Children</th>
          <th>Wait Time</th>
          <th>Status</th>
          <th>Registered</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($families as $f)
        <tr>
          <td><code>{{ $f->reference_number }}</code></td>
          <td>
            <strong>{{ $f->parent_name }}</strong>
            <br><small class="text-muted">{{ $f->email }}</small>
          </td>
          <td>{{ $f->suburb }}, {{ $f->postcode }}</td>
          <td><span class="badge badge-fcn bg-secondary">{{ $f->care_type }}</span></td>
          <td class="text-center">{{ $f->children_count }}</td>
          <td>{{ $f->wait_time ?? '—' }}</td>
          <td>
            <form method="POST" action="{{ route('admin.families.status', $f) }}">
              @csrf @method('PATCH')
              <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach(['pending','matched','waitlisted'] as $s)
                <option value="{{ $s }}" {{ $f->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
              </select>
            </form>
          </td>
          <td><small>{{ $f->created_at->format('d M Y') }}</small></td>
          <td>
            <form method="POST" action="{{ route('admin.families.delete', $f) }}" onsubmit="return confirm('Delete this family record?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center text-muted py-4">No families found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $families->withQueryString()->links() }}</div>
@endsection
