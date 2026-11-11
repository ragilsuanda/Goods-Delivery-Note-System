<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratJalan;
use App\Exports\SuratJalanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanSuratJalanController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratJalan::where('status', 'selesai');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_suratjalan', [
                $request->tanggal_mulai,
                $request->tanggal_sampai
            ]);
        }

        $suratjalans = $query->orderBy('tanggal_suratjalan')->get();

        return view('admin.laporan.suratjalan.index', compact('suratjalans'));
    }

    public function export(Request $request)
    {
        return Excel::download(new SuratJalanExport($request), 'laporan_surat_jalan.xlsx');
    }
}
