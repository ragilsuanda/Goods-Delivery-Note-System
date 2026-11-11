<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'suratjalans';

    protected $fillable = [
        'databarang_id',
        'no_suratjalan',
        'jumlah_barang',
        'tanggal_suratjalan',
        'penerima_barang',
        'alamat_penerima',
        'no_kendaraan',
        'nama_pengemudi',
    ];

    public function databarangs()
    {
        return $this->belongsToMany(Databarang::class, 'databarang_suratjalan', 'suratjalan_id', 'databarang_id')
            ->withPivot(['jumlah_barang', 'nama_barang', 'ukuran_barang', 'satuan'])
            ->withTimestamps();
    }
    public function items()
    {
        return $this->hasMany(PengantarItem::class, 'surat_jalan_id');
    }
}
