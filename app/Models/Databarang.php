<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'ukuran_barang',
        'detail_barang',
        'satuan',
    ];



    public function suratjalans()
    {
        return $this->belongsToMany(SuratJalan::class, 'databarang_suratjalan', 'databarang_id', 'suratjalan_id')
            ->withPivot(['jumlah_barang', 'nama_barang', 'ukuran_barang', 'satuan'])
            ->withTimestamps();
    }
}
