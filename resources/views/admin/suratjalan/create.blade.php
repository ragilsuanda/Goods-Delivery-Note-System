@extends('admin.layout.app')
@section('content')
<div class="container">
<div class="container mt-4">
  <h4>Tambah Pengantar Barang</h4>
  <p class="small">Isi semua data dengan benar.</p>

  <div class="row">
    <!-- Form Input Container -->
    <div class="col-md-7">
      <form action="{{ route('suratjalan.store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label>Tanggal Pengantar Barang</label>
              <input type="date" name="tanggal_suratjalan" class="form-control" required />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label>Nama Penerima</label>
              <input type="text" name="penerima_barang" class="form-control" required />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label>Alamat Penerima</label>
              <input type="text" name="alamat_penerima" class="form-control" required />
            </div>
          </div>
           <div class="col-md-6">
            <div class="form-group mb-3">
              <label>Nama Pengemudi</label>
              <input type="text" name="nama_pengemudi" class="form-control" required />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label>No Kendaraan</label>
              <input type="text" name="no_kendaraan" class="form-control" required />
            </div>
          </div>
          </div>
        <hr>
        <h6>Input Barang</h6>
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Pilih Barang</label>
            <select id="barang-select" class="form-control">
              <option value="">-- Pilih Barang --</option>
              @foreach($databarangs as $barang)
                <option value="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}">{{ $barang->nama_barang }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Jumlah</label>
            <input type="number" id="barang-jumlah" class="form-control" placeholder="Jumlah">
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="button" id="tambah-barang" class="btn btn-outline-primary btn-sm w-100">Tambah</button>
          </div>
        </div>

        <div id="barang-hidden-inputs"></div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>

    <!-- Daftar Barang Container -->
    <div class="col-md-5">
      <h6>Daftar Barang Ditambahkan</h6>
      <ul id="daftar-barang" class="list-group"></ul>
    </div>
  </div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tambahBtn = document.getElementById('tambah-barang');
  const select = document.getElementById('barang-select');
  const jumlah = document.getElementById('barang-jumlah');
  const daftar = document.getElementById('daftar-barang');
  const hiddenInputs = document.getElementById('barang-hidden-inputs');

  tambahBtn.addEventListener('click', () => {
    const id = select.value;
    const nama = select.options[select.selectedIndex].dataset.nama;
    const qty = jumlah.value;

    if (!id || !qty || qty <= 0) {
      alert('Pilih barang dan jumlah dengan benar.');
      return;
    }

    const li = document.createElement('li');
    li.className = 'list-group-item d-flex justify-content-between align-items-center';
    li.innerHTML = `${nama} - ${qty}
      <button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button>`;
    li.dataset.id = id;
    li.dataset.qty = qty;
    daftar.appendChild(li);

    const inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'databarang_id[]';
    inputId.value = id;

    const inputQty = document.createElement('input');
    inputQty.type = 'hidden';
    inputQty.name = 'jumlah_barang[]';
    inputQty.value = qty;

    hiddenInputs.appendChild(inputId);
    hiddenInputs.appendChild(inputQty);

    select.value = '';
    jumlah.value = '';
  });

  daftar.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-hapus')) {
      const li = e.target.closest('li');
      const id = li.dataset.id;
      const qty = li.dataset.qty;

      li.remove();

      const inputs = hiddenInputs.querySelectorAll('input');
      inputs.forEach((input, index) => {
        if (input.name === 'databarang_id[]' && input.value === id &&
            inputs[index + 1]?.name === 'jumlah_barang[]' && inputs[index + 1]?.value === qty) {
          input.remove();
          inputs[index + 1].remove();
        }
      });
    }
  });
});
</script>
@endsection
