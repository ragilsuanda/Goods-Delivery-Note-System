<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratJalan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalSurat = SuratJalan::count();
        $suratDiproses = SuratJalan::where('status', 'proses')->count();
        $suratSelesai = SuratJalan::where('status', 'selesai')->count();
        $waktu = Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y HH:mm');
        $lokasi = 'Dumai'; // atau gunakan IP geolocation jika tersedia

        return view('admin.dashboard.index', compact(
            'totalSurat',
            'suratDiproses',
            'suratSelesai',
            'waktu',
            'lokasi'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
