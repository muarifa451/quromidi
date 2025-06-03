<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    protected $table = 'detailpenjualans';
    protected $fillable = ['penjualan_id', 'barang_id', 'jumlah', 'total_harga'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga;
    }
}
