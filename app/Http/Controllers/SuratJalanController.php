<?php

namespace App\Http\Controllers;

use App\Models\Databarang;
use App\Models\SuratJalan;
use App\Models\PengantarItem;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use Milon\Barcode\Facades\DNS1D;
use Milon\Barcode\Facades\DNS2D;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratjalans = SuratJalan::with('databarangs')->get();
        $databarangs = Databarang::all();

        return view('admin.suratjalan.index', compact('suratjalans', 'databarangs'));
    }

    /**
     * Generate a new unique no_suratjalan.
     */
    protected function generateNoSuratJalan(): string
    {
        $prefix = 'INV/' . date('Ymd') . '/';

        $latest = SuratJalan::where('no_suratjalan', 'like', $prefix . '%')
            ->orderByDesc('id')
            ->first();

        $lastNumber = $latest ? ((int) substr($latest->no_suratjalan, -4)) : 0;
        $nextNumber = $lastNumber + 1;

        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $databarangs = Databarang::all();
        return view('admin.suratjalan.create', compact('databarangs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal_suratjalan' => 'required|date',
            'nama_pengemudi' => 'required|string|max:100',
            'penerima_barang' => 'required|string',
            'alamat_penerima' => 'required|string',
            'no_kendaraan' => 'required|string',
            'databarang_id' => 'required|array|min:1',
            'databarang_id.*' => 'exists:databarangs,id',
            'jumlah_barang' => 'required|array|min:1',
            'jumlah_barang.*' => 'integer|min:1',
        ]);

        // Simpan suratjalan
        $suratjalan = SuratJalan::create([
            'no_suratjalan' => $this->generateNoSuratJalan(),
            'tanggal_suratjalan' => $request->tanggal_suratjalan,
            'penerima_barang' => $request->penerima_barang,
            'alamat_penerima' => $request->alamat_penerima,
            'no_kendaraan' => $request->no_kendaraan,
            'nama_pengemudi' => $request->nama_pengemudi,
        ]);

        $barangList = Databarang::whereIn('id', $request->databarang_id)->get()->keyBy('id');

        foreach ($request->databarang_id as $i => $barangId) {
            $barang = $barangList[$barangId];

            PengantarItem::create([
                'surat_jalan_id' => $suratjalan->id,
                'databarang_id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'ukuran_barang' => $barang->berat ?? $barang->ukuran_barang,
                'satuan' => $barang->satuan,
                'jumlah_barang' => $request->jumlah_barang[$i],
            ]);
        }

        return redirect()->route('suratjalan.index')->with('success', 'Data Surat Jalan berhasil ditambahkan.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suratjalan = SuratJalan::findOrFail($id);
        $suratjalan->databarangs()->detach();
        $suratjalan->delete();

        return redirect()->route('suratjalan.index')->with('success', 'Surat Jalan berhasil dihapus.');
    }
    public function show($id)
    {
        $suratjalan = SuratJalan::with('databarangs')->findOrFail($id);
        return view('admin.suratjalan.show', compact('suratjalan'));
    }

    public function cetak($id)
    {
        $suratjalan = SuratJalan::with('databarangs')->findOrFail($id);

        // Ukuran 9.5 x 11 inch = 684 x 792 point
        $pdf = Pdf::loadView('admin.suratjalan.pdf', compact('suratjalan'))
            ->setPaper([0, 0, 684, 792], 'portrait'); // 11 inch x 9.5 inch (satuan point)

        $safeFileName = str_replace(['/', '\\'], '-', $suratjalan->no_suratjalan);

        return $pdf->stream('SuratJalan-' . $safeFileName . '.pdf');
    }
    public function updateStatus(Request $request, $id)
    {
        $surat = SuratJalan::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }


    public function cetakWord($id)
    {
        $suratjalan = SuratJalan::with('databarangs')->findOrFail($id);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(10);

        $section = $phpWord->addSection([
            'pageSizeW' => 12240,
            'pageSizeH' => 15840,
            'orientation' => 'portrait',
            'marginTop' => 300,
            'marginBottom' => 300,
            'marginLeft' => 300,
            'marginRight' => 300,
        ]);

        // Header
        $tableHeader = $section->addTable(['alignment' => Jc::BOTH]);
        $tableHeader->addRow();
        $tableHeader->addCell(8000)->addText('CV. NTRI BERKAH JAYA', ['bold' => true, 'size' => 14], ['spaceAfter' => 0]);
        $tableHeader->addCell(4000)->addText('Dumai, ' . \Carbon\Carbon::parse($suratjalan->tanggal_suratjalan)->format('d M Y'), [], ['alignment' => Jc::RIGHT, 'spaceAfter' => 0]);

        $tableHeader->addRow();
        $tableHeader->addCell(8000)->addText('Email: ntriberkahhjaya@gmail.com', [], ['spaceAfter' => 0]);
        $tableHeader->addCell(4000)->addText('No. Surat : ' . $suratjalan->no_suratjalan, [], ['alignment' => Jc::RIGHT, 'spaceAfter' => 0]);
        $section->addText(str_repeat('_', 116), ['bold' => true], [
            'alignment' => Jc::CENTER,
            'spaceBefore' => 0,
            'spaceAfter' => 0
        ]);
        $section->addText('', [], ['spaceAfter' => 120]); // 6pt ≈ 0.5 baris

        // Informasi penerima
        $section->addText('Kepada Yth', [], ['alignment' => Jc::LEFT, 'spaceAfter' => 0]);
        $section->addText('Nama   : ' . $suratjalan->penerima_barang, [], ['alignment' => Jc::LEFT, 'spaceAfter' => 0]);
        $section->addText('Alamat : ' . $suratjalan->alamat_penerima, [], ['alignment' => Jc::LEFT, 'spaceAfter' => 0]);

        $section->addTextBreak(0.5);
        $section->addText('SURAT PENGANTAR BARANG', ['bold' => true], ['alignment' => Jc::CENTER]);
        $section->addText('No. Polisi : ' . $suratjalan->no_kendaraan);
        $section->addTextBreak(0.5);

        // Tabel barang
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '000000',
            'width' => 100 * 50,
            'unit' => TblWidth::PERCENT,
            'alignment' => Jc::CENTER,
        ]);

        $table->addRow();
        $table->addCell(1000)->addText('No.', ['bold' => true], ['alignment' => Jc::CENTER]);
        $table->addCell(5000)->addText('Nama Barang', ['bold' => true], ['alignment' => Jc::CENTER]);
        $table->addCell(2000)->addText('Size', ['bold' => true], ['alignment' => Jc::CENTER]);
        $table->addCell(2000)->addText('Jumlah', ['bold' => true], ['alignment' => Jc::CENTER]);

        foreach ($suratjalan->items as $index => $item) {
            $table->addRow();
            $table->addCell(1000)->addText($index + 1, [], ['alignment' => Jc::CENTER]);
            $table->addCell(5000)->addText($item->nama_barang, [], ['alignment' => Jc::LEFT]);
            $table->addCell(2000)->addText($item->berat ?? $item->ukuran_barang, [], ['alignment' => Jc::CENTER]);
            $table->addCell(2000)->addText($item->jumlah_barang . ' ' . ($item->satuan ?? ''), [], ['alignment' => Jc::CENTER]);
        }

        $section->addTextBreak(2);

        $sign = $section->addTable([
            'alignment' => Jc::CENTER,
            'width' => 100 * 50,
            'unit' => TblWidth::PERCENT,
        ]);

        $sign->addRow();
        $sign->addCell(2500)->addText('Penerima', ['bold' => true], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText('Pengemudi', ['bold' => true], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText('Hormat Kami', ['bold' => true], ['alignment' => Jc::CENTER]);

        $sign->addRow();
        $sign->addCell(2500)->addTextBreak(1.5);
        $sign->addCell(2500)->addTextBreak(1.5);
        $sign->addCell(2500)->addTextBreak(1.5);

        $sign->addRow();
        $sign->addCell(2500)->addText('____________________', [], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText('____________________', [], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText('____________________', [], ['alignment' => Jc::CENTER]);

        $sign->addRow();
        $sign->addCell(2500)->addText($suratjalan->penerima_barang, [], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText($suratjalan->nama_pengemudi, [], ['alignment' => Jc::CENTER]);
        $sign->addCell(2500)->addText('Warsito', [], ['alignment' => Jc::CENTER]);

        $fileName = 'SuratJalan-' . str_replace(['/', '\\'], '-', $suratjalan->no_suratjalan) . '.docx';
        $tempFile = storage_path('app/public/' . $fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
