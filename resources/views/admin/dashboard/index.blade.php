@extends('admin.layout.app')
@section('content')
<div class="container">
  <div class="page-inner">
    <h3 class="fw-bold mb-4">Dashboard</h3>
    
    <div class="row g-4">

      <!-- Baris 1 -->
      <div class="col-12 col-md-6">
        <div class="card bg-primary text-white p-4 shadow rounded-4 h-100">
          <div class="d-flex align-items-center">
            <div class="me-4">
              <i class="fas fa-envelope fa-3x"></i>
            </div>
            <div>
              <p class="fs-5 mb-1">Total Surat</p>
              <h3 class="fw-bold mb-0">{{ $totalSurat }}</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="card bg-info text-white p-4 shadow rounded-4 h-100">
          <div class="d-flex align-items-center">
            <div class="me-4">
              <i class="fas fa-spinner fa-3x"></i>
            </div>
            <div>
              <p class="fs-5 mb-1">Diproses</p>
              <h3 class="fw-bold mb-0">{{ $suratDiproses }}</h3>
            </div>
          </div>
        </div>
      </div>

      <!-- Baris 2 -->
      <div class="col-12 col-md-6">
        <div class="card bg-success text-white p-4 shadow rounded-4 h-100">
          <div class="d-flex align-items-center">
            <div class="me-4">
              <i class="fas fa-check-circle fa-3x"></i>
            </div>
            <div>
              <p class="fs-5 mb-1">Selesai</p>
              <h3 class="fw-bold mb-0">{{ $suratSelesai }}</h3>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="card bg-dark text-white p-4 shadow rounded-4 h-100">
          <div class="d-flex align-items-start">
            <div class="me-4">
              <i class="fas fa-clock fa-3x"></i>
            </div>
            <div>
              <p class="fs-6 mb-1">{{ $lokasi }}</p>
              <h3 class="fw-bold mb-0" id="clock">{{ $waktu }}</h3>
              <p class="mb-0" id="tanggal">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  function updateTime() {
    const now = new Date();
    document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID', { hour12: false });
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('tanggal').textContent = now.toLocaleDateString('id-ID', options);
  }
  setInterval(updateTime, 1000);
  updateTime(); // initial run
</script>
@endsection
