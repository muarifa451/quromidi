<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'pembelis';
    protected $fillable = ['nama', 'jenis_kelamin', 'alamat', 'no_hp'];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'pembeli_id');
    }
}
