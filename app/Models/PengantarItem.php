<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengantarItem extends Model
{
    protected $fillable = [
        'surat_jalan_id',
        'databarang_id',
        'nama_barang',
        'ukuran_barang',
        'satuan',
        'jumlah_barang'
    ];

    public function surat()
    {
        return $this->belongsTo(SuratJalan::class, 'surat_jalan_id');
    }
}
