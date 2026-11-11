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
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    body {
      background: white;
      font-size: 12px;
      font-family: monospace;
    }
    .sheet {
      width: 231mm;
      height: 129mm;
      box-sizing: border-box;
      padding: 5mm;
      overflow: hidden;
      position: relative;
    }
    
 .compact-table td,
  .compact-table th {
    padding: 2px 4px;
  }
     .relative-header {
    position: relative;
    margin-bottom: 2px;
    padding-bottom: 2px;
  }

  .company-info {
    font-size: 12px;
    line-height: 1.1;
    margin-bottom: 0;
  }

  .company-title {
    font-weight: bold;
    font-size: 20px;
    text-align: left;
    margin: 0;
    padding: 0;
  }

  .barcode-absolute {
    position: absolute;
    top: 0;
    right: 0;
  }

  .barcode-absolute img {
    display: block;
    max-height: 35px; /* Dikecilkan */
    width: auto;
  }

    table {
      border-collapse: collapse;
      width: 100%;
      table-layout: fixed;
    }
    td, th {
      padding: 6px;
      vertical-align: top;
      word-wrap: break-word;
    }
    .bordered th, .bordered td {
      border: 1px solid black;
    }
    .signature-table {
      margin-top: 25px;
      width: 100%;
      text-align: center;
    }
    .signature-table td {
      padding-top: 30px;
    }
    .signature-line {
      border-top: 1px solid black;
      width: 80%;
      margin: 20px auto 0 auto;
    }
    .title {
      text-align: center;
      font-weight: bold;
      font-size: 14px;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="sheet">
    <!-- HEADER + BARCODE -->
    <div class="relative-header">
      <div class="company-info">
        <div class="company-title">CV. NTRI BERKAH JAYA</div>
        <div>Email: ntriberkahhjaya@gmail.com</div>
      </div>
      <div class="barcode-absolute">
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(url('/suratjalan/' . $suratjalan->id . '/cetak'), 'QRCODE') }}" width="50">
      </div>
    </div>

    <hr style="border: 1px solid black; margin-top: 6px; margin-bottom: 4px;">

    <!-- TANGGAL & NO SURAT -->
    <table class="compact-table" style="margin-top: 0;">
      <tr>
        <td colspan="4" style="width: 60%;">No. Surat : <strong>{{ $suratjalan->no_suratjalan }}</strong></td>
        <td colspan="3" style="text-align: right;">Dumai, {{ \Carbon\Carbon::parse($suratjalan->tanggal_suratjalan)->format('d M Y') }}</td>
      </tr>
      <tr>
        <td colspan="2">Kepada Yth.</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td colspan="3">: {{ $suratjalan->penerima_barang }}</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td colspan="3">: {{ $suratjalan->alamat_penerima }}</td>
      </tr>
    </table>

    <div class="title">SURAT PENGANTAR BARANG</div>

    <table style="margin-top: 5px;">
      <tr>
        <td colspan="2">No. Polisi</td>
        <td colspan="12">: {{ $suratjalan->no_kendaraan }}</td>
      </tr>
    </table>

    <!-- TABLE BARANG -->
    <table class="bordered" style="margin-top: 5px;">
      <thead>
        <tr>
          <th style="width: 5%; text-align: center;">No</th>
          <th style="width: 45%; text-align: left;">Nama Barang</th>
          <th style="width: 15%; text-align: center;">Size</th>
          <th style="width: 20%; text-align: center;">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($suratjalan->items as $item)
        <tr>
          <td style="text-align: center;">{{ $loop->iteration }}</td>
          <td>{{ $item->nama_barang ?? $item->nama_barang }}</td>
          <td style="text-align: center;">
            {{ $item->ukuran ?? $item->berat ?? $item->ukuran_barang }}
          </td>
          <td style="text-align: center;">
            {{ $item->jumlah_barang }} {{ $item->satuan ?? '' }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- TANDA TANGAN -->
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
