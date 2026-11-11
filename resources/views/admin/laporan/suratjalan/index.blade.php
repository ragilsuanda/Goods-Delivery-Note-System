@extends('admin.layout.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Laporan Surat Pengantar Barang</h3>
    </div>

    <div class="card mb-5">
  <div class="card-body">
    <form method="GET" class="row g-3 align-items-end">
      <div class="col-md-4">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" name="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
      </div>
        <div class="col-md-2">
      <label class="form-label d-block">&nbsp;</label>
      <button type="submit" class="btn btn-primary w-100">
        <i class="fa fa-search"></i> Cari
      </button>
    </div>
    <div class="col-md-2">
      <label class="form-label d-block">&nbsp;</label>
      <a class="btn btn-success w-100" href="{{ route('laporan.suratjalan.export', request()->query()) }}">
        <i class="fa fa-file-excel"></i> Export Excel
      </a>
    </div>
    </form>
  </div>
</div>

    <div class="card">
      <div class="card-body">
        <table id="add-row" class="display table table-striped table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>No Surat Jalan</th>
              <th>Tanggal</th>
              <th>Penerima</th>
              <th>Alamat</th>
              <th>Pengemudi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($suratjalans as $sj)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sj->no_suratjalan }}</td>
                <td>{{ $sj->tanggal_suratjalan }}</td>
                <td>{{ $sj->penerima_barang }}</td>
                <td>{{ $sj->alamat_penerima }}</td>
                <td>{{ $sj->nama_pengemudi }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
