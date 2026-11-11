@extends('admin.layout.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Surat Pengantar Barang</h4>
               <a href="{{ route('suratjalan.create') }}" class="btn btn-primary btn-round ms-auto">
                <i class="fa fa-plus"></i> Tambah Surat
              </a>
            </div>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="table-responsive">
              <table id="add-row" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tanggal</th>
                    <th>Penerima</th>
                    <th>Pengemudi</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($suratjalans as $suratjalan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $suratjalan->no_suratjalan }}</td>
                    <td>{{ $suratjalan->tanggal_suratjalan }}</td>
                    <td>
                      {{ $suratjalan->penerima_barang }}
                    </td>
                    <td>
                      {{ $suratjalan->nama_pengemudi }}
                    </td>
                    <td>{{$suratjalan->alamat_penerima}}</td>
                    <td>
                      @if ($suratjalan->status === 'selesai')
                          <span class="badge bg-success">Selesai</span>
                        @else
                          <span class="badge bg-warning text-dark">Diproses</span>
                        @endif
                    </td>
                  <td>
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-1">
                          <a href="{{ route('suratjalan.show', $suratjalan->id) }}" class="btn btn-xs btn-info">
                            Detail
                          </a>

                          <form action="{{ route('suratjalan.destroy', $suratjalan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-xs btn-danger" type="submit">
                              Hapus
                            </button>
                          </form>

                          <form action="{{ route('suratjalan.updateStatus', $suratjalan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $suratjalan->status === 'diproses' ? 'selesai' : 'diproses' }}">
                            <button type="submit" class="btn btn-xs btn-secondary">
                              Ubah Status
                            </button>
                          </form>
                        </div>
                      </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>



<script>
document.addEventListener('DOMContentLoaded', function () {
  const alertBox = document.getElementById('success-alert');
  if (alertBox) {
    setTimeout(() => {
      alertBox.classList.remove('show');
      alertBox.classList.add('fade');
      setTimeout(() => alertBox.remove(), 500);
    }, 3000);
  }
});
</script>

@endsection