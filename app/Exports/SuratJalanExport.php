<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\SuratJalan;

class SuratJalanExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = SuratJalan::query();

        if ($this->request->filled('tanggal_mulai') && $this->request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_suratjalan', [
                $this->request->tanggal_mulai,
                $this->request->tanggal_sampai
            ]);
        }

        $suratjalans = $query->orderBy('tanggal_suratjalan')->get();

        return view('admin.laporan.suratjalan.excel', compact('suratjalans'));
    }
}
