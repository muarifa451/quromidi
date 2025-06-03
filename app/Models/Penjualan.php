<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['pembeli_id', 'kasir_id', 'tanggal_pesan'];

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    }

    public function kasir()
    {
        return $this->belongsTo(Login::class, 'kasir_id');
    }

    public function getTotalHargaAttribute()
    {
        return $this->detailPenjualans->sum(function ($detail) {
            return $detail->jumlah * $detail->harga;
        });
    }
}