<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelians';
    protected $fillable = ['barang_id', 'supplier_id', 'jumlah', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($pembelian) {
            $pembelian->barang->increment('stok', $pembelian->jumlah);
        });

        static::deleted(function ($pembelian) {
            $pembelian->barang->decrement('stok', $pembelian->jumlah);
        });

        static::updating(function ($pembelian) {
            $original = $pembelian->getOriginal();
            $stokLama = $original['jumlah'];
            $stokBaru = $pembelian->jumlah;
            
            $pembelian->barang->decrement('stok', $stokLama);
            $pembelian->barang->increment('stok', $stokBaru);
        });
    }
}