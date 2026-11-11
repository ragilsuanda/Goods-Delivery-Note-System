<table>
  <thead>
    <tr>
            <th style="min-width: 50px;">No</th>
            <th style="min-width: 150px;">No Surat Jalan</th>
            <th style="min-width: 100px;">Tanggal</th>
            <th style="min-width: 150px;">Penerima</th>
            <th style="min-width: 200px;">Alamat</th>
            <th style="min-width: 150px;">Pengemudi</th>
            <th style="min-width: 150px;">No Kendaraan</th>
            <th style="min-width: 200px;">Barang</th>
            <th style="min-width: 100px;">Ukuran</th>
            <th style="min-width: 150px;">Jumlah</th>
    </tr>
  </thead>
  <tbody>
  @foreach($suratjalans as $index => $sj)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $sj->no_suratjalan }}</td>
              <td>{{ $sj->tanggal_suratjalan }}</td>
              <td>{{ $sj->penerima_barang }}</td>
              <td>{{ $sj->alamat_penerima }}</td>
              <td>{{ $sj->nama_pengemudi }}</td>
              <td>{{ $sj->no_kendaraan }}</td>
               <td>
                @foreach($sj->items as $item)
                  • {{ $item->nama_barang }}<br>
                @endforeach
              </td>
              <td>
                @foreach($sj->items as $item)
                  • {{ $item->ukuran_barang ?? '-' }}<br>
                @endforeach
              </td>
              <td>
                 @foreach($sj->items as $item)
                  • {{ $item->jumlah_barang }} {{ $item->satuan ?? '' }}<br>
                @endforeach
              </td>
            </tr>
          @endforeach
  </tbody>
</table>
