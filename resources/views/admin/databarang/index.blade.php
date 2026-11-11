@extends('admin.layout.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Data Barang</h4>
              <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addBarangModal">
                <i class="fa fa-plus"></i> Tambah Barang
              </button>
            </div>
          </div>

          <div class="card-body">
            @if (session('success'))
              <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            {{-- Modal Tambah --}}
            <div class="modal fade" id="addBarangModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <form action="{{ route('databarang.store') }}" method="POST">
                  @csrf
                  <div class="modal-content">
                    <div class="modal-header border-0">
                      <h5 class="modal-title">Tambah Barang</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="small">Isi semua data barang dengan benar.</p>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group form-group-default">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group form-group-default">
                            <label>Ukuran</label>
                            <input type="text" name="ukuran_barang" class="form-control" required />
                          </div>
                        </div>
                          <div class="col-md-6">
                                  <div class="form-group form-group-default">
                                    <label>satuan</label>
                                    <input type="text" name="satuan" class="form-control" required />
                                  </div>
                          </div>
                        <div class="col-md-12">
                          <div class="form-group form-group-default">
                            <label>Detail Barang</label>
                            <input type="text" name="detail_barang" class="form-control" required />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer border-0">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
              <table id="add-row" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Satuan</th>
                    <th>Detail Barang</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($databarangs as $databarang)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $databarang->nama_barang }}</td>
                      <td>{{ $databarang->ukuran_barang }}</td>
                      <td>{{ $databarang->satuan }}</td>
                      <td>{{ $databarang->detail_barang }}</td>
                    <td>
                      <div class="d-flex justify-content-center align-items-center gap-1">
                        <!-- Tombol Edit -->
                        <button type="button"
                                class="btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editBarangModal{{ $databarang->id }}">
                          Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('databarang.destroy', $databarang->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                              style="margin: 0;">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                                  class="btn btn-sm btn-danger">
                            Hapus
                          </button>
                        </form>
                      </div>
                    </td>


                    </tr>

                    <!-- Modal Edit Barang -->
                    <div class="modal fade" id="editBarangModal{{ $databarang->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <form action="{{ route('databarang.update', $databarang->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="modal-content">
                            <div class="modal-header border-0">
                              <h5 class="modal-title">Edit Barang</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" value="{{ $databarang->nama_barang }}" class="form-control" required />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-group-default">
                                    <label>Ukuran</label>
                                    <input type="text" name="ukuran_barang" value="{{ $databarang->ukuran_barang }}" class="form-control" required />
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group form-group-default">
                                    <label>satuan</label>
                                    <input type="text" name="satuan" value="{{ $databarang->satuan }}" class="form-control" required />
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group form-group-default">
                                    <label>Detail Barang</label>
                                    <input type="text" name="detail_barang" value="{{ $databarang->detail_barang }}" class="form-control" required />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer border-0">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- Auto dismiss success alert -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const alertBox = document.getElementById('success-alert');
    if (alertBox) {
      setTimeout(() => {
        alertBox.classList.remove('show');
        alertBox.classList.add('fade');
        setTimeout(() => {
          alertBox.remove();
        }, 500);
      }, 3000);
    }
  });
</script>
