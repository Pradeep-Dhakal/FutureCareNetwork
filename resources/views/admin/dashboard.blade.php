@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- KPI CARDS --}}
<div class="row g-3 mb-4">
  @foreach([
    ['green', 'bi-people-fill', 'REGISTERED FAMILIES', $totalFamilies, '↑ Total registered'],
    ['amber', 'bi-mortarboard-fill', 'ACTIVE EDUCATORS', $totalEducators, '↑ Total registered'],
    ['blue', 'bi-link-45deg', 'SUCCESSFUL MATCHES', $totalMatches, 'Confirmed matches'],
    ['red', 'bi-hourglass-split', 'FAMILIES WAITLISTED', $totalWaitlisted, 'Awaiting educator'],
  ] as $k)
  <div class="col-md-6 col-xl-3">
    <div class="kpi-card {{ $k[0] }}">
      <div class="kpi-label mb-2">{{ $k[2] }}</div>
      <div class="kpi-num">{{ $k[3] }}</div>
      <div class="kpi-change mt-1">{{ $k[4] }}</div>
      <i class="bi {{ $k[1] }}" style="position:absolute;top:1.25rem;right:1.25rem;font-size:1.6rem;opacity:.1;color:#000;"></i>
    </div>
  </div>
  @endforeach
</div>

{{-- CHARTS ROW --}}
<div class="row g-3 mb-4">
  <div class="col-lg-7">
    <div class="chart-card h-100">
      <h6 class="fw-600 mb-1" style="color:#1B2A4A;font-weight:600;">Monthly Registrations</h6>
      <p class="text-muted small mb-3">Families vs Educators — last 6 months</p>
      <canvas id="barChart" height="200"></canvas>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="chart-card h-100">
      <h6 class="fw-600 mb-1" style="color:#1B2A4A;font-weight:600;">Care Type Demand</h6>
      <p class="text-muted small mb-3">Family registrations by care type</p>
      <canvas id="donutChart" height="200"></canvas>
    </div>
  </div>
</div>

{{-- REGIONAL DEMAND --}}
<div class="row g-3 mb-4">
  <div class="col-12">
    <div class="chart-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h6 class="fw-600 mb-0" style="color:#1B2A4A;font-weight:600;">Regional Demand — Top Postcodes</h6>
          <p class="text-muted small mb-0">Childcare demand by region in Queensland</p>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table admin-table">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Suburb</th>
              <th>Postcode</th>
              <th>Families Registered</th>
              <th>Demand Level</th>
            </tr>
          </thead>
          <tbody>
            @forelse($regional as $i => $r)
            <tr>
              <td><strong>#{{ $i + 1 }}</strong></td>
              <td>{{ $r->suburb }}</td>
              <td>{{ $r->postcode }}</td>
              <td>{{ $r->count }}</td>
              <td>
                <div class="progress" style="height:6px;width:120px;">
                  <div class="progress-bar" style="background:#0D7C7C;width:{{ min(100, $r->count * 20) }}%"></div>
                </div>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted py-3">No data yet</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- RECENT ACTIVITY --}}
<div class="row g-3">
  <div class="col-lg-6">
    <div class="chart-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-600 mb-0" style="color:#1B2A4A;font-weight:600;">Recent Families</h6>
        <a href="{{ route('admin.families') }}" class="btn btn-sm btn-outline-secondary">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table admin-table">
          <thead><tr><th>Name</th><th>Location</th><th>Status</th></tr></thead>
          <tbody>
            @foreach(\App\Models\Family::latest()->limit(5)->get() as $f)
            <tr>
              <td><strong>{{ $f->parent_name }}</strong><br><small class="text-muted">{{ $f->reference_number }}</small></td>
              <td>{{ $f->suburb }}, {{ $f->postcode }}</td>
              <td>
                <span class="badge badge-fcn bg-{{ $f->status_badge }}">{{ ucfirst($f->status) }}</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="chart-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-600 mb-0" style="color:#1B2A4A;font-weight:600;">Blue Card Compliance</h6>
        <a href="{{ route('admin.educators') }}" class="btn btn-sm btn-outline-secondary">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table admin-table">
          <thead><tr><th>Educator</th><th>Expiry</th><th>Status</th></tr></thead>
          <tbody>
            @foreach(\App\Models\Educator::latest()->limit(5)->get() as $e)
            @php $bcStatus = $e->blue_card_status; @endphp
            <tr>
              <td><strong>{{ $e->name }}</strong><br><small class="text-muted">{{ $e->reference_number }}</small></td>
              <td class="{{ $bcStatus === 'expired' ? 'text-danger fw-bold' : ($bcStatus === 'expiring' ? 'text-warning' : '') }}">
                {{ $e->blue_card_expiry ? $e->blue_card_expiry->format('d M Y') : 'Not provided' }}
              </td>
              <td>
                @if($bcStatus === 'expired')
                  <span class="badge badge-fcn bg-danger">Expired ⚠️</span>
                @elseif($bcStatus === 'expiring')
                  <span class="badge badge-fcn bg-warning text-dark">Expiring Soon</span>
                @elseif($bcStatus === 'valid')
                  <span class="badge badge-fcn bg-success">Valid ✓</span>
                @else
                  <span class="badge badge-fcn bg-secondary">Not Provided</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
const months = @json($months->pluck('label'));
const familyData = @json($months->pluck('families'));
const educatorData = @json($months->pluck('educators'));

// Bar chart
new Chart(document.getElementById('barChart'), {
  type: 'bar',
  data: {
    labels: months,
    datasets: [
      { label: 'Families', data: familyData, backgroundColor: '#0D7C7C', borderRadius: 4 },
      { label: 'Educators', data: educatorData, backgroundColor: '#E8963A', borderRadius: 4 },
    ]
  },
  options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

// Donut chart
const careLabels = @json($careTypes->keys());
const careData   = @json($careTypes->values());
new Chart(document.getElementById('donutChart'), {
  type: 'doughnut',
  data: {
    labels: careLabels.length ? careLabels : ['No data yet'],
    datasets: [{ data: careData.length ? careData : [1], backgroundColor: ['#0D7C7C','#E8963A','#0EA5E9','#6B7280','#DC2626'], borderWidth: 0 }]
  },
  options: { responsive: true, plugins: { legend: { position: 'bottom' } }, cutout: '65%' }
});
</script>
@endsection
