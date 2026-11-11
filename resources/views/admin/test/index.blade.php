<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>SURAT PENGANTAR BARANG</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    @page {
      size: 241mm 139mm;
      margin: 5mm;
    }
    body {
      margin: 0;
      padding: 0;
      font-size: 12px;
      font-family: monospace;
    }
    .sheet {
      width: 231mm;
      height: 129mm;
      padding: 5mm;
      position: relative;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    td, th {
      padding: 4px;
      vertical-align: top;
    }
    .bordered th, .bordered td {
      border: 1px solid black;
      padding: 4px;
    }
    .signature-table {
      margin-top: 20px;
      width: 100%;
      text-align: center;
    }
    .signature-line {
      border-top: 1px solid black;
      width: 80%;
      margin: 10px auto 0 auto;
    }
    .barcode-inline {
      position: absolute;
      top: 5mm;
      right: 10mm;
      text-align: right;
    }
    .top-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
      margin-bottom: 2px;
    }
    .left-header {
      font-weight: bold;
      font-size: 15px;
    }
    .right-header {
      text-align: right;
      font-size: 12px;
    }
  </style>
</head>
<body>
  <div class="sheet">
    <div class="barcode-inline">
      <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($suratjalan->no_suratjalan, 'QRCODE') }}" width="50">
    </div>

    <div class="top-header">
      <div class="left-header">
        CV. NTRI BERKAH JAYA<br>
        <span style="font-weight: normal; font-size: 12px;">Email: ntriberkahjaya@gmail.com</span>
      </div>
      <div class="right-header">
        Dumai, {{ \Carbon\Carbon::parse($suratjalan->tanggal_suratjalan)->format('d M Y') }}
      </div>
    </div>
    <hr style="border: 1px solid black;">
    <table>
      <tr>
        <td colspan="2" style="width: 20%;">No. Surat</td>
        <td colspan="5">: <strong>{{ $suratjalan->no_suratjalan }}</strong></td>
      </tr>
      <tr>
        <td colspan="2">Kepada Yth.</td>
        <td colspan="5">: {{ $suratjalan->penerima_barang }}</td>
      </tr>
      <tr>
        <td colspan="2">Alamat</td>
        <td colspan="5">: {{ $suratjalan->alamat_penerima }}</td>
      </tr>
      <tr>
        <td colspan="7" style="text-align: center; font-weight: bold;">SURAT PENGANTAR BARANG</td>
      </tr>
      <tr>
        <td colspan="2">No. Polisi</td>
        <td colspan="5">: {{ $suratjalan->no_kendaraan }}</td>
      </tr>
    </table>

    <table class="bordered" style="margin-top: 5px; font-size: 11px;">
      <thead>
        <tr>
          <th style="width: 5%; text-align: center;">No</th>
          <th style="width: 45%;">Nama Barang</th>
          <th style="width: 15%; text-align: center;">Size</th>
          <th style="width: 20%; text-align: center;">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($suratjalan->items as $item)
        <tr>
          <td style="text-align: center;">{{ $loop->iteration }}</td>
          <td>{{ $item->nama_barang }}</td>
          <td style="text-align: center;">{{ $item->ukuran ?? $item->berat ?? $item->ukuran_barang }}</td>
          <td style="text-align: center;">{{ $item->jumlah_barang }} {{ $item->satuan ?? '' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <table class="signature-table">
      <tr>
        <td>Penerima</td>
        <td>Pengemudi</td>
        <td>Hormat Kami</td>
      </tr>
      <tr>
        <td><div class="signature-line"></div>{{ $suratjalan->penerima_barang }}</td>
        <td><div class="signature-line"></div>{{ $suratjalan->nama_pengemudi }}</td>
        <td><div class="signature-line"></div>Warsito</td>
      </tr>
    </table>
  </div>
</body>
</html>
