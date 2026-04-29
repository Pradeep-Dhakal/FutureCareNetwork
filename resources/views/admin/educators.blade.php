@extends('layouts.admin')
@section('title','Educators')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <p class="text-muted small mb-0">{{ $educators->total() }} educators registered</p>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-md-5">
    <input type="text" name="search" class="form-control" placeholder="Search by name, suburb or reference..." value="{{ request('search') }}">
  </div>
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="">All Statuses</option>
      @foreach(['pending','verified','active','suspended'] as $s)
      <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2"><button type="submit" class="btn btn-fcn-primary w-100">Filter</button></div>
  <div class="col-md-2"><a href="{{ route('admin.educators') }}" class="btn btn-outline-secondary w-100">Clear</a></div>
</form>

<div class="chart-card p-0">
  <div class="table-responsive">
    <table class="table admin-table mb-0">
      <thead>
        <tr>
          <th>Reference</th>
          <th>Educator</th>
          <th>Location</th>
          <th>Qualification</th>
          <th>Blue Card</th>
          <th>Insurance</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($educators as $e)
        @php $bcStatus = $e->blue_card_status; @endphp
        <tr>
          <td><code>{{ $e->reference_number }}</code></td>
          <td>
            <strong>{{ $e->name }}</strong>
            <br><small class="text-muted">{{ $e->email }}</small>
          </td>
          <td>{{ $e->suburb }}, {{ $e->postcode }}</td>
          <td><small>{{ $e->qualification }}</small></td>
          <td class="{{ $bcStatus === 'expired' ? 'text-danger' : ($bcStatus === 'expiring' ? 'text-warning' : '') }}">
            @if($e->blue_card_number)
              <small>{{ $e->blue_card_number }}</small><br>
              <small>
                @if($bcStatus === 'expired') ⚠️ Expired
                @elseif($bcStatus === 'expiring') ⏰ Expiring
                @else ✓ {{ $e->blue_card_expiry?->format('d M Y') }}
                @endif
              </small>
            @else
              <small class="text-muted">Not provided</small>
            @endif
          </td>
          <td>
            @if($e->insurance_status === 'valid') <span class="badge badge-fcn bg-success">Valid ✓</span>
            @elseif($e->insurance_status === 'pending') <span class="badge badge-fcn bg-warning text-dark">Pending</span>
            @else <span class="badge badge-fcn bg-danger">None</span>
            @endif
          </td>
          <td>
            <form method="POST" action="{{ route('admin.educators.status', $e) }}">
              @csrf @method('PATCH')
              <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach(['pending','verified','active','suspended'] as $s)
                <option value="{{ $s }}" {{ $e->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
              </select>
            </form>
          </td>
          <td>
            <form method="POST" action="{{ route('admin.educators.delete', $e) }}" onsubmit="return confirm('Delete this educator?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted py-4">No educators found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $educators->withQueryString()->links() }}</div>
@endsection
