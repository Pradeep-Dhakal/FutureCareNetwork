@extends('layouts.admin')
@section('title','Matches')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <p class="text-muted small mb-0">{{ $matches->total() }} matches total</p>
  <form method="POST" action="{{ route('admin.matches.run') }}">
    @csrf
    <button type="submit" class="btn btn-fcn-primary" onclick="return confirm('Run auto-matching algorithm on all pending families?')">
      <i class="bi bi-magic me-1"></i> Run Auto-Matching
    </button>
  </form>
</div>

<div class="alert alert-info small mb-3">
  <i class="bi bi-info-circle me-2"></i>
  The auto-matching algorithm matches pending families with verified educators in the same postcode offering the required care type.
</div>

<div class="chart-card p-0">
  <div class="table-responsive">
    <table class="table admin-table mb-0">
      <thead>
        <tr>
          <th>Match ID</th>
          <th>Family</th>
          <th>Educator</th>
          <th>Care Type Match</th>
          <th>Location</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($matches as $m)
        <tr>
          <td><code>#{{ $m->id }}</code></td>
          <td>
            <strong>{{ $m->family->parent_name }}</strong>
            <br><small class="text-muted">{{ $m->family->reference_number }}</small>
          </td>
          <td>
            <strong>{{ $m->educator->name }}</strong>
            <br><small class="text-muted">{{ $m->educator->reference_number }}</small>
          </td>
          <td><span class="badge badge-fcn bg-secondary">{{ $m->family->care_type }}</span></td>
          <td><small>{{ $m->family->suburb }} / {{ $m->educator->suburb }}</small></td>
          <td>
            <form method="POST" action="{{ route('admin.matches.status', $m) }}">
              @csrf @method('PATCH')
              <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach(['pending','confirmed','rejected'] as $s)
                <option value="{{ $s }}" {{ $m->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
              </select>
            </form>
          </td>
          <td><small>{{ $m->created_at->format('d M Y') }}</small></td>
          <td>
            <form method="POST" action="{{ route('admin.matches.delete', $m) }}" onsubmit="return confirm('Delete this match?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="text-center text-muted py-4">
            No matches yet. Click "Run Auto-Matching" to generate matches.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $matches->links() }}</div>
@endsection
