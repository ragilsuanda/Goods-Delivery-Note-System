@extends('admin.layout.app')

@section('content')
<div class="container py-4">
  <div class="card shadow-sm">
    <div class="card-header border-bottom bg-white">
      <h4 class="fw-bold text-uppercase mb-0">Detail Surat</h4>
    </div>
    <div class="card-body">
      <div class="row g-4 mb-4">
        <div class="col-md-6">
          <h6 class="text-primary mb-3">Informasi Umum</h6>
          <table class="table table-sm table-borderless">
            <tr><th style="width: 45%">No Surat</th><td>: {{ $suratjalan->no_suratjalan }}</td></tr>
            <tr><th>Tanggal</th><td>: {{ $suratjalan->tanggal_suratjalan }}</td></tr>
            <tr><th>Nama Penerima</th><td>: {{ $suratjalan->penerima_barang }}</td></tr>
          </table>
        </div>
        <div class="col-md-6">
          <h6 class="text-primary mb-3">Informasi Pengiriman</h6>
          <table class="table table-sm table-borderless">
            <tr><th style="width: 45%">Alamat Penerima</th><td>: {{ $suratjalan->alamat_penerima }}</td></tr>
            <tr><th>No Kendaraan</th><td>: {{ $suratjalan->no_kendaraan }}</td></tr>
            <tr><th>Nama Pengemudi</th><td>: {{ $suratjalan->nama_pengemudi }}</td></tr>
          </table>
        </div>
      </div>

      <div class="mb-4">
        <h6 class="text-primary mb-3">Daftar Barang yang Dikirim</h6>
        <table class="table table-bordered table-hover">
          <thead class="table-light text-center">
            <tr>
              <th style="width: 5%">No</th>
              <th>Nama Barang</th>
              <th>Ukuran</th>
              <th style="width: 20%">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($suratjalan->items as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->ukuran_barang }}</td>
                <td>{{ $item->jumlah_barang }} {{ $item->satuan }}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>

      <div class="text-center mb-4">
        <h6 class="text-muted">Kode QR Surat</h6>
        <div id="qrcode" class="d-flex justify-content-center mt-3"></div>
        <button class="btn btn-outline-primary mt-3" onclick="downloadQR()">
          <i class="fa fa-download"></i> Unduh QR
        </button>
      </div>

      <div class="text-center">
        <a href="{{ route('suratjalan.cetak', $suratjalan->id) }}" class="btn btn-danger px-4" target="_blank">
          <i class="fa fa-print"></i> Cetak PDF
        </a>
        <a href="{{ route('suratjalan.word', $suratjalan->id) }}" class="btn btn-primary px-4 ms-2">
          <i class="fa fa-file-word"></i> Download Word
        </a>
      </div>
      
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const url = "{{ route('suratjalan.cetak', $suratjalan->id) }}";
  new QRCode(document.getElementById("qrcode"), {
    text: url,
    width: 128,
    height: 128,
  });
});

function downloadQR() {
  const img = document.querySelector('#qrcode img');
  if (!img) return alert('QR belum dimuat');

  const a = document.createElement('a');
  a.href = img.src;
  a.download = 'qr-suratjalan-{{ $suratjalan->id }}.png';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
}
</script>
@endsection